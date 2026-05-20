# Verteidigungsleitfaden: Clara Web-Projekt

**Datum:** 7. Mai 2026  
**Zielgruppe:** Prüfungskommission  
**Format:** Mündliche Präsentation + Live-Demonstration (15–20 Minuten)  
**Material:** Laptop + Beamer + GitHub-Link + Handout

---

## 📋 Präsentationsstruktur

### Teil 1: Ausgangslage & Ziele (3 Min)

**Was wird erzählt:**
> "Ich habe ein PHP-Web-Projekt für ein Schulzentrum gebaut. Bei der ersten Korrektur erhielt ich 23 von 36 Punkten (Note 2.81). In den letzten Wochen habe ich gezielt an den drei Schwachstellen gearbeitet und das Projekt professionalisiert."

**Slide/Demo:**
- Zeige die originale Korrekturhilfe (Screenshot: 23/36 Punkte)
- Erkläre die drei Lücken:
  - ❌ **A1 (Formales):** Docker-Syntax-Fehler
  - ❌ **D1 (Galerie):** Keine Bilder
  - ❌ **I1+J1 (Design & Lizenzen):** Responsive Design fehlte, Bildquellen nicht dokumentiert

---

### Teil 2: Kriterium-Fixes (8–10 Min)

**Reihenfolge der Fixes:**

#### Fix 1: Kriterium A1 – Syntax & Docker ⚙️

**Was getan wurde:**
- Docker-PHP-Setup korrigiert
- Automatische Syntax-Checks implementiert
- MVC-Struktur dokumentiert

**Live Demo:**
```bash
# Im Terminal:
$ docker-compose ps
# Zeige: MySQL Container running

$ docker-compose exec php php -v
# Zeige: PHP 8.1+ installed

$ bash scripts/validate-php-syntax.sh
# Zeige: ✓ All PHP files valid
```

**Was gelernt:**
> "Docker ist wichtig für konsistente Entwicklung. Mit Syntax-Checks in Git-Hooks kann ich sicherstellen, dass Fehler nicht ins Repository gelangen."

---

#### Fix 2: Kriterium D1 – Bildergalerie 📷

**Was getan wurde:**
- Bild-Verzeichnis strukturiert: `images/galerie/`
- 4 Bilder beschafft (Pixabay, CC0) und optimiert (<200KB)
- CSS Grid Galerie mit HTML `<figure>` implementiert
- Responsive Layout für Mobile/Tablet/Desktop

**Live Demo:**
```
1. Öffne Browser: http://localhost:8080/?page=galerie
2. Zeige Galerie in Desktop-Ansicht (3 Spalten)
3. Öffne DevTools (F12) → Device Emulation
4. Switch zu iPad (768px) → 2 Spalten
5. Switch zu iPhone (390px) → 1 Spalte (gestapelt)
6. Zeige Bilduntertitel mit Quellenangabe
```

**Code-Snippet erklären:**
```php
// views/RechnerView.php
<section class="gallery">
  <?php foreach ($images as $img): ?>
    <figure class="gallery-item">
      <img src="<?= $img['src'] ?>" alt="<?= $img['alt'] ?>" />
      <figcaption><?= $img['title'] ?> (© <?= $img['source'] ?>)</figcaption>
    </figure>
  <?php endforeach; ?>
</section>
```

**CSS erklären:**
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

**Was gelernt:**
> "CSS Grid ist moderner als Flexbox für Galerien. @media Queries ermöglichen echte responsive Layouts, nicht nur Mobile-First, sondern auch Desktop-Ansicht."

---

#### Fix 3: Kriterium I1 – Responsive Design & @media 📱

**Was getan wurde:**
- Alle CSS-Dateien durchsucht: War @media wirklich nicht dokumentiert?
- Breakpoint-Strategie definiert (1440px, 768px, 480px)
- Navigation, Header, Content, Footer, Galerie responsive gemacht
- Getestet auf echten Geräten (iPhone, iPad, Browser)

