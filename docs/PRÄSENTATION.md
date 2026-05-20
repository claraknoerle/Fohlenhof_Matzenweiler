# Präsentation und Arbeitsplan für die Verteidigung

**Ziel:** Schritt für Schritt alle fehlenden Punkte aus der Korrekturhilfe nacharbeiten, das Projekt dokumentieren und die Verteidigung sicher vorbereiten.

## 1. Ausgangslage

Die Korrekturhilfe hat deinem Projekt folgende Punkte gegeben:

- A1 – Formales: 3 / 4
- B1 – Projektstruktur: 4 / 4
- C1 – Dynamisches Layout und Inhalt: 4 / 4
- D1 – Bilder und Galerie: 0 / 4
- E1 – Verweise: 4 / 4
- F1 – PHP + Formulare: 4 / 4
- H1 – Dokumentation: 4 / 4
- I1 – Farbgestaltung & Design: 0 / 4
- J1 – Impressum/Datenschutz/KI + Bildquellen: 0 / 4

**Startpunkt:** 23 / 36 Punkte (Note 2.81)
**Ziel:** 36 / 36 Punkte, plus starke Verteidigungsargumente durch Git und Algorithmus-Erweiterung.

---

## 2. Datei: `docs/PRÄSENTATION.md`

Diese Datei ist dein zentraler Plan. Arbeite sie von oben nach unten ab und hake erledigte Aufgaben ab.

---

## 3. Phase 1: Wichtigste Korrekturen (sofort)

### 3.1 Kriterium A1 – Formales, Syntax & Docker

Warum: Ohne funktionierende PHP-Syntax-Prüfung bleibt das Projekt formal unsicher. Ein sauberer Docker-/PHP-Setup sorgt dafür, dass die Bewertung korrekt ausgeführt werden kann.

#### Was ändern
- Prüfe und repariere die Docker-Umgebung.
  - Stelle sicher, dass der PHP-Container PHP-CLI enthält.
  - Prüfe, ob `docker-compose ps` den PHP- und MySQL-Container zeigt.
- Führe Syntaxprüfung für alle PHP-Dateien aus.
  - Wenn es noch kein Script gibt, erstelle `scripts/validate-php-syntax.sh`.
  - Beispielinhalt:
    ```bash
    #!/usr/bin/env bash
    set -e
    find webapp/public -name '*.php' | while read -r file; do
      php -l "$file" || exit 1
    done
    echo "PHP-Syntaxprüfung erfolgreich"
    ```
- Dokumentiere die MVC-Struktur.
  - Ergänze `docs/handbuch/ARCHITEKTUR.md` oder `docs/VERTEIDIGUNG.md` mit dem Ablauf:
    - `models/RechnerModel.php`
    - `controllers/RechnerController.php`
    - `views/RechnerView.php`
    - `layouts/...` für Seite und Navigation

#### Dateien
- `docker-compose.yml`
- `docker/php/Dockerfile` (falls vorhanden)
- `scripts/validate-php-syntax.sh`
- `webapp/public/index.php`
- `docs/handbuch/ARCHITEKTUR.md`

#### Test
- `docker-compose exec php php -v`
- `bash scripts/validate-php-syntax.sh`

---

### 3.2 Kriterium D1 – Bilder und Galerie

Warum: 0 Bilder bedeutet automatische Abwertung. Bildergalerie ist ein einfaches, punkteträchtiges Feature.

#### Was ändern
- Erstelle ein klares Bildverzeichnis.
  - Beispiel:
    - `webapp/public/images/galerie/`
    - `webapp/public/images/icons/`
- Lege mindestens 3 Bilder ab, optimiert unter 200 KB.
  - Nutze Pixabay, Unsplash oder Pexels.
  - Dokumentiere die Quelle in `docs/BILDQUELLEN.md`.
- Implementiere eine echte Galerieseite.
  - Datei: `webapp/public/layouts/galerie.php`
  - Nutze `<figure>`, `<img>` und `<figcaption>`.
- Ergänze Navigation.
  - Datei: `webapp/public/layouts/nav.php`
  - Link: `<a href="?page=galerie">Galerie</a>`
- Erstelle oder erweitere CSS.
  - Datei: `webapp/public/css/galerie.css`
  - Nutze Grid-Layout und responsive Breakpoints.

#### Dateien
- `webapp/public/images/galerie/*.jpg`
- `webapp/public/layouts/galerie.php`
- `webapp/public/layouts/nav.php`
- `webapp/public/css/galerie.css`
- `docs/BILDQUELLEN.md`

#### Test
- Öffne `http://localhost:8080/?page=galerie`
- Prüfe Desktop/Tablet/Mobile in DevTools
- Achte auf Alt-Text, Bildunterschriften und Quellenangaben

---

### 3.3 Kriterium I1 – Farbgestaltung und Responsive Design

Warum: Keine `@media`-Queries führt zu 0 Punkten. Responsive Design muss sichtbar sein.

