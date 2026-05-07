<?php
header('Content-Type: application/json; charset=utf-8');

$allowed = ['health', 'json-items'];
$endpoint = $_GET['endpoint'] ?? '';
if (!in_array($endpoint, $allowed, true)) {
    http_response_code(404);
    echo json_encode(['error' => 'Unknown endpoint', 'endpoint' => $endpoint]);
    exit;
}

$backendHost = getenv('PYTHON_API_BACKEND') ?: 'http://python-api:8000';
$backendUrl = rtrim($backendHost, '/') . '/' . $endpoint;

function forward_to_backend(string $url): array
{
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $body = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        return [$body, $status, $error ?: null];
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 5,
        ],
    ]);
    $body = @file_get_contents($url, false, $context);
    $status = 502;
    $error = null;

    if ($body === false) {
        $error = 'Unable to fetch backend API';
        if (isset($http_response_header) && preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $http_response_header[0], $matches)) {
            $status = (int)$matches[1];
        }
    } else {
        $status = 200;
    }

    return [$body, $status, $error];
}

[$body, $status, $error] = forward_to_backend($backendUrl);
if ($body === false || $body === null) {
    http_response_code(502);
    echo json_encode(['error' => 'Python API unreachable', 'details' => $error, 'backend' => $backendUrl]);
    exit;
}

http_response_code($status);
echo $body;