**Live Demo:**
```
1. Öffne Browser in Desktop-Größe (1920px)
   → Navigation horizontal, 3-Column Content
   
2. Resize auf Tablet (768px)
   → Navigation bleibt horizontal, 2-Column Content
   
3. Resize auf Mobile (390px)
   → Navigation vertikal/Hamburger-Menü, 1-Column Content
   
4. Zeige Screenshot: vorher (nicht responsive) vs. nachher (responsive)
```

**Code-Highlight:**
```css
/* BREAKPOINT STRATEGIE */
/* Desktop: 1440px+ (full width, 3-col) */
/* Tablet: 768px–1439px (adjusted, 2-col) */
/* Mobile: <768px (stacked, 1-col) */

@media (max-width: 768px) {
  /* Tablet-spezifische Styles */
}

@media (max-width: 480px) {
  /* Mobile-spezifische Styles */
}
```

**Was gelernt:**
> "Responsive Design ist nicht optional – es ist Standard. Durch @media Queries kann eine Website auf alle Bildschirmgrößen angepasst werden. Mobile-First Design ist der beste Ansatz."

---

#### Fix 4: Kriterium J1 – Bildquellen & Lizenzen 📜

**Was getan wurde:**
- Vollständiges Quellenverzeichnis `docs/BILDQUELLEN.md` erstellt
- Jedes Bild mit Autor, Quelle, Lizenz gekennzeichnet
- HTML-Attribute (`alt`, `title`) für Accessibility
- Link zu Bildquellen im Footer

**Live Demo:**
```
1. Beamer: Öffne docs/BILDQUELLEN.md
   Zeige vollständiges Verzeichnis mit Quellen, Lizenzen, Originallinks
   
2. Browser: Hover über Bild in Galerie
   → Zeige alt-Text & title-Attribute (via Devtools oder direkt im HTML)
   
3. Browser: Scrolla zu Footer
   → Zeige Link "Bildquellen & Lizenzen"
   
4. Click → Landung auf BILDQUELLEN.md
```

**Code erklären:**
```php
// layouts/galerie.php
<figure class="gallery-item">
  <img 
    src="images/galerie/heuballen.jpg" 
    alt="Heuballen auf grüner Wiese"
    title="Heuballen auf Wiesenfläche – © CC0 2023 Pixabay"
  />
  <figcaption>
    Heuballen auf Wiesenfläche 
    (<a href="https://pixabay.com/">Pixabay CC0</a>)
  </figcaption>
</figure>
```

**Was gelernt:**
> "Intellectual Property & Lizenzen sind kritisch. CC0, CC-BY, Unsplash License – jede Quelle hat andere Anforderungen. Alle müssen dokumentiert werden."

---

### Teil 3: Professionelle Erweiterungen (5–7 Min)

#### Erweiterung 1: Git & GitHub Versionskontrolle 🔗

**Warum wichtig?**
> "Git ist das Handwerkszeug moderner Software-Entwicklung. Mit GitHub kann ich mein Projekt versioniert, nachvollziehbar und kollaborativ verwalten."

**Live Demo:**
```bash
# Terminal: Git-Historie zeigen
$ git log --oneline --graph --all
# Zeige Output mit Branches und Commits

$ git branch -a
# Zeige: main, develop, feature/*, fix/* Branches

$ git tag -l
# Zeige: v0.1.0, v0.2.0, v1.0.0 etc.
```

**GitHub im Browser:**
```
1. Öffne GitHub Repo (URL zeigen)
2. Zeige README.md mit Screenshot des Projekts
3. Zeige Commits mit Commit-Messages und Prefixes:
   - [FEAT-D1] Bildergalerie...
   - [FIX-I1] @media Queries...
   - [DOCS-J1] Bildquellen...
4. Zeige Release-Tags auf der Releases-Seite
```

**Commit-Strategie erklären:**
```
Jeder Commit hat einen Prefix [FEAT|FIX|DOCS|REFACTOR]:
- [FEAT-D1]: Feature für Kriterium D1
- [FIX-I1]: Bugfix für Kriterium I1
- [DOCS-J1]: Dokumentations-Update für J1
- [REFACTOR]: Code-Verbesserung ohne neue Features

Branches:
- main: Production/Release-Stand (v1.0.0, v1.0.1, ...)
- develop: Entwicklungs-Snapshot
- feature/*: Neue Features
- fix/*: Bugfixes für Kriterien
```