#### Was ändern
- Ergänze responsive Breakpoints in CSS.
- Schreibe mindestens drei `@media`-Rules:
  - `@media (max-width: 1440px)` für großes Tablet/kleines Desktop
  - `@media (max-width: 768px)` für Tablet
  - `@media (max-width: 480px)` für Smartphone
- Passe Layout, Navigation und Textboxen an.
  - Navigation sollte auf Mobile nicht zerbrechen.
  - Bilder und Textabschnitte sollten sich untereinander anordnen.
- Dokumentiere die Responsive-Strategie als Kommentar in `webapp/public/css/styles.css`.

#### Dateien
- `webapp/public/css/styles.css`
- `webapp/public/css/galerie.css`

#### Test
- Öffne Hauptseite im Browser
- Simuliere 1920px, 1024px, 768px, 390px
- Prüfe Darstellung der Navigation, Galerie und Footer

---

### 3.4 Kriterium J1 – Impressum, Datenschutz & Bildquellen

Warum: Fehlende Bildquellen sind direkte Abzüge. Impressum und Datenschutz müssen vollständig und sichtbar sein.

#### Was ändern
- Erstelle `docs/BILDQUELLEN.md` mit allen Angaben:
  - Dateiname
  - Quelle
  - Lizenz
  - Urheber
  - URL
  - Änderungen (z. B. Größe, Kompression)
- Ergänze Impressum/Datenschutz-Seiten mit Link zu Bildquellen.
  - `webapp/public/layouts/impressum.php`
  - `webapp/public/layouts/datenschutz.php`
- Füge für jedes Bild `alt` und `title` hinzu.
- Verlinke die Quellen im Footer oder in Galerietexten.

#### Dateien
- `docs/BILDQUELLEN.md`
- `webapp/public/layouts/footer.php`
- `webapp/public/layouts/impressum.php`
- `webapp/public/layouts/datenschutz.php`
- `webapp/public/layouts/galerie.php`

#### Test
- Prüfe, ob die Bildquellendatei vollständig ist
- Öffne Impressum/Datenschutz und folge den Links
- Stelle sicher, dass jeder Bildquelle eine Lizenz zugeordnet ist

---

## 4. Phase 2: Professionelle Erweiterungen

### 4.1 Git & GitHub Dokumentation

Warum: Das zeigt professionelle Entwicklungsarbeit und wird in der Verteidigung sehr positiv wahrgenommen.

#### Was ändern
- Nutze Branches und spreche sie im Vortrag an.
- Schreibe klare Commit-Messages mit Präfixen:
  - `[FIX-A1]`, `[FEAT-D1]`, `[DOCS-J1]`, `[REFACTOR-I1]`
- Erstelle am Ende ein Release-Tag `v1.0.0` oder `v1.0.1`.
- Ergänze `README.md` oder `docs/VERTEIDIGUNG.md` um den Git-Workflow.

#### Dateien
- `README.md`
- `CHANGELOG.md`
- ggf. `docs/VERTEIDIGUNG.md`

### 4.2 Algorithmus-Erweiterung

Warum: Eine eigene Suche/Sortierung zeigt, dass du nicht nur eine Website baust, sondern auch Programmierlogik verstehst.

#### Was ändern
- Erstelle `webapp/public/models/SearchAlgorithm.php` mit linearer Suche.
- Erstelle `webapp/public/models/SortAlgorithm.php` mit Bubble-Sort.
- Baue eine kleine Seite oder einen Abschnitt ein:
  - `?page=algorithmen`
  - Beispiel: Einfache Suche in einer Liste von Einträgen
  - Vergleich `sort()` vs. eigene Implementierung

#### Dokumentation
- Beschreibe im Code in Kommentaren:
  - Laufzeit O(n) für lineare Suche
  - Laufzeit O(n²) für Bubble Sort
- Falls möglich, erstelle einen Vergleich mit echten Zahlen.
- Dokumentiere das in `docs/VERTEIDIGUNG.md` oder `docs/handbuch/ARCHITEKTUR.md`.

#### Dateien
- `webapp/public/models/SearchAlgorithm.php`
- `webapp/public/models/SortAlgorithm.php`
- `webapp/public/layouts/algorithmen.php`
- `webapp/public/layouts/nav.php`

---

## 5. Phase 3: Dokumentation & Präsentation

### 5.1 Dokumentiere jede Änderung

- Schreibe für jede große Änderung einen kurzen Absatz in `docs/ÄNDERUNGEN-*.md`:
  - `docs/ÄNDERUNGEN-A1.md`
  - `docs/ÄNDERUNGEN-D1.md`
  - `docs/ÄNDERUNGEN-I1.md`
  - `docs/ÄNDERUNGEN-J1.md`
- Füge jeweils hinzu:
  - Was geändert wurde
  - Warum es wichtig war
  - Wie es dem Projekt hilft
  - Welche Dateien betroffen sind

