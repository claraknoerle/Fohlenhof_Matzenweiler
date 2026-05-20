# Optimierungs-Roadmap: Clara Web-Projekt (Schüler-Projekt)

**Datum:** 7. Mai 2026  
**Zielstand zur Verteidigung:** Anfang Juni 2026  
**Ausgangspunkte:** 23/36 Punkte (2.81er Note)  
**Zielzustand:** 35+/36 Punkte (1.0er Bereich) + 2 professionelle Erweiterungen  

---

## 📊 Kriterien-Analyse: Wo sind die Lücken?

| Kriterium | Status | Punkte | Hauptproblem | Priorität |
|-----------|--------|--------|--------------|-----------|
| **A1** – Formales & MVC | `⚠ teilweise` | 3/4 | Keine PHP-Syntax-Prüfung möglich (Docker-Fehler) | 🔴 HOCH |
| **B1** – Projektstruktur | ✅ erfüllt | 4/4 | – | 🟢 OK |
| **C1** – Dynamik & Layout | ✅ erfüllt | 4/4 | – | 🟢 OK |
| **D1** – Bilder & Galerie | ❌ teilweise | 0/4 | **0 Bilder in standardisierten Verzeichnisse** | 🔴 HOCH |
| **E1** – Links & Navigation | ✅ erfüllt | 4/4 | – | 🟢 OK |
| **F1** – PHP + Formulare | ✅ erfüllt | 4/4 | – | 🟢 OK |
| **H1** – Code-Dokumentation | ✅ erfüllt | 4/4 | – | 🟢 OK |
| **I1** – Design & Responsive | ❌ teilweise | 0/4 | **Keine @media-Queries in CSS** | 🔴 HOCH |
| **J1** – Extras (Impressum, Datenschutz, Bildlizenzen) | ❌ teilweise | 0/4 | **KEIN Bildnachweis/Lizenzen dokumentiert** | 🔴 HOCH |

**Analyse:** 3 Kriterien können mit gezielter Arbeit erfüllt werden → +12 Punkte möglich → 35/36 Punkte erreichbar.

---

## 🎯 Phase 1: Kriterium-Fixes (Woche 1–3)

### 1.1 [CRITICAL] Kriterium A1: Syntax-Validierung & Docker-Setup

**Problem:** PHP-CLI nicht verfügbar → Sintaxprüfung nicht ausfuehrbar  
**Ziel:** Docker-Umgebung korrekt konfigurieren, Syntax-Checks laufen lassen  
**Priorität:** 🔴 MUSS vorher gemacht sein

#### Aufgaben

- [ ] **A1.1** – Docker-Compose prüfen: Läuft der MySQL-Service?
  - **Befehl:** `docker-compose ps`
  - **Erwartet:** mysql container running
  - **Falls Fehler:** `docker-compose up -d` → Logs prüfen

- [ ] **A1.2** – PHP-CLI in Docker-Umgebung verfügbar machen
  - **Datei:** `docker/php/Dockerfile` (ggf. erstellen)
  - **Änderung:** PHP-CLI Package installieren (z.B. `php8.1-cli`)
  - **Test:** `docker-compose exec php php -v`

- [ ] **A1.3** – Syntax-Checks für alle `.php` Dateien durchführen
  - **Befehl:** `bash scripts/validate-php-syntax.sh`
  - **Erwartet:** ✓ Alle PHP-Dateien syntaxfrei
  - **Falls Fehler:** Einzelne Fehler in Datei/Zeile dokumentieren, fixen

- [ ] **A1.4** – MVC-Struktur verfeinert dokumentieren
  - **Datei zur Änderung:** `docs/handbuch/ARCHITEKTUR.md`
  - **Hinzufügen:** Diagram der MVC-Flows (models → controllers → views)
  - **Beispiel:** `models/RechnerModel.php` → `controllers/RechnerController.php` → `views/RechnerView.php`

- [ ] **A1.5** – Automatischen Syntax-Check in Git-Hook integrieren
  - **Hook-Datei:** `.git/hooks/pre-commit`
  - **Inhalt:** Prüft PHP-Syntax vor jedem Commit
  - **Dokumentation:** In `BRANCHSTRATEGIE.md` unter "Automatisierung"

**Geschätzter Aufwand:** 2–3 Stunden  
**Dokumentation:** ÄNDERUNGEN-A1.md (s.u)  
**Branch:** `fix/a1-syntax-validation`