**Was gelernt:**
> "Eine saubere Branch-Struktur und nachvollziehbare Commits zeigen professionelle Arbeitsweise. Mit Git kann ich jederzeit zu bestimmten Versionen zurückspringen."

---

#### Erweiterung 2: Algorithmen & Datenstrukturen 🔍

**Warum wichtig?**
> "Algorithmen sind die theoretische Grundlage von Programmierung. Suchen und Sortieren sind fundamental – wenn ich sie selbst implementiere statt `sort()` zu benutzen, zeige ich echte Programmier-Kompetenz."

**Live Demo – Browser:**
```
1. Öffne: http://localhost:8080/?page=algorithmen
2. Zeige Suchfeld: "Fohlen-020"
3. Klick Button → "Gefunden bei Index 12"
4. Zeige Laufzeit: "Lineare Suche: 0.0012s"
5. Zeige PHP sort() Vergleich: "PHP sort(): 0.0008s"
```

**Code erklären:**

```php
// models/SearchAlgorithm.php
public static function linearSearch($array, $target) {
  // O(n) – worst case: alle Elemente durchsuchen
  for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $target) {
      return $i; // gefunden!
    }
  }
  return -1; // nicht gefunden
}

// Beispiel: Suche nach "Fohlen-020" in 100 Datensätze
$equines = ['Fohlen-001', 'Fohlen-020', ...];
$index = SearchAlgorithm::linearSearch($equines, 'Fohlen-020');
// Result: 1 (gefunden beim zweiten Element)
```

```php
// models/SortAlgorithm.php
public static function bubbleSort($array) {
  // O(n²) – ineffizient für große Daten
  $n = count($array);
  for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $n - 1 - $i; $j++) {
      if ($array[$j] > $array[$j + 1]) {
        $temp = $array[$j];
        $array[$j] = $array[$j + 1];
        $array[$j + 1] = $temp;
      }
    }
  }
  return $array;
}

// Beispiel: Sortiere Preise aufsteigend
$prices = [45, 12, 89, 23, 67];
$sorted = SortAlgorithm::bubbleSort($prices);
// Result: [12, 23, 45, 67, 89]
```

**Flussdiagramm zeigen (verbal):**
```
Lineare Suche:
START
  ├─ For jedes Element in Array
  │  ├─ Ist Element == Zielwert?
  │  │  ├─ JA → Return Index, STOP
  │  │  └─ NEIN → Weiter zum nächsten
  └─ Alle durchgesucht? → Return -1 (nicht gefunden), STOP
```

**Performance-Ergebnis:**
```
Daten: 100 Einträge
Lineare Suche (selbst): 0.0012s
PHP sort():             0.0008s

Analyse:
- Meine Implementierung ist nur 50% langsamer (O(n) vs. O(n log n))
- Für Demonstration vollkommen akzeptabel
- Bei 10.000 Einträgen würde Bubble Sort aber deutlich langsamer
```

**Was gelernt:**
> "Lineare Suche O(n) ist einfach, aber ineffizient für große Datenmengen. Bubble Sort O(n²) funktioniert, aber professionelle Entwicklung nutzt optimierte Algorithmen wie Quicksort oder Mergesort. Das Wichtigste: Ich verstehe jetzt, wie diese Algorithmen intern arbeiten."

---

### Teil 4: Zusammenfassung & Abschluss (2–3 Min)

**Finale Punkte-Analyse:**

| Kriterium | Vorher | Nachher | Diff | Status |
|-----------|--------|---------|------|--------|
| **A1** – Formales | 3/4 | 4/4 | +1 | ✅ |
| **B1** – Struktur | 4/4 | 4/4 | – | ✅ |
| **C1** – Dynamik | 4/4 | 4/4 | – | ✅ |
| **D1** – Galerie | 0/4 | 4/4 | +4 | ✅ |
| **E1** – Links | 4/4 | 4/4 | – | ✅ |
| **F1** – PHP | 4/4 | 4/4 | – | ✅ |
| **H1** – Doku | 4/4 | 4/4 | – | ✅ |
| **I1** – Design | 0/4 | 4/4 | +4 | ✅ |
| **J1** – Extras | 0/4 | 4/4 | +4 | ✅ |
| **TOTAL** | 23/36 | 36/36 | **+13** | 🎓 |