### 5.2 Bereite die Verteidigung vor

- Nutze diese Datei als Präsentationsskript.
- Lerne die Reihenfolge:
  1. Ausgangslage mit der ursprünglichen Korrekturhilfe
  2. Kriterium-Fixes A1, D1, I1, J1
  3. Git-Geschichte und Branch-Strategie
  4. Algorithmus-Erweiterung
  5. Abschluss mit Punkten und Lernerfahrung
- Verwende die Stichworte:
  - "Formales überprüft"
  - "Bildergalerie ergänzt"
  - "Responsive Design gebaut"
  - "Bildquellen dokumentiert"
  - "Git & Commit-Workflow erklärt"
  - "Eigene Algorithmen implementiert"

### 5.3 Unterstützende Dateien

- `docs/VERTEIDIGUNG.md` → detaillierter Präsentationsleitfaden
- `docs/OPTIMIERUNGS-ROADMAP.md` → Roadmap für Verteidigungsstand
- `docs/BILDQUELLEN.md` → Bildquellen und Lizenzen
- `docs/handbuch/ARCHITEKTUR.md` → MVC- und Projektstruktur

---

## 6. Konkreter 5-Tage-Plan

### Tag 1: A1 und Dokumentation
- `docker-compose.yml` prüfen
- PHP-CLI in Docker sicherstellen
- `scripts/validate-php-syntax.sh` erstellen
- `docs/handbuch/ARCHITEKTUR.md` ergänzen
- Commit: `[FIX-A1] Docker & PHP-Syntax` 

### Tag 2: D1 Galerie bauen
- Bilder in `webapp/public/images/galerie/` einfügen
- `webapp/public/layouts/galerie.php` erstellen
- `webapp/public/css/galerie.css` schreiben
- Navigation anpassen
- Commit: `[FEAT-D1] Galerie implementiert`

### Tag 3: I1 Responsive Design
- `webapp/public/css/styles.css` um `@media` erweitern
- Breakpoints einbauen
- Desktop/Tablet/Mobile testen
- Commit: `[FIX-I1] Responsive Design`

### Tag 4: J1 Bildquellen & Impressum
- `docs/BILDQUELLEN.md` erstellen
- `alt`/`title` bei allen Bildern ergänzen
- Footer/Impressum anpassen
- Commit: `[DOCS-J1] Bildquellen & Lizenznachweise`

### Tag 5: Verteidigung & Feinschliff
- `docs/VERTEIDIGUNG.md` finalisieren
- `README.md`/Kurzanleitung prüfen
- Screenshots & Testdokumentation sammeln
- Abschluss-Commit: `[RELEASE] Verteidigungsstand`

---

## 7. Checkliste vor der Verteidigung

- [ ] `bash scripts/validate-security.sh`
- [ ] `bash scripts/validate-architecture.sh`
- [ ] `bash scripts/validate-docs.sh`
- [ ] `bash scripts/validate-php-syntax.sh`
- [ ] Galerie im Browser offen getestet
- [ ] Responsive Layout an drei Viewports geprüft
- [ ] Bildquellen in `docs/BILDQUELLEN.md` vollständig
- [ ] Präsentationsskript mindestens zweimal laut geübt
- [ ] Git-Log und Branches notiert für die Verteidigung

---

## 8. Lernskript für die Präsentation

### Kurze Sätze, die du dir merken kannst
- "Mein Ausgangspunkt war 23 von 36 Punkten. Ich habe gezielt die fehlenden Kriterien A1, D1, I1 und J1 geschlossen."
- "Ich habe eine echte Bildergalerie eingebaut und die Bilder rechtlich sauber dokumentiert."
- "Ich habe das Design responsive gemacht und die Seite für Desktop, Tablet und Smartphone optimiert."
- "Ich habe Git genutzt, um meine Arbeit nachvollziehbar zu machen."
- "Als Bonus habe ich eigene Algorithmen für Suche und Sortierung ergänzt."

### Mögliche Fragen und kurze Antworten
- Frage: "Was war wichtig bei A1?"
  - Antwort: "PHP-Syntax muss sauber sein, sonst kann die Bewertung nicht korrekt arbeiten."
- Frage: "Warum braucht die Galerie Bildquellen?"
  - Antwort: "Jede Bildverwendung muss lizenziert sein. Ohne Quellenangabe bleiben Punkte in J1 offen."
- Frage: "Was zeigt die Algorithmus-Erweiterung?"
  - Antwort: "Sie zeigt, dass ich Programmierlogik selbst verstehe und nicht nur fertige Funktionen nutze."

---

## 9. Tipp

Arbeite zuerst die einzelnen Kriterien sauber ab. Wenn alle Punkte erfüllt sind, ist die Verteidigung viel leichter. Die Dokumentation und das Präsentationsskript sind der Beweis, dass du strukturiert gearbeitet hast.