---

### 1.2 [CRITICAL] Kriterium D1: Bilder & Bildergalerie

**Problem:** 0 Bilder in standardisierten Verzeichnissen (`images/`, `img/`, `bilder/`, `assets/images/`)  
**Ziel:** Mindestens 3 optimierte Bilder (<200KB) in strukturiertem Layout  
**Priorität:** 🔴 MUSS → +4 Punkte

#### Aufgaben

- [ ] **D1.1** – Bild-Verzeichnis korrekt strukturieren
  - **Zielverzeichnis:** `webapp/public/images/` (neu erstellen)
  - **Struktur:**
    ```
    images/
      ├── galerie/
      │   ├── img-001.jpg (200KB oder kleiner)
      │   ├── img-002.jpg
      │   └── img-003.jpg
      └── icons/
          └── favicon.ico
    ```
  - **Befehl:** `mkdir -p webapp/public/images/galerie`

- [ ] **D1.2** – Bilder beschaffen, optimieren, benennen
  - **Quellen:** Pixabay, Unsplash, Pexels (kostenlos, Lizenzen dokumentieren)
  - **Anforderung:** 3–5 Bilder, Thema: "Fohlenhof Matzenweiler" o.ä. (Landwirtschaft/Natur)
  - **Optimierung:** Mit ImageMagick/TinyPNG auf <200KB reduzieren
  - **Benennung:** `img-001-heuballen.jpg`, `img-002-heustall.jpg`, etc.
  - **Befehl:** `convert input.jpg -resize 1200x800 -quality 85 output.jpg`

- [ ] **D1.3** – Galerie-View in PHP implementieren
  - **Neue Datei:** `webapp/public/layouts/galerie.php`
  - **Inhalt:** `<div class="gallery">` mit `<figure>` und `<figcaption>`
  - **Template:**
    ```php
    <section class="gallery">
      <?php foreach ($images as $img): ?>
        <figure class="gallery-item">
          <img src="<?= $img['src'] ?>" alt="<?= $img['alt'] ?>" />
          <figcaption><?= $img['caption'] ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </section>
    ```

- [ ] **D1.4** – Galerie-CSS mit Grid & Responsive
  - **Datei:** `webapp/public/css/galerie.css` (neu oder update `styles.css`)
  - **Anforderung:** CSS Grid, 3 Spalten auf Desktop, 1 auf Mobile
  - **Breakpoints:** 1200px, 768px, 480px
  - **Beispiel:**
    ```css
    .gallery {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }
    @media (max-width: 768px) {
      .gallery { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
      .gallery { grid-template-columns: 1fr; }
    }
    ```

- [ ] **D1.5** – Galerie in Hauptnavigation verlinken
  - **Änderung:** `webapp/public/layouts/nav.php`
  - **Hinzufügen:** Link `<a href="?page=galerie">Galerie</a>`
  - **Controller-Logik:** In `index.php` oder Controller → `case 'galerie': include 'layouts/galerie.php';`

- [ ] **D1.6** – Bilder-Preview im Browser testen
  - **Test:** Öffne `http://localhost:8080/?page=galerie`
  - **Prüfe:** Alle 3+ Bilder sichtbar, Grid responsive (DevTools)
  - **Screenshot:** `/docs/handbuch/SCREENSHOTS/D1-galerie.png` speichern

**Geschätzter Aufwand:** 4–5 Stunden  
**Dokumentation:** ÄNDERUNGEN-D1.md  
**Branch:** `feature/bildergalerie-d1`

---

### 1.3 [CRITICAL] Kriterium I1: Design & Responsive (@media Queries)

**Problem:** Regex `@media\s*\(` in keiner CSS-Datei gefunden  
**Ziel:** Mindestens 2–3 @media-Queries für responsive Breakpoints  
**Priorität:** 🔴 MUSS → +4 Punkte

#### Aufgaben

- [ ] **I1.1** – Aktuelle CSS durchsuchen, @media-Queries finden
  - **Dateien:** `css/styles.css`, `css/galerie.css`
  - **Befehl:** `grep -r "@media" webapp/public/css/`
  - **Falls keine:** → Alle CSS müssen @media-Queries ergänzt werden

