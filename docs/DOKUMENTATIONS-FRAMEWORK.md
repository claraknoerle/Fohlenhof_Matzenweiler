# Dokumentations-Framework für Änderungen

**Ziel:** Jede Änderung am Projekt (Code, Konfiguration, Design) ist vollständig dokumentiert und erklärt, so dass die Verteidigungskommission jederzeit die Begründung nachvollziehen kann.

**Motto:** _SSOT (Single Source of Truth) – Jede Information genau einmal, vollständig und nachvollziehbar._

---

## 📋 Dokumentations-Struktur

Folgende Dateien müssen bei jeder Änderung aktualisiert werden:

### 1. **ÄNDERUNGEN-[Kriterium].md** (Pro Kriterium)

**Zweck:** Detaillierte Dokumentation aller Änderungen für ein spezifisches Kriterium.

**Dateien:**
- `docs/ÄNDERUNGEN-A1.md` – Formales & Syntax-Validierung
- `docs/ÄNDERUNGEN-D1.md` – Bildergalerie
- `docs/ÄNDERUNGEN-I1.md` – Responsive Design
- `docs/ÄNDERUNGEN-J1.md` – Bildquellen & Lizenzen
- `docs/ÄNDERUNGEN-EXT1.md` – Git & GitHub
- `docs/ÄNDERUNGEN-EXT2.md` – Algorithmen

**Template:**
```markdown
# Änderungen: Kriterium [Name]

**Ziel:** [Was wird erreicht]  
**Priorität:** 🔴 HOCH / 🟡 MITTEL / 🟢 NIEDRIG  
**Branch:** feature/[name] oder fix/[name]  
**Status:** ⏳ In Arbeit / ✅ Abgeschlossen / 🔄 Review  

## Ausgangslage

[Warum wurde diese Änderung nötig?]

## Änderungen im Überblick

| Datei | Änderung | Begründung |
|-------|----------|------------|
| `webapp/public/css/styles.css` | 50 Zeilen @media-Queries hinzugefügt | I1-Kriterium erfordert responsive Design |
| `docs/handbuch/ARCHITEKTUR.md` | Neuer Abschnitt "Responsive-Strategie" | Dokumentation erweitern |

## Detaillierte Änderungen

### 1. `webapp/public/css/styles.css` (Update)

**Was:** Responsive Design @media-Queries  
**Zeilen:** 1200–1250 (neu)  
**Begründung:** I1-Kriterium: "Regex '@media\s*\(' in CSS-Datei muss gefunden werden"

**Vorher:**
```css
nav { display: flex; flex-direction: row; }
```

**Nachher:**
```css
nav { display: flex; flex-direction: row; }
@media (max-width: 768px) {
  nav { flex-direction: column; }
}
```

**Test:** Browser DevTools → Responsive Mode → iPhone 12 auswählen → nav vertikal?

### 2. `docs/BILDQUELLEN.md` (Neue Datei)

**Was:** Vollständiges Bildquellen-Verzeichnis  
**Inhalt:**
```markdown
# Bildquellen & Lizenzen

## Galerie-Bilder

### img-001-heuballen.jpg
- Quelle: Pixabay
- URL: [Link]
- Lizenz: CC0 Public Domain
```

**Begründung:** J1-Kriterium verlangt Bildnachweis für alle Bilder.

## Tests & Validierung

- [ ] **Test 1:** Browser-Test → Responsive Layout funktioniert auf Mobile (390px)?
- [ ] **Test 2:** CSS-Regex-Check → `grep "@media" css/styles.css` gibt Hits zurück?
- [ ] **Test 3:** Bildquellen vorhanden → `grep -r "pixabay\|unsplash" docs/`?

## Commits

1. `[FIX-I1] @media-Queries für responsive Design hinzugefügt`
2. `[DOCS-J1] Bildquellen-Verzeichnis angelegt`

## Checkpoint für Verteidigung

- [ ] Zeige @media-Queries im Code
- [ ] Erkläre Breakpoints (1200px, 768px, 480px)
- [ ] Demonstriere responsive Layout im Browser
- [ ] Zeige Bildquellen-Dokumentation

## Weitere Ressourcen

- Marschplan: docs/OPTIMIERUNGS-ROADMAP.md → Abschnitt I1
- Branch-Strategie: .github/BRANCHSTRATEGIE.md
- Verteidigungsleitfaden: docs/VERTEIDIGUNG.md → Teil "I1 – Responsive Design"
```

---

### 2. **CHANGELOG.md** (Master-Datei)

**Zweck:** Übersicht aller Versionen mit Highlights.

**Aktualisierung:** Nach jedem Release (v0.2.0, v1.0.0, etc.)

**Format:**
```markdown
## [1.0.0] – 2026-06-XX

### ✨ Neue Features
- D1 erfüllt: Bildergalerie
- I1 erfüllt: Responsive Design

### 🐛 Bugfixes
- J1: Bildquellen dokumentiert

### 📚 Dokumentation
- ÄNDERUNGEN-D1.md
- ÄNDERUNGEN-I1.md
```

---

### 3. **docs/handbuch/ARCHITEKTUR.md** (Projekt-Übersicht)

**Zweck:** Struktur, MVC, Datenfluss erklären.

**Abschnitte:**
- Verzeichnisstruktur
- MVC-Pattern: Model → Controller → View Flows
- Datenbank-Schema (falls vorhanden)
- CSS-Strategie (Breakpoints, Grid vs. Flexbox)

**Update:** Wenn neue Komponenten hinzugefügt werden

---

### 4. **docs/handbuch/ALGORITHMEN.md** (für EXT2)

