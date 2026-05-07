# Live-Test Dashboard – Integrationstests für alle Komponenten

**Ziel:** Das Live-Test Dashboard prüft die Integration aller Services (PHP, Python-API, MySQL) in einer Testumgebung.

---

## Übersicht

Das Dashboard ist unter `http://localhost:8080` verfügbar und zeigt den Status aller Komponenten:

| Komponente | Prüfung | Endpoint |
|---|---|---|
| **PHP** | Verbindung zu MySQL, Datenbankabfragen | `/api.php` (intern) |
| **Python-API** | REST-Health & JSON-Daten | `http://python-api:8000/health`, `/json-items` |
| **MySQL** | Tabellen, Abfragen, Demo-Daten | `mysql:3306` |
| **JavaScript** | Browser-Fetch, API-Integration | `/app.js`, `/api.php` |

---

## Zugriff

### Lokal (Codespace/Dev-Container)

```bash
# Alle Services starten
bash scripts/start-services.sh

# Dashboard öffnen
# Lokal: http://localhost:8080
# Remote/Codespaces: https://[user]-8080.app.github.dev/
```

### Was prüft das Dashboard?

#### 1. PHP → MySQL (`http://localhost:8080`)

**Status-Anzeige:** z. B. `OK, demo_items=3`

```php
// PHPphp
$mysqli = new mysqli($mysqlHost, $mysqlUser, $mysqlPass, $mysqlDb);
$result = $mysqli->query('SELECT COUNT(*) FROM demo_items');
echo 'OK, demo_items=' . $count;
```

**Fehler-Szenarien:**
- `Fehler: Connection refused` → MySQL läuft nicht
- `Fehler: Access denied` → Zugangsdaten falsch

#### 2. JavaScript → Python-API

**Status-Anzeige:** JSON mit Service-Status

```javascript
// Browser ruft lokal /api.php auf (PHP-Proxy)
fetch('/api.php?endpoint=health')
  .then(r => r.json())
  .then(data => console.log(data))
```

**Antwort:**
```json
{
  "service": "python-api",
  "status": "ok",
  "mysql": {
    "demo_items": 3,
    "ok": true
  },
  "json_loaded": true
}
```

---

## Architektur: PHP-Proxy für API-Aufrufe

### Problem (vorher)

JavaScript-Fetch vom Browser → Python-API direkt:
```js
fetch('http://localhost:8000/health')  // ❌ CORS, Port-Probleme
```

**Fehler in Remote-Umgebungen:**
- `Failed to fetch`: Browser kann nicht auf `http://localhost:8000` zugreifen
- CORS-Probleme bei unterschiedlichen Protokollen (https ↔ http)
- Port-Routing-Probleme in Codespaces

### Lösung (jetzt)

**PHP-Proxy als Vermittler:**

```
Browser
  ↓ fetch('/api.php?endpoint=health')
PHP Container (Port 8080)
  ↓ curl/file_get_contents('http://python-api:8000/health')
Python-API Container (Port 8000)
  ↓ JSON Response
```

### Implementierung

**Datei:** `webapp/public/api.php`

```php
<?php
$endpoint = $_GET['endpoint'] ?? '';
$allowed = ['health', 'json-items'];

if (!in_array($endpoint, $allowed, true)) {
    http_response_code(404);
    echo json_encode(['error' => 'Unknown endpoint']);
    exit;
}

$backendHost = getenv('PYTHON_API_BACKEND') ?: 'http://python-api:8000';
$backendUrl = rtrim($backendHost, '/') . '/' . $endpoint;

// Forward request zu Python-API
$body = file_get_contents($backendUrl);
http_response_code(200);
echo $body;
?>
```

**Datei:** `webapp/public/app.js`

```javascript
const apiProxyUrl = "/api.php";

async function loadStatus() {
  try {
    const [healthResp, jsonResp] = await Promise.all([
      fetch(`${apiProxyUrl}?endpoint=health`),
      fetch(`${apiProxyUrl}?endpoint=json-items`),
    ]);
    
    const health = await healthResp.json();
    const jsonData = await jsonResp.json();
    
    console.log({ health, jsonData });
  } catch (err) {
    console.error('API Error:', err.message);
  }
}
```

---

## Service-Tests ausführen

### Option 1: Kompletter Dienst-Test

```bash
bash scripts/test-services.sh
```

**Prüft:**
- Python-Health ✅
- Python-JSON ✅
- PHP-Webseite ✅
- MySQL Datenbankzugriff ✅
- Java Smoke-Tests (falls vorhanden)

**Ausgabe:**
```
[test] Pruefe Python-Health...
{"service":"python-api","status":"ok",...}

[test] Pruefe MySQL in Container...
demo_items_count
3

[test] Alle Checks erfolgreich
```

### Option 2: Einzelne Endpoints testen

```bash
# Python-API Health
curl http://localhost:8000/health

# Python-API JSON
curl http://localhost:8000/json-items

# PHP-Proxy Health
curl http://localhost:8080/api.php?endpoint=health

# PHP-Proxy JSON
curl http://localhost:8080/api.php?endpoint=json-items

# MySQL Query
docker compose exec -T mysql mysql -u appuser -p userpass123 appdb \
  -e "SELECT COUNT(*) FROM demo_items;"
```

---

## Fehlerbehandlung

| Fehler | Ursache | Lösung |
|---|---|---|
| `Connection refused` (PHP) | MySQL läuft nicht | `docker compose ps` prüfen, ggf. `docker compose restart mysql` |
| `Failed to fetch` (JS) | API nicht erreichbar | `curl http://localhost:8000/health` prüfen |
| `Error 502` (PHP-Proxy) | Python-Backend offline | `docker compose logs python-api` prüfen |
| `CORS error` (JS) | Cross-Origin-Block | Sollte mit Proxy nicht auftreten; CORS in Python-API ist konfiguriert |

### Debugging

```bash
# Alle Logs anschauen
docker compose logs --tail=50 -f

# Spezifische Container-Logs
docker compose logs php-web
docker compose logs python-api
docker compose logs mysql

# Container-Shell öffnen
docker compose exec php-web bash
docker compose exec python-api ash
docker compose exec mysql bash
```

---

## Integration mit Projekt-Website

Die Hauptprojekt-Website (`/Projekt_Fohlenhof Matzenweiler/index.php`) kann ebenfalls auf den API-Proxy zugreifen:

```php
// In Projekt-PHP:
$health = file_get_contents('http://localhost:8080/api.php?endpoint=health');
$data = json_decode($health, true);
```

---

## Weitere Ressourcen

- **[java-live-test.md](java-live-test.md)** – Java-App-Tests
- **[live-entwicklung-anleitung.md](../anleitungen/live-entwicklung-anleitung.md)** – Entwicklungs-Workflow
- **[ARCHITEKTUR.md](../ARCHITEKTUR.md)** – System-Design
