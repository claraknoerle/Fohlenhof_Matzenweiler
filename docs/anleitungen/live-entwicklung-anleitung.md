# Anleitung für Live-Entwicklung im Codespace

Diese Anleitung beschreibt, wie Sie das Fohlenhof-Matzenweiler-Projekt im GitHub Codespace live entwickeln und testen können.

## Voraussetzungen

- GitHub Codespace mit Ubuntu 24.04.4 LTS
- Docker und Docker Compose verfügbar
- Node.js, npm, PHP, Python vorinstalliert

## Schritt-für-Schritt-Anleitung

### 1. Projekt initialisieren

Führen Sie das Bootstrap-Skript aus, um die Umgebung vorzubereiten:

```bash
./scripts/bootstrap.sh
```

Dies erstellt die `.env`-Datei aus `.env.example`.

### 2. Umgebungsvariablen konfigurieren

Bearbeiten Sie die `.env`-Datei und setzen Sie sichere Passwörter:

```bash
nano .env
```

Stellen Sie sicher, dass die folgenden Variablen gesetzt sind:
- `MYSQL_ROOT_PASSWORD`
- `MYSQL_PASSWORD`
- `MYSQL_USER`
- `MYSQL_DATABASE`
- `MYSQL_HOST`
- `MYSQL_PORT`
- `PYTHON_API_PORT`
- `PHP_WEB_PORT`

### 3. Dienste starten

Starten Sie alle Dienste mit Docker Compose:

```bash
./scripts/start-services.sh
```

Dies startet:
- MySQL-Datenbank (Port 3306)
- Python-API (Port 8000)
- PHP-Webserver (Port 8080)

### 4. Projekt testen

#### Webbrowser-Test
Öffnen Sie im Browser:
- **PHP-Webapp**: http://localhost:8080/Projekt_Fohlenhof%20Matzenweiler/
- **Python-API**: http://localhost:8000/health

#### Datenbank-Test
Verbinden Sie sich mit der Datenbank:

```bash
mysql -h localhost -P 3306 -u appuser -p appdb
```

Passwort aus `.env` verwenden.

### 5. Entwicklung durchführen

#### PHP-Änderungen
- Bearbeiten Sie Dateien in `webapp/public/Projekt_Fohlenhof Matzenweiler/`
- Änderungen sind sofort sichtbar (kein Neustart nötig)

#### Datenbank-Änderungen
- Bearbeiten Sie `docker/mysql/init/01-init.sql`
- Starten Sie die Container neu:

```bash
docker compose down
docker compose up -d --build
```

#### Python-API-Änderungen
- Bearbeiten Sie `services/python-api/app.py`
- Container neu starten:

```bash
docker compose restart python-api
```

### 6. Debugging

#### Logs anzeigen
```bash
docker compose logs -f [service-name]
```

#### Container-Status prüfen
```bash
docker compose ps
```

#### In Container wechseln
```bash
docker compose exec [service-name] bash
```

### 7. Dienste stoppen

```bash
./scripts/stop-services.sh
```

## Architektur-Übersicht

- **MySQL**: Datenbank für persistente Daten
- **Python-API**: REST-API für Datenverarbeitung
- **PHP-Webapp**: Frontend mit MVC-Architektur
- **Docker Compose**: Orchestrierung der Dienste

## Erweiterte Features

- **Datenbankanbindung**: Das PHP-Projekt verwendet PDO für MySQL-Verbindungen
- **Berechnungshistorie**: Berechnungen werden in der Datenbank gespeichert
- **Normalisierte Datenbank**: Strukturierte Tabellen für skalierbare Entwicklung

## Sicherheitshinweise

- Verwenden Sie starke Passwörter in `.env`
- Committen Sie `.env` nicht ins Repository
- Führen Sie regelmäßig Sicherheitsvalidierungen durch:

```bash
./scripts/validate-security.sh
./scripts/validate-architecture.sh
./scripts/validate-docs.sh
```

## Troubleshooting

### Container starten nicht
- Prüfen Sie `.env`-Datei auf korrekte Werte
- Logs: `docker compose logs`

### PHP-Fehler
- Prüfen Sie Apache-Logs: `docker compose logs php-web`
- PDO-Verbindung prüfen

### Datenbank-Verbindung fehlgeschlagen
- MySQL-Healthcheck: `docker compose ps`
- Netzwerk: `docker network ls`

Für weitere Hilfe konsultieren Sie die Projekt-Dokumentation in `docs/handbuch/`.</content>
<parameter name="filePath">/workspaces/Fohlenhof_Matzenweiler/docs/anleitungen/live-entwicklung-anleitung.md