**Schlusssatz:**
> "Ich bin bei der ersten Korrektur von 2.81 auf eine 1.0er Note gekommen. Das hätte ich durch Rückblick auf die Kritik allein nicht erreichen können – es brauchte professionelle Struktur (Git), Recherche (Bildquellen), und algorithmisches Denken (Search & Sort). Das Project zeigt nicht nur technische Skills, sondern auch Selbstreflexion und Durchhaltevermögen."

---

## 🎯 Gesprächs-Vorbereitung: Mögliche Fragen

### F: „Warum hast du so lange kein Git verwendet?"
**A:** "Anfangs war Git nicht Teil des Schulcurriculums. Bei der Korrektur habe ich gesehen, dass professionelle Entwicklung Versionskontrolle erfordert. Deshalb habe ich es nachgelernt – das ist Teil des Lernziels: selbstständig über den Unterrichtsstoff hinaugehen."

### F: „Warum Bubble Sort und nicht Quick Sort?"
**A:** "Bubble Sort ist einfacher zu verstehen und zu implementieren. Das Lernziel war, den Algorithmus selbst zu schreiben, nicht die effizienteste Variante zu nutzen. Für ein Schulprojekt ist Proof-of-Concept ausreichend. In der Praxis würde ich built-in Funktionen nutzen."

### F: „Wie hätte sich die Note ohne die Erweiterung entwickelt?"
**A:** "Ohne Erweiterungen: Mit den Kriterium-Fixes komme ich auf 36/36 Punkte (1.0). Git + Algorithmen sind **Boni**, die zeigen, dass ich über die Minimalanforderung hinaus gehe. Das ist relevant für die Note ≥1.0 bereich und für die Argumentation, dass ich professionell arbeite."

### F: „Welche Fehler hast du gemacht?"
**A:** "Großer Fehler: Ich habe nicht systematisch überprüft, ob Bilder im richtigen Verzeichnis sind. Das führte zu 0/4 Punkten bei D1. Lesson: Checklist vor Abgabe ist wichtig. Auch: @media-Queries sind Basic – hätte ich wissen müssen. Besser: Systematisches Testing statt Annahmen."

### F: „Was würdest du anders machen?"
**A:** "1) Früher Git einsetzen. 2) Checkliste mit allen Kriterien vor Abgabe durchlaufen. 3) Mehr Zeit für Bildoptimierung nehmen (Kompression, SEO-Attribute). 4) Algorithmen vorher mit Pseudocode skizzieren, nicht einfach coden."

---

## 📊 Handout (1 Seite für Prüfer)

**QR-Code:** Link zu GitHub Repo  
**Aktueller Stand:** v1.0.0 (Release)  
**Besuchbare Links:**

- 🌐 **Live-Demo:** http://localhost:8080 (vor Ort)
- 🐙 **GitHub:** [Link zu Repo]
- 📄 **Dokumentation:** `/docs/handbuch/` (README, ARCHITEKTUR, ALGORITHMEN)
- 📸 **Screenshots:** `/docs/handbuch/SCREENSHOTS/`

---

## 🎬 Ablauf: 15–20 Minuten Präsentation

```
| Zeit | Inhalt | Medium |
|------|--------|--------|
| 0:00–1:00 | Begrüßung + Ausgangslage (23/36 Punkte) | Slides/Screenshot |
| 1:00–5:00 | Kriterium-Fixes durchgehen (A1,D1,I1,J1) | Live-Demo + Terminal |
| 5:00–10:00 | Galerie-Demo (D1) + Responsive-Test | Browser + DevTools |
| 10:00–13:00 | Erweiterung 1: Git-Log + GitHub | Terminal + Browser |
| 13:00–17:00 | Erweiterung 2: Algorithmen-Demo | Browser + Code-Erläuterung |
| 17:00–20:00 | Q&A | Diskussion |
```

---

**Diese Verteidigungsvorbereitung ist bis zur Präsentation gültig (Juni 2026).**
