# Git Branchstrategie & Versionskontrolle

**Dokumentversion:** 1.0  
**Gültig ab:** 7. Mai 2026  
**Ziel:** Professionelle Versionierung, Nachvollziehbarkeit, Rückspulbarkeit

---

## 🎯 Überblick: Git Flow Strategie

Diese Projektversion nutzt eine **Git-Flow-Variante** für klare Struktur und Nachvollziehbarkeit in der Verteidigung.

### Branch-Hierarchie

```
main (Produktionsstand, Tag-Release)
  ↑
  └─ release/vX.Y.Z (Bugfixes vor Release)
    ↑
develop (Entwicklungsstand)
  ↑
  ├─ feature/erweiterung-formular (Feature sind separate Branches)
  ├─ feature/algorithmen-suchen  
  ├─ feature/async-operationen
  ├─ fix/responsive-design (Hotfixes für Quality)
  └─ fix/bildnachweis-lizenzen (Bugfixes für Kriterium J1)
```

---

## 📋 Branch-Regeln (Verbindlich)

### **main** (Production-Release)
- **Vor Merge:** Muss von `develop` oder `release/*` kommen
- **Tag:** Immer `vX.Y.Z` (z.B. `v1.0.0`, `v1.1.0`)
- **Merges:** Nur via Merge-Commit, keine Rebase
- **Commit-Message:** `Release: vX.Y.Z – [Kurz-Beschreibung]`
- **Doku:** CHANGELOG.md + VERTEIDIGUNG.md müssen aktuell sein
- **Zweck:** Zeigt den stabilen, verteidigungsfähigen Stand

**Beispiel:**
```bash
git checkout develop
# ... Work done ...
git checkout -b release/v1.0.0
# Bugfixes & Version-Bump
git commit -m "Release: v1.0.0 – Kriterium D1,I1,J1 erfüllt, Algorithmen-Grundlage"
git checkout main
git merge --no-ff release/v1.0.0
git tag -a v1.0.0 -m "Version 1.0.0: Formales verbesert, Design responsive, Lizenzen dokumentiert"
git checkout develop
git merge --no-ff release/v1.0.0
```

---

### **develop** (Entwicklungs-Snapshot)
- **Vor Merge:** Kommt von abgeschlossenen `feature/*` oder `fix/*` Branches
- **Merges:** Nur `--no-ff` (Merge-Commits), um Historie sichtbar zu halten
- **Commit-Message:** `Merge branch 'feature/...': [Kurz-Beschreibung]`
- **Status:** Muss compilierbar und laufbar sein
- **Doku:** Jeder Merge aktualisiert CHANGELOG.md und Kriteriums-Matrix
- **Zweck:** Zeigt, was seit letztem Release erarbeitet wurde

**Beispiel:**
```bash
git checkout feature/erweiterung-formular
# ... Work – jeder Commit mit `[FEAT-xy]`, `[FIX-xy]`, `[DOCS-xy]` Prefix ...
git commit -m "[FEAT-D1] Bildergalerie: CSS Grid für responsive Layout"
git checkout develop
git merge --no-ff feature/erweiterung-formular -m "Merge branch 'feature/erweiterung-formular': Galerie mit D1-Kriterium erfüllt"
```

---

### **feature/[\*]** (Features & Erweiterungen)
- **Naming:** `feature/kurzbeschreibung` (z.B. `feature/erweiterung-formular`)
- **Basis:** Immer von `develop` starten (`git checkout -b feature/... origin/develop`)
- **Commits:** aussagekräftig, mit Prefix: `[FEAT-xy]`, `[REFACTOR]`, `[DOCS]`
- **Code-Reviews:** Jeder Feature-Commit sollte:
  - Funktioniert am Browser testen
  - In ÄNDERUNGEN.md dokumentiert (Warum? Was? Wie?)
  - PhpCompatibility prüfen (mit Syntax-Check)
- **Merge-Ziel:** `develop`, Merge-Strategie: `--no-ff`
- **Doku:** README.md, CHANGELOG.md, relevante Fachseiten updaten

**Beispiel Feature-Workflow:**
```bash
# Feature starten
git checkout -b feature/erweiterung-formular origin/develop

# Arbeiten: mehrere Commits mit Beschreibung
git commit -m "[FEAT-E1] Formular: Input-Validierung in PHP"
git commit -m "[DOCS-E1] Validierungs-Logik in Kommentaren erklärt"
git commit -m "[REFACTOR] FormController: separate validate() Methode"

# Zum Merge vorbereiten
git checkout develop
git pull origin develop
git merge --no-ff feature/erweiterung-formular

# Lokalem Branch löschen
git branch -d feature/erweiterung-formular
```

---