- [ ] **I1.2** – Responsive Design Breakpoints definieren
  - **Standard-Breakpoints:**
    - Desktop: 1440px+
    - Tablet: 768px–1439px
    - Mobile: <768px
  - **Dokumentation:** In Kommentar am Anfang von `styles.css`
  - **Beispiel:**
    ```css
    /**
     * RESPONSIVE DESIGN STRATEGIE
     * Desktop: 1440px+ (3-col layouts)
     * Tablet:  768px–1439px (2-col)
     * Mobile:  <768px (1-col, stacked)
     */
    ```

- [ ] **I1.3** – @media-Queries für Haupt-Komponenten schreiben
  - **Komponenten:** Navigation, Header, Main Content, Footer, Galerie
  - **Beispiel für nav:**
    ```css
    nav { display: flex; }
    @media (max-width: 768px) {
      nav { flex-direction: column; }
      nav a { display: block; margin: 0.5rem 0; }
    }
    ```

- [ ] **I1.4** – Responsive-Test in Browser durchführen
  - **Tools:** Chrome DevTools → Device Emulation
  - **Test-Geräte:** iPhone 12 (390px), iPad (768px), Desktop (1920px)
  - **Prüfe:**
    - Navigation klappt nicht über (lesbar auf Mobile)
    - Content-Width passt in Fenster
    - Bilder skalieren proportional
    - Text-Größe lesbar

- [ ] **I1.5** – Bildschirmfotos dokumentieren
  - **Screenshot Mobile:** `/docs/handbuch/SCREENSHOTS/I1-mobile.png`
  - **Screenshot Tablet:** `/docs/handbuch/SCREENSHOTS/I1-tablet.png`
  - **Screenshot Desktop:** `/docs/handbuch/SCREENSHOTS/I1-desktop.png`
  - **Kommentar:** In jedem Screenshot: Viewport-Größe, Browser, Datum

**Geschätzter Aufwand:** 2–3 Stunden  
**Dokumentation:** ÄNDERUNGEN-I1.md  
**Branch:** `fix/responsive-design-i1`

---

### 1.4 [CRITICAL] Kriterium J1: Bildna Lizenzen & Datenschutz

**Problem:** Keine Bildquellen, Lizenzen oder Nachweise für Bilder dokumentiert  
**Ziel:** Vollständiges Quellenverzeichnis + Lizenzen für alle Bilder  
**Priorität:** 🔴 MUSS → +4 Punkte

#### Aufgaben

- [ ] **J1.1** – Bildquellen-Datei erstellen
  - **Datei:** `docs/BILDQUELLEN.md` (oder `docs/handbuch/LIZENZEN.md`)
  - **Struktur:**
    ```markdown
    # Bildquellen & Lizenzen
    
    ## Galerie-Bilder
    
    ### img-001-heuballen.jpg
    - **Quelle:** Pixabay (https://pixabay.com/)
    - **Autor:** [Name/Anonym]
    - **Lizenz:** CC0 Public Domain
    - **Original-URL:** [Link]
    - **Änderungen:** Resize auf 1200x800, JPEG-Kompression 85%
    
    ### img-002-heustall.jpg
    - **Quelle:** Unsplash (https://unsplash.com/)
    - **Autor:** [Name]
    - **Lizenz:** Unsplash License (kostenlos, zitierbar)
    - **Original-URL:** [Link]
    ```

- [ ] **J1.2** – Alle Bilder mit HTML-Attributen versehen
  - **Änderung:** `layouts/galerie.php`
  - **Für jedes `<img>`:**
    ```php
    <img 
      src="images/galerie/img-001.jpg" 
      alt="Heuballen auf Wiesenfläche" 
      title="Heuballen auf Wiesenfläche – © CC0 Pixabay"
    />
    ```
  - **Auch in `<figcaption>`:**
    ```php
    <figcaption>
      Heuballen auf Wiesenfläche 
      (<a href="https://pixabay.com/">Pixabay CC0</a>)
    </figcaption>
    ```

- [ ] **J1.3** – Link zu Bildquellen in Impressum einfügen
  - **Datei:** `layouts/footer.php` oder `layouts/impressum.php`
  - **Zusatz:**
    ```php
    <p>
      <a href="/docs/BILDQUELLEN.md">Bildquellen & Lizenzen</a>
    </p>
    ```

- [ ] **J1.4** – Datenschutz-Seite verbessern (falls leer)
  - **Datei:** `layouts/datenschutz.php`
  - **Mindestinhalt:**
    - Cookie-Policy (falls Analytics)
    - Datenschutz-Hinweis für externe Bilder
    - Kontaktdaten des Betreibers
    - Link zum BILDQUELLEN.md

