<?php
/**
 * api.php - PHP-API-Proxy für Backend-Kommunikation
 * 
 * Funktionalität:
 * - Validiert Endpoint-Anfragen (Whitelist-Pattern)
 * - Leitet Anfragen an Python-API-Backend weiter
 * - Verwaltet Fehlerbehandlung und HTTP-Status-Codes
 * 
 * Unterstützte Endpoints:
 *   - health: Backend Health-Status
 *   - json-items: Datenabruf aus Backend
 */

header('Content-Type: application/json; charset=utf-8');

// Sicherheit: Nur erlaubte Endpoints akzeptieren (Whitelist-Pattern)
$allowed = ['health', 'json-items'];
$endpoint = $_GET['endpoint'] ?? '';
if (!in_array($endpoint, $allowed, true)) {
    http_response_code(404);
    echo json_encode(['error' => 'Unknown endpoint', 'endpoint' => $endpoint]);
    exit;
}

// Backend-URL aus Umgebungsvariable oder Default-Wert konstruieren
$backendHost = getenv('PYTHON_API_BACKEND') ?: 'http://python-api:8000';
$backendUrl = rtrim($backendHost, '/') . '/' . $endpoint;

/**
 * Leitet HTTP-Anfragen an Backend weiter
 * 
 * @param string $url Backend-URL
 * @return array [body, status_code, error_message]
 * 
 * Unterstützt zwei Methoden:
 * 1. cURL (bevorzugt, besser für Error-Handling)
 * 2. file_get_contents mit Stream-Context (Fallback)
 */
function forward_to_backend(string $url): array
{
    // Versuche cURL zuerst (bessere Kontrollierbarkeit)
    if (function_exists('curl_init')) {
        // cURL-Konfiguration: Return-Transfer, Redirects, Timeouts
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        // Anfrage ausführen und HTTP-Status + Fehler auslesen
        $body = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        return [$body, $status, $error ?: null];
    }

    // Fallback: file_get_contents mit Stream-Context (wenn cURL nicht verfügbar)
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 5,
        ],
    ]);
    // Anfrage mit Error-Suppression und Stream-Header-Parsing
    $body = @file_get_contents($url, false, $context);
    $status = 502; // Default: Bad Gateway
    $error = null;

    if ($body === false) {
        $error = 'Unable to fetch backend API';
        // Versuche HTTP-Status aus Stream-Header zu extrahieren
        if (isset($http_response_header) && preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $http_response_header[0], $matches)) {
            $status = (int)$matches[1];
        }
    } else {
        $status = 200; // Erfolgreich
    }

    return [$body, $status, $error];
}

// Backend-Anfrage durchführen
[$body, $status, $error] = forward_to_backend($backendUrl);
// Fehlerbehandlung: Backend nicht erreichbar
if ($body === false || $body === null) {
    http_response_code(502);
    echo json_encode([
        'error' => 'Python API unreachable',
        'details' => $error,
        'backend' => $backendUrl
    ]);
    exit;
}

// Erfolgreich: HTTP-Status und Body zurückgeben
http_response_code($status);
echo $body;