### **fix/[\*]** (Bugfixes für Kriterien & Quality)
- **Naming:** `fix/kurzbeschreibung` (z.B. `fix/responsive-design`)
- **Basis:** Immer von `develop` starten
- **Ziel:** Verbessert konkrete Fehler / erfüllt fehlende Kriterien
- **Commits:** Mit Prefix `[FIX-xy]`, exakt beschreibend
- **Doku:** ReparaturPlan.md mit Vor/Nach, Test-Evidence
- **Merge:** In `develop`, danach ggf. nach `main` (bei kritischen Fehlern)

---

### **release/[\*]** (Vorbereitung auf Version)
- **Naming:** `release/vX.Y.Z` (z.B. `release/v1.0.0`)
- **Basis:** Von `develop` starten
- **Nur:** Version-Bugfixes, CHANGELOG & VERTEIDIGUNG docs finalisieren
- **Merge:** Nach `main` (mit Tag), dann zurück in `develop`
- **Commits:** `[RELEASE]` Prefix, minimal

---

## 🔄 Versions-Nummering (Semver)

Format: **vX.Y.Z**

- **X (Major):** Große Erweiterungen (z.B. neue Kriterium erfüllt)
- **Y (Minor):** Features/Bugfixes (z.B. Design-Verbesserung)
- **Z (Patch):** Kleinere Fixes (z.B. Typos, CSS Feinjustierung)

**Beispiel-Progression:**
- `v0.1.0`: Initiales Projekt eingecheckt
- `v0.2.0`: Erweiterung 1 (Git-Strategie) abgeschlossen
- `v1.0.0`: Alle Kriterien + Erweiterung 2 (Algorithmen) erfüllt → Reife zur Verteidigung
- `v1.0.1`: Bugfix nach Verteidigungsfeedback
- `v1.1.0`: Neue Feature nach Abgabefristen

---

## 📝 Commit-Nachricht Standard

**Format:**
```
[PREFIX-KriterienID] Kurztitel (max 50 Zeichen)

Detaillierte Beschreibung (max 72 Zeichen pro Zeile):
- Was wurde genau geändert?
- Warum war diese Änderung nötig?
- Wie kann die Änderung getestet werden?
- Welche Dateien wurden touched? (Kurze Auflistung)
- Welches Kriterium wird verbessert?

Bezug: Kriterium [A1|B1|C1|D1|E1|F1|H1|I1|J1] / Erweiterung [Git|Algorithmen]
```

**Konkrete Beispiele:**

```
[FEAT-D1] Bildergalerie mit CSS Grid implementiert

Diese Commit integriert CSS Grid für die Bildergalerie,
um das D1-Kriterium (Bilder und Galerie) zu erfüllen.

Änderungen:
- Neue Datei: layouts/galerie.php (HTML-Struktur mit img-Container)
- Update: css/galerie.css (Grid: 3 Spalten responsive)
- Update: controllers/RechnerController.php (getGalleryImages() Methode)

Test: Browser öffnen → Galerie-Seite laden → Bilder im Grid sichtbar
Bezug: Kriterium D1 (3/3 Teilregeln erfüllt nach dieser Commit)
```

```
[FIX-I1] @media Queries für Responsive Design hinzugefügt

Das I1-Kriterium (Farbgestaltung und Design) erfordert
@media-Queries für responsive Layouts.

Änderungen:
- Update: css/styles.css (4 Breakpoints: 320px, 768px, 1024px, 1440px)
- Update: css/galerie.css (@media Grid-Anpassungen)
- Test: Responsiv-Check in Chrome DevTools + iPhone/Tablet simuliert

Bezug: Kriterium I1 / Validierungs-Anforderung @media\s*\(
```

```
[DOCS-J1] Bildnachweis und Lizenzen in Bebilderungen dokumentiert

J1-Kriterium (Sonstige Features) erfordert Bildnachweis,
Quelle und ggf. Lizenz für alle Bilder.

Änderungen:
- Update: layouts/galerie.php (Bild-Metadaten mit <figcaption>)
- Neue Datei: docs/BILDQUELLEN.md (vollständiges Quellenverzeichnis)
- Update: layouts/footer.php (Link zu BILDQUELLEN.md)

Bezug: Kriterium J1 / Bildnachweis-Regex Anforderung
```

---

## 🔐 Branch-Schutz (Empfohlen für Remote-Repo)

Falls GitHub/GitLab remote: Diese Regeln per Admin-Settings aktivieren:

- **main:** Mindestens 1 Review, CODEOWNERS müssen approven
- **develop:** Mindestens 1 Review vor Merge
- **feature/\*:** Keine Regel (schnelle Entwicklung)
- **release/\*:** Mindestens 2 Reviews (für Qualität)

---

## 📅 Workflow-Beispiel: Woche 1–2 (Git + Responsive)