**Zweck:** Pseudocode, Flussdiagramme, Komplexitäts-Analyse.

**Struktur:**
```markdown
# Algorithmen in diesem Projekt

## 1. Lineare Suche

### Pseudocode
```
FOR i = 0 TO array.length-1
  IF array[i] == target
    RETURN i
RETURN -1
```

### Flussdiagramm
[ASCII-Diagram oder Mermaid]

### Komplexität: O(n)
- Best Case: O(1) – Element auf Position 0
- Worst Case: O(n) – Element nicht vorhanden

## 2. Bubble Sort

[Ähnliche Struktur]
```

---

### 5. **docs/BILDQUELLEN.md** (für J1)

**Zweck:** Vollständiges Bildquellenverzeichnis.

**Struktur:**
```markdown
# Bildquellen & Lizenzen

| Bildname | Quelle | Autor | Lizenz | Link |
|----------|--------|-------|--------|------|
| heuballen.jpg | Pixabay | [Name] | CC0 | [URL] |
```

---

### 6. **docs/VERTEIDIGUNG.md** (Präsentation)

**Zweck:** Leitfaden für mündliche Verteidigung.

**Wird aktualisiert:** Nach Phase 2 (Erweiterungen abgeschlossen)

---

### 7. **README.md** (Projekt-Einstieg)

**Zweck:** Schneller Überblick, Installation, Features.

**Sollte enthalten:**
- Kurzbeschreibung
- Installation (docker-compose)
- Features-Liste
- Verwendete Technologien
- Links zu Dokumentation
- Screenshot

---

## 🔄 Dokumentations-Workflow

```
1. Feature starten (z.B. I1 – Responsive)
   ├─ Branch erstellen: git checkout -b fix/responsive-design-i1
   │
2. Code schreiben + Testen
   ├─ CSS @media-Queries schreiben
   ├─ Browser-Test (responsive)
   │
3. Commit mit Prefix
   ├─ git commit -m "[FIX-I1] @media Queries für Responsive Design"
   │
4. Dokumentation parallel aktualisieren
   ├─ docs/ÄNDERUNGEN-I1.md schreiben (Detailansicht)
   ├─ docs/VERTEIDIGUNG.md updaten (Präsentations-Hinweise)
   ├─ CHANGELOG.md updaten (Kurzversion)
   │
5. Feature-Branch → develop
   ├─ git checkout develop
   ├─ git merge --no-ff fix/responsive-design-i1
   │
6. Validierung
   ├─ bash scripts/validate-architecture.sh
   ├─ bash scripts/validate-docs.sh
   │
7. Release vorbereiten
   ├─ git checkout -b release/v0.2.0
   ├─ CHANGELOG.md & docs/VERTEIDIGUNG.md finalisieren
   ├─ Version-Bump
   └─ git merge main, git tag v0.2.0
```

---

## ✅ Dokumentations-Checkliste

**VOR dem Commit:**

- [ ] Neue/geänderte Dateien dokumentiert?
- [ ] ÄNDERUNGEN-[Xy].md aktualisiert?
- [ ] CHANGELOG.md hat einen Versioning-Eintrag?
- [ ] Commits haben [PREFIX-Xy] Tags?
- [ ] Code hat Inline-Kommentare?
- [ ] Browser-Tests durchgeführt + geschafft?

**VOR dem Release:**

- [ ] docs/VERTEIDIGUNG.md aktualisiert?
- [ ] README.md mit neuesten Screenshots?
- [ ] Alle links die erwarteten Dateien erreichen?
- [ ] `bash scripts/validate-docs.sh` bestanden?

**VOR der Verteidigung (Endkontrolle):**

- [ ] GitHub-Repo mit Tags sichtbar?
- [ ] Alle Screenshots aktuell?
- [ ] Handout gedruckt?
- [ ] Live-Demo getestet (Galerie, Responsive, Algorithmen)?
- [ ] Präsentations-Skript memoriert?

---

## 📖 Dokumentations-Anti-Patterns (Was vermeiden)

❌ **Nicht machen:**
- "TODO: dokumentieren später" – Dokumentation JETZT schreiben
- Copy-Paste zwischen Dateien – Eine Quelle pro Info (SSOT)
- Veraltete Dokumentation – Mit Code gemeinsam aktualisieren
- Geheime Informationen im Repo – Keine Secrets, keine Passwörter
- Unvollständige Commit-Messages – "Fixed stuff" statt "[FIX-I1] @media Queries..."

✅ **Stattdessen:**
- Dokumentation ist Teil der Arbeit, nicht danach
- Eine Wahrheit pro Information – Verlinken statt Duplizieren
- Dokumentation & Code im gleichen Commit
- Alle Entscheidungen & Begründungen dokumentieren
- Aussagekräftige, konsistente Commit-Messages

---

## 🔗 Dokumentations-Quellen (Übersicht)

| Zur Frage | Siehe Datei |
|-----------|-------------|
| Welche Änderungen wurden bei D1 vorgenommen? | docs/ÄNDERUNGEN-D1.md |
| Wie erkläre ich die Verteidigung? | docs/VERTEIDIGUNG.md |
| Welche Versionen gibt es? | CHANGELOG.md |
| Wie branche ich? | .github/BRANCHSTRATEGIE.md |
| Wie ist das Projekt strukturiert? | docs/handbuch/ARCHITEKTUR.md |
| Wo sind die Bildquellen? | docs/BILDQUELLEN.md |
| Was ist die Master-Roadmap? | docs/OPTIMIERUNGS-ROADMAP.md |

---

**Diese Dokumentations-Richtlinie ist ab 7. Mai 2026 gültig und muss während aller Arbeiten eingehalten werden.**
