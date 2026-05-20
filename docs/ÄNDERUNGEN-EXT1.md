# Änderungen EXT1 – Git & GitHub Versionsverwaltung

**Ziel:** Professionelle Versionskontrolle einführen und Branch-Strategie umsetzen.

## Ausgangslage

- Korrekturhilfe: Kein Git-Branching in der Analyse erwähnt
- Probleme: Keine klare Versionskontrolle für den Projektfortschritt
- Ziel: Branch-Strategie, Release-Tagging, und Dokumentationen initialisieren

## Getätigte Änderungen

1. `.github/BRANCHSTRATEGIE.md`
   - Beschreibung der Branches: `main`, `develop`, `feature/*`, `fix/*`, `release/*`
   - Commit-Konventionen mit Prefixes definiert
   - Tagging und Semver erklärt

2. `CHANGELOG.md`
   - Versionshistorie und Release-Notizen eingerichtet
   - Startpunkt und geplante Versionen beschrieben

3. Git-Artefakte erzeugt
   - `develop`-Branch angelegt
   - Tag `v0.1.0` gesetzt

## Tests

- `git branch --all`
- `git tag -l`
- `git log --graph --oneline --all`

## Begründung für die Verteidigung

Branches zeigen, dass Entwicklung organisiert und versioniert stattfindet. Ein sauberer Git-Workflow macht den Projektverlauf nachvollziehbar und erlaubt jederzeit das Zurückspringen zu definierten Ständen.