- [ ] **J1.5** – Validierungstest
  - **Regex-Test:** `grep -r "pixabay\|unsplash\|cc-by\|copyright" webapp/public/`
  - **Erwartet:** Mindestens 1 Hit pro Bild
  - **Falls Fehler:** Bildquelle in HTML oder Markdown ergänzen

**Geschätzter Aufwand:** 1–2 Stunden  
**Dokumentation:** ÄNDERUNGEN-J1.md  
**Branch:** `fix/bildnachweis-lizenzen-j1`

---

## 🎯 Phase 2: Erweiterungen (Woche 4–6)

### 2.1 Erweiterung 1: Git & GitHub + Professionelle Versionierung

**Ziel:** Repository auf GitHub, saubere Commit-Historie, Feature-Branches  
**Marschplan-Ref:** "Erweiterung 1: Versionsverwaltung mit Git"  
**Aufwand:** 3–4 Stunden  
**Demonstration:** Branch-Graph, Tags, README mit Screenshots

#### Aufgaben

- [ ] **EXT1.1** – GitHub-Account & Repository erstellen
  - [ ] GitHub-Account (https://github.com)
  - [ ] Neues Public-Repo: `Fohlenhof_Matzenweiler-Clara` o.ä.
  - [ ] `.gitignore` hinzufügen (PHP: cache, logs, vendor)
  - [ ] LICENSE hinzufügen (z.B. MIT)

- [ ] **EXT1.2** – Lokales Repository initialisieren
  - **Befehl:**
    ```bash
    cd /workspaces/Fohlenhof_Matzenweiler
    git init
    git branch -M main
    git add .
    git commit -m "[INIT] Projekt eingecheckt – Clara Web-Projekt Basis"
    git remote add origin https://github.com/[USER]/Fohlenhof_Matzenweiler-Clara.git
    git push -u origin main
    ```

- [ ] **EXT1.3** – `develop` Branch erstellen
  - **Befehl:**
    ```bash
    git checkout -b develop
    git push -u origin develop
    ```

- [ ] **EXT1.4** – Feature-Branch für Kriterium-Fixes
  - **Branches:**
    - `fix/responsive-design-i1`
    - `feature/bildergalerie-d1`
    - `fix/bildnachweis-j1`
    - `feature/git-dokumentation`
  - **Workflow:** Feature → develop → main (via Release-Branch)

- [ ] **EXT1.5** – README.md schreiben
  - **Inhalt:**
    - Projektbeschreibung (Clara Web-Projekt, Noten: 23→35 Punkte)
    - Features (Rechner, Galerie, Responsive, Dokumentation)
    - Installation (`docker-compose up -d`)
    - Verwendete Technologien (PHP, CSS, JavaScript, MySQL)
    - Struktur (MVC)
    - Git-Branches / Commits erklären
    - Screenshot hinzufügen (Galerie oder Startseite)

- [ ] **EXT1.6** – Tags für Versionen setzen
  - **v0.1.0:** Initiales Projekt
  - **v0.2.0:** Kriterium-Fixes abgeschlossen
  - **v1.0.0:** Mit Erweiterungs-Feature fertig
  - **Befehl:** `git tag -a v1.0.0 -m "Version 1.0.0 – Verteidigungsstand"`

**Geschätzter Aufwand:** 2–3 Stunden  
**Dokumentation:** ÄNDERUNGEN-EXT1.md  
**Branch:** `feature/git-dokumentation`

---

### 2.2 Erweiterung 2: Algorithmen & Datenstrukturen in PHP

**Ziel:** Lineare Suche + Bubble Sort implementieren, testen, vergleichen  
**Marschplan-Ref:** "Erweiterung 2: Algorithmen und Datenstrukturen"  
**Aufwand:** 6–8 Stunden  
**Demonstration:** Flussdiagramm, Code-Kommentare, Performance-Vergleich

#### Aufgaben

- [ ] **EXT2.1** – Anwendungsfall im Projekt identifizieren
  - **Beispiele:**
    - Produktliste sortieren (z.B. von Produkten nach Preis)
    - Suchfunktion in Datensatz (z.B. Fohlen/Pferde nach Name)
    - Daten aus DB auslesen → sortieren/suchen
  - **Entscheidung treffen:** Welcher Use-Case am sinnvollsten?

- [ ] **EXT2.2** – Lineare Suche in PHP implementieren
  - **Neue Datei:** `webapp/public/models/SearchAlgorithm.php`
  - **Methode:** `linearSearch($array, $target)`
  - **Pseudocode:**
    ```
    for each item in array:
      if item == target:
        return index
    return -1 (not found)
    ```
  - **Code-Beispiel:**
    ```php
    public static function linearSearch($array, $target) {
      for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] == $target) {
          return $i; // Found at index i
        }
      }
      return -1; // Not found
    }
    ```

- [ ] **EXT2.3** – Bubble-Sort in PHP implementieren
  - **Neue Datei:** `webapp/public/models/SortAlgorithm.php`
  - **Methode:** `bubbleSort($array)`
  - **Pseudocode:**
    ```
    for i = 0 to n-1:
      for j = 0 to n-1-i:
        if array[j] > array[j+1]:
          swap(array[j], array[j+1])
    return array
    ```
  - **Code:**
    ```php
    public static function bubbleSort($array) {
      $n = count($array);
      for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - 1 - $i; $j++) {
          if ($array[$j] > $array[$j + 1]) {
            // Swap
            $temp = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $temp;
          }
        }
      }
      return $array;
    }
    ```

- [ ] **EXT2.4** – Automatisch gerahmte Tests mit realen Daten
  - **Testdatei:** `webapp/public/algoritmen-test.php`
  - **Daten:** Array mit 50–100 Einträgen aus Real-Datensatz
  - **Test 1 – Suche:**
    ```php
    $data = ['Fohlen-001', 'Fohlen-020', 'Fohlen-015', ...];
    $search_target = 'Fohlen-020';
    $result_index = SearchAlgorithm::linearSearch($data, $search_target);
    echo "Gefunden bei Index: $result_index";
    ```
  - **Test 2 – Sortierung:**
    ```php
    $data_unsorted = [45, 23, 67, 12, 89, ...];
    $start_time = microtime(true);
    $sorted_with_bubble = SortAlgorithm::bubbleSort($data_unsorted);
    $bubble_time = microtime(true) - $start_time;
    
    $sort_time = microtime(true);
    $sorted_with_php = sort($data_unsorted);
    $php_time = microtime(true) - $sort_time;
    
    echo "Bubble Sort: ${bubble_time}s | PHP sort(): ${php_time}s";
    ```

- [ ] **EXT2.5** – Flussdiagramme & Dokumentation schreiben
  - **Datei:** `docs/handbuch/ALGORITHMEN.md`
  - **Inhalt:**
    - Abschnitt: Lineare Suche (Pseudocode, Flussdiagramm, Komplexität O(n))
    - Abschnitt: Bubble-Sort (Pseudocode, Flussdiagramm, Komplexität O(n²))
    - Performance-Vergleich (eigene vs. PHP Built-in)
    - Lernziele: Was war schwer, was gelernt?

- [ ] **EXT2.6** – Algo-View als Browser-Demo implementieren
  - **Layout:** `webapp/public/layouts/algorithmen-demo.php`
  - **Interaktiv:** Button "Suchen" und "Sortieren"
  - **Output:** Schritt-für-Schritt Visualisierung oder Timeline
  - **Beispiel:**
    ```php
    <h2>Algorithmen-Demo</h2>
    <form method="POST">
      <input type="text" name="search" placeholder="Element suchen">
      <button type="submit">Linearsuche</button>
    </form>
    
    <?php
    if ($_POST) {
      $search_val = $_POST['search'];
      $result = SearchAlgorithm::linearSearch($data, $search_val);
      echo ($result >= 0) ? "Gefunden!" : "Nicht gefunden!";
    }
    ?>
    ```

**Geschätzter Aufwand:** 6–8 Stunden  
**Dokumentation:** ÄNDERUNGEN-EXT2.md  
**Branch:** `feature/algorithmen-suchen-sortieren`

---

## 📋 Master-Todo-Übersicht

### Phase 1: Kriterium-Fixes (1–3 Wochen)

```
[ ] Woche 1
  [ ] A1.1–A1.5 – Syntax-Validierung & Docker (2–3h)
  [ ] D1.1–D1.6 – Bildergalerie (4–5h)
  
[ ] Woche 2
  [ ] I1.1–I1.5 – Responsive Design (2–3h)
  [ ] J1.1–J1.5 – Bildquellen & Lizenzen (1–2h)
  
[ ] Woche 2–3
  [ ] Alle Fixes testen, dokumentieren, commiten
  [ ] Release-Branch: v0.2.0 vorbereiten
```

### Phase 2: Erweiterungen (4–6 Wochen)

```
[ ] Woche 4–5
  [ ] EXT1.1–EXT1.6 – Git-Repo & Dokumentation (2–3h)
  
[ ] Woche 5–6
  [ ] EXT2.1–EXT2.6 – Algorithmen implementieren (6–8h)
  [ ] Browser-Demo testen
  [ ] Dokumentation finalisieren
  
[ ] Woche 6
  [ ] Beide Erweiterungen im Browser demonstrieren
  [ ] Verteidigungsskript schreiben
  [ ] Release v1.0.0 auf main
```

---

## 📝 Dokumentations-Matrix

Folgende Dateien **müssen** für jede Änderung aktualisiert werden:

| Dokument | Zweck | Wann aktualisiert | Format |
|----------|-------|------------------|--------|
| **ÄNDERUNGEN-Xy.md** | Pro Kriterium: Alle Änderungen mit Begründung | Nach jeder Commit-Serie | Markdown |
| **docs/handbuch/ARCHITEKTUR.md** | Struktur-Übersicht, MVC-Erläuterung | Nach A1-Fixes | Markdown |
| **docs/handbuch/ALGORITHMEN.md** | Pseudocode, Flussdiagramme, O-Notation | Nach EXT2 | Markdown + Diagramme |
| **CHANGELOG.md** (im Root) | Kurze Zusammenfassung aller Commits | Nach jedem Major Release | Markdown |
| **VERTEIDIGUNG.md** | Leitfaden für die mündliche Präsentation | Nach Phase 2 | Markdown + Links |
| **README.md** | Projekt-Überblick, Installation, Features | Nach Phase 1 + 2 | Markdown + Screenshot |
| **webapp/public/DOKUMENTATION.md** (optional) | Inline-Code-Doku | Parallel zu Code | HTML-Comments in PHP |

---

## 🔐 Validierungs-Checkliste vor Verteidigung

**Vor dem Abgabetag durchführen:**

```bash
# 1. Alle Kriterien-Punkte prüfen
[ ] A1: PHP-Syntax prüfen → `bash scripts/validate-php-syntax.sh`
[ ] D1: Bilder im /images/ oder /bilder/ Verzeichnis? → `find . -path "*images*" -name "*.jpg"`
[ ] I1: @media Queries in CSS? → `grep -r "@media" webapp/public/css/`
[ ] J1: Bildquellen dokumentiert? → `grep -r "pixabay\|unsplash\|cc" docs/`

# 2. Git-Repository sauber?
[ ] `git status` → Keine uncommitted Changes?
[ ] `git log --graph --oneline --all` → Alle Commits mit Prefixes?
[ ] Tags vorhanden? → `git tag -l` → v0.2.0, v1.0.0, etc.

# 3. Browser-Test
[ ] Startseite laden: http://localhost:8080
[ ] Galerie laden: http://localhost:8080/?page=galerie
[ ] Responsive-Test: DevTools, Mobile/Tablet/Desktop
[ ] Alle Links funktionieren?

# 4. Dokumentation vollständig?
[ ] ÄNDERUNGEN-*.md Dateien vorhanden?
[ ] README.md mit Screenshots?
[ ] VERTEIDIGUNG.md mit Präsentations-Leitfaden?
[ ] docs/BILDQUELLEN.md vorhanden?

# 5. Validierungs-Skripte durchlaufen
[ ] `bash scripts/validate-security.sh` ✓
[ ] `bash scripts/validate-architecture.sh` ✓
[ ] `bash scripts/validate-docs.sh` ✓
```

---

## 📞 Fragen? Blockaden?

Sollten bei der Umsetzung Probleme entstehen, hier ist die Reihenfolge:

1. **Docker-Probleme?** → Siehe `docker-compose.yml`, `docker/` Verzeichnis
2. **PHP-Fehler?** → Logs in `logs/` (oder `docker-compose logs php`)
3. **Git-Fehler?** → `.github/BRANCHSTRATEGIE.md` lesen oder `git log` prüfen
4. **CSS-Probleme?** → Browser DevTools (F12), Responsive-Mode testen

---

**Diese Roadmap ist bis zur Verteidigung (Anfang Juni 2026) gültig.**