### Tag 1: Initialisierung
```bash
# Repository initialisieren (falls noch nicht geschehen)
git init
git add .
git commit -m "[INIT] Projekt-Grundlage eingecheckt (Clara Web-Projekt)"

# main/develop Branches aufsetzen
git branch develop
git push -u origin develop

# Ersten Release vorbereiten
git checkout -b release/v0.1.0
git tag v0.1.0
git push -u origin main
git push --tags
```

### Tag 2–3: Feature-Branch Erweiterung 1 (Git-Strategie)
```bash
git checkout -b feature/git-dokumentation origin/develop
# Edits: README.md, BRANCHSTRATEGIE.md, etc.
git commit -m "[DOCS] Git-Workflow und Branchstrategie dokumentiert"
git checkout develop
git merge --no-ff feature/git-dokumentation
```

### Tag 4–14: Feature-Branches für Kriterium-Fixes

```bash
# Fix für Kriterium I1 (Responsive Design)
git checkout -b fix/responsive-design origin/develop
# Edits: css/styles.css, @media Queries
git commit -m "[FIX-I1] @media Queries für alle Breakpoints"
git checkout develop
git merge --no-ff fix/responsive-design

# Feature für Kriterium D1 (Galerie)
git checkout -b feature/bildergalerie-d1 origin/develop
# Edits: layouts/galerie.php, css/galerie.css
git commit -m "[FEAT-D1] Bildergalerie CSS Grid implementiert"
git checkout develop
git merge --no-ff feature/bildergalerie-d1

# Fix für Kriterium J1 (Bildquellen)
git checkout -b fix/bildnachweis-quellen origin/develop
# Edits: docs/BILDQUELLEN.md, layouts/galerie.php
git commit -m "[FIX-J1] Vollständiger Bildnachweis und Lizenzen dokumentiert"
git checkout develop
git merge --no-ff fix/bildnachweis-quellen
```

### Tag 15: Release vorbereiten
```bash
git checkout -b release/v1.0.0 develop
# CHANGELOG.md, VERTEIDIGUNG.md aktualisieren
git commit -m "[RELEASE] v1.0.0 – Kriterien A1,D1,I1,J1 verbessert"
git checkout main
git merge --no-ff release/v1.0.0
git tag -a v1.0.0 -m "Version 1.0.0: Kriterium-Fixes + Git-Dokumentation"
git checkout develop
git merge --no-ff release/v1.0.0
git push origin main develop --tags
```

---

## 🛠️ Git-Befehle Kurzreferenz

Alle wichtigen Commits/Branches aus dieser einen Strategie-Datei:

```bash
# Neuer Feature starten
git checkout -b feature/NAME origin/develop

# Commits mit Prefix
git commit -m \"[FEAT-Xy] Beschreibung\"

# Feature fertig → Merge in develop
git checkout develop
git pull origin develop
git merge --no-ff feature/NAME

# Entwicklungsstand → Release-Vorbereitung
git checkout -b release/vX.Y.Z develop

# Release → main
git checkout main
git merge --no-ff release/vX.Y.Z
git tag -a vX.Y.Z -m \"Version X.Y.Z\"

# Tag auf Remote
git push origin main develop --tags

# Bisherige Tags ansehen
git tag -l

# Zu bestimmter Version zurück (lokal ansehen)
git checkout vX.Y.Z

# Zu Hauptzweig zurück
git checkout main
```

---

## ✅ Checkliste: Branch-Setup vollständig?

- [ ] `.github/BRANCHSTRATEGIE.md` gelesen & verstanden
- [ ] Repository initialisiert (`git init`)
- [ ] `develop` Branch erstellt (`git branch develop`)
- [ ] Erste Commits mit Prefixes labeln (`[INIT]`, `[DOCS]`)
- [ ] Releases als Tags auf `main` markieren (`git tag vX.Y.Z`)
- [ ] Lokal testen: `git log --graph --oneline --all` zeigt Branch-Struktur
- [ ] Remote: `git push origin main develop --tags` (falls GitHub Remote)
- [ ] Diese Datei im REPO commiten: `git commit -m "[DOCS] Branchstrategie dokumentiert"`

---

## 📚 Weiterführende Quellen

- [Git Book: Branching & Merging](https://git-scm.com/book/de/v2/Git-Branches)
- [Atlassian: Git Flow](https://www.atlassian.com/de/git/tutorials/comparing-workflows/gitflow-workflow)
- [Semantic Versioning](https://semver.org/lang/de/)
- `man git-flow` (falls git-flow Plugin installiert)

---

**Fragen?** Diese Branchstrategie ist in diesem Repository gültig bis zum Projekt-Release (v1.0.0 als Verteidigungsstand).
