# Fohlenhof Matzenweiler

**Webprojekt für den Fohlenhof in Kißlegg im Allgäu** - Eine moderne Webanwendung mit Full-Stack-Technologien für die Präsentation und Verwaltung des Hofes.

> Für Live-Entwicklung und Testing im GitHub Codespace

---

## 📋 Überblick

Das System implementiert eine **vollständige Webpräsenz** für den Fohlenhof Matzenweiler mit folgenden Kernfunktionen:

| Feature | Status | Details |
|---------|--------|---------|
| **Responsive Website** | ✅ | PHP-basiert, mobile-optimiert |
| **Kostenrechner** | ✅ | Mit Datenbankanbindung für Berechnungen |
| **Bildergalerie** | ✅ | Automatische Anzeige von Hof-Bildern |
| **Datenbankintegration** | ✅ | MySQL mit normalisierter Struktur |
| **API-Backend** | ✅ | Python Flask für Datenverarbeitung |
| **Docker-Umgebung** | ✅ | Vollständige Containerisierung |
| **Live-Entwicklung** | ✅ | Permanente Testumgebung im Codespace |

---

## 🚀 Schnellstart

Für eine **schnelle Einrichtung und Live-Entwicklung** im Codespace folgen Sie der [Live-Entwicklung-Anleitung](docs/anleitungen/live-entwicklung-anleitung.md).

### Kurzanleitung:
1. `./scripts/bootstrap.sh` (Umgebung initialisieren)
2. `.env` bearbeiten (Passwörter setzen)
3. `./scripts/start-services.sh` (Dienste starten)
4. **Testen**: http://localhost:8080/Projekt_Fohlenhof%20Matzenweiler/

---

## 🏗️ Architektur

```
PHP-Webapp (Frontend - responsive)
    ↓
Python-API (Backend - RESTful)
    ↓
MySQL-Datenbank (Persistent Storage)
```

**Technologie-Stack:**
- 🌐 PHP (Web-Frontend mit MVC)
- 🐍 Python Flask (API-Backend)
- 🐘 MySQL (Datenbank)
- 🐳 Docker (Containerisierung)
- 💾 MySQL (Datenbank)

---

## 📚 Dokumentation

### Wichtige Dokumente

| Dokument | Beschreibung |
|----------|-------------|
| [Live-Entwicklung-Anleitung](docs/anleitungen/live-entwicklung-anleitung.md) | ⭐ **Schnellstart & Testumgebung** |
| [PFLICHTENHEFT.md](docs/handbuch/PFLICHTENHEFT.md) | Systemanforderungen & Spezifikationen |
| [ARCHITEKTUR.md](docs/handbuch/ARCHITEKTUR.md) | Technische Architektur & Diagramme |
| [Handbuch Index](docs/handbuch/INDEX.md) | Übersicht aller Dokumentationen |

---

## 🛠️ Entwicklung

### Projektstruktur
```
├── docker-compose.yml          # Dienst-Orchestrierung
├── scripts/                    # Hilfsskripte
├── services/python-api/        # Python-Backend
├── webapp/public/              # PHP-Frontend
├── docker/mysql/init/          # Datenbank-Schema
└── docs/                       # Dokumentation
```

### Lokale Entwicklung
1. Repository klonen
2. `./scripts/bootstrap.sh` ausführen
3. `.env` konfigurieren
4. `./scripts/start-services.sh` starten
5. Entwickeln & testen!

### Qualitätsgates
Vor jedem Commit:
```bash
./scripts/validate-security.sh
./scripts/validate-architecture.sh
./scripts/validate-docs.sh
```

### 3. Services starten
```bash
bash scripts/start-services.sh
```

### Services testen
- **PHP-Webapp:** http://localhost:8080/Projekt_Fohlenhof%20Matzenweiler/
- **Python-API:** http://localhost:8000/health
- **MySQL:** localhost:3306

---

## ✅ Qualitätsgates

Alle Änderungen müssen die Validierungen bestehen:

```bash
# Sicherheitsprüfung
./scripts/validate-security.sh

# Architekturprüfung
./scripts/validate-architecture.sh

# Dokumentationsprüfung
./scripts/validate-docs.sh
```

---

## 📦 Projektstruktur

```
├── webapp/public/Projekt_Fohlenhof Matzenweiler/  # PHP-Frontend (MVC)
├── services/python-api/          # Python-Backend (Flask)
├── docker/mysql/init/            # Datenbank-Schema
├── scripts/                      # Automatisierungsskripte
├── docs/handbuch/                # Detaillierte Dokumentation
├── docs/anleitungen/             # Anleitungen
└── docker-compose.yml            # Dienst-Orchestrierung
```

---

## 🔒 Sicherheit

Das System implementiert mehrschichtige Sicherheit:

- **Application Security:**
  - Input-Validierung & Sanitization
  - SQL-Injection Prevention
  - XSS-Prevention
  - CSRF-Schutz
  - Sichere Authentifizierung

- **Operational Security:**
  - Tägliche Backups
  - Audit-Logging
  - Secrets-Management
  - SSL/TLS Encryption
  - Monitoring & Alerting

Mehr Details im [PFLICHTENHEFT.md](docs/handbuch/PFLICHTENHEFT.md#fa6-sicherheit-security--safety)

---

## 🧪 Testing & Quality Assurance

- **Unit Tests:** Python (pytest), JavaScript (Jest), Java (JUnit)
- **Integration Tests:** API-Endpoints
- **End-to-End Tests:** Kritische User-Flows
- **Performance Tests:** Dokumentiert
- **Live-Testumgebung:** Permanent verfügbar

---

## 🤝 Contributing

### Workflow
1. Feature Branch erstellen
2. Code schreiben (mit Tests!)
3. Alle Quality Gates bestehen lassen
4. Pull Request mit Beschreibung
5. Code Review & Merge

### Style Guide
- Clean Code Prinzipien
- DRY (Don't Repeat Yourself)
- SOLID Principles
- Konsistente Namenskonventionen

---

## 📝 Änderungsprotokoll

Siehe [CHANGELOG.md](CHANGELOG.md) für alle Versionen und Updates.

---

## 📄 Lizenz

[LICENSE](LICENSE)

---

## 📞 Support & Kontakt

Für Fragen oder Probleme:
1. Siehe [Handbuch](docs/handbuch/)
2. Check [PFLICHTENHEFT.md](docs/handbuch/PFLICHTENHEFT.md)
3. Öffne ein Issue auf GitHub

---

**Status:** ✅ Produktionsreif | **Version:** 2.0 | **Last Updated:** 14. April 2026
