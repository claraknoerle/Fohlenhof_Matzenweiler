# Korrekturhilfe (Draft)

Projekt: schueler_clara
Rubrik: webprojekte
Punkte: 23.00 / 36.00
Note: 2.81

## Kriterien

- [teilweise] A1: Formales – Syntax, MVC, kein Rechner/Automat, Abgabe (3.00/4.00)
  Evidenz: PHP-CLI nicht verfuegbar, MVC-Ordner vorhanden: controllers, models, views, Dynamik-Hinweis in layouts/content.php
  Hinweis: Syntaxcheck nicht ausfuehrbar (php nicht installiert), neutral bewertet. | MVC-Konzept angewendet. | Dynamischer Teil (Rechner/Automat) erkannt. | Abgabe puenktlich. | Vier Teilprüfungen werden automatisch dokumentiert; Sonderregel zur milden Verspätung ist hinterlegt.
- [erfuellt] B1: Projektstruktur und Quellcode-Qualität (4.00/4.00)
  Evidenz: index.php, css/._styles.css, css/styles.css
  Hinweis: 3/3 Teilregeln erfüllt | Einrückung, relative PHP-Pfade (require __DIR__) und Effizienz manuell prüfen.
- [erfuellt] C1: Dynamisches Layout und Inhalt (4.00/4.00)
  Evidenz: index.php, views/RechnerView.php, models/RechnerModel.php
  Hinweis: 3/3 Teilregeln erfüllt | Box-Modell-Umsetzung und Browserkompatibilität manuell prüfen.
- [teilweise] D1: Bilder und Galerie (0.00/4.00)
  Evidenz: layouts/header.php, layouts/header2.php, layouts/footer.php
  Hinweis: 2/3 Teilregeln erfüllt. Nicht erfüllt: Keine Teilregel erfüllt: Nur 0 Datei(en) für 'images/*' gefunden, Minimum ist 3.; Nur 0 Datei(en) für 'img/*' gefunden, Minimum ist 3.; Nur 0 Datei(en) für 'bilder/*' gefunden, Minimum ist 3.; Nur 0 Datei(en) für 'assets/images/*' gefunden, Minimum ist 3.; Nur 0 Datei(en) für 'assets/img/*' gefunden, Minimum ist 3. | Bildoptimierung (<200 KB je Bild), Bedienbarkeit von Preview/View im Browser und Verlinkung externer Quellen manuell pruefen.
- [erfuellt] E1: Verweise – interne und externe Links (4.00/4.00)
  Evidenz: layouts/nav.php, layouts/footer.php, layouts/footer.php
  Hinweis: 2/2 Teilregeln erfüllt | Qualität und Sinnhaftigkeit der Navigation manuell prüfen.
- [erfuellt] F1: PHP-Eigenanteil und Formulare (4.00/4.00)
  Evidenz: ._header.php, ._content.php, index.php
  Hinweis: 2/2 Teilregeln erfüllt | Ideenreichtum, Eigenleistung und PHP-Qualität jenseits der Mindestanforderung manuell bewerten.
- [erfuellt] H1: Dokumentation aller Inhalte und Quellcodes (4.00/4.00)
  Evidenz: css/styles.css, css/galerie.css
  Hinweis: CSS-Kommentare vorhanden | Qualität und Vollständigkeit der Kommentierung manuell prüfen.
- [teilweise] I1: Farbgestaltung und Design (0.00/4.00)
  Evidenz: css/styles.css, css/galerie.css, css/styles.css
  Hinweis: 5/6 Teilregeln erfüllt. Nicht erfüllt: Regex '@media\s*\(' in keiner Datei für Muster '**/*.css' gefunden. | Gesamteindruck, gestalterische Konsistenz und tatsaechliche responsive Wirkung im Browser manuell pruefen.
- [teilweise] J1: Sonstige Features – Impressum, Datenschutz und KI-Inhalte (0.00/4.00)
  Evidenz: layouts/impressum.php, layouts/datenschutz.php
  Hinweis: 2/3 Teilregeln erfüllt. Nicht erfüllt: Keine Teilregel erfüllt: Regex '(?i)bildnachweis|bildquelle|quelle(?:n)?|lizenz|urheber|copyright|unsplash|pixabay|pexels|creative\s*commons|cc-by' in keiner Datei für Muster '**/*.php' gefunden.; Regex '(?i)bildnachweis|bildquelle|quelle(?:n)?|lizenz|urheber|copyright|unsplash|pixabay|pexels|creative\s*commons|cc-by' in keiner Datei für Muster '**/*.html' gefunden.; Regex '(?i)bildnachweis|bildquelle|quelle(?:n)?|lizenz|urheber|copyright|unsplash|pixabay|pexels|creative\s*commons|cc-by' in keiner Datei für Muster '**/*.md' gefunden.; Regex '(?i)bildnachweis|bildquelle|quelle(?:n)?|lizenz|urheber|copyright|unsplash|pixabay|pexels|creative\s*commons|cc-by' in keiner Datei für Muster '**/*.txt' gefunden. | Vollstaendigkeit von Impressum/Datenschutz, KI-Zitationen und Bildquellen/Lizenzen inhaltlich manuell pruefen.

## Zusammenfassung

Profil-basierte Erst-Korrekturhilfe 'Web-Projekt Oberstufe 2026'. 0 von 9 Kriterien erfordern manuelle Prüfung. Vorläufige Punkte bei ERFUELLT auf der 4/3/2/1-Skala anpassen.

## Marschplan: Vertiefung bis Anfang Juni

Zeige in der Verteidigung Anfang Juni, dass du dein Projekt nicht nur abgegeben, sondern weiterentwickelt hast. Zwei klar abgegrenzte Erweiterungen, gut dokumentiert und im Browser demonstrierbar, sind das Ziel.

### Erweiterung 1: Versionsverwaltung mit Git und GitHub

Git gehoert heute zum Handwerkszeug jeder Webentwicklerin. Ein sauberes GitHub-Repository mit nachvollziehbaren Commits zeigt in der Verteidigung, dass du professionell und strukturiert arbeitest. Das Thema ist gut in Eigenregie erlernbar und der Aufwand ist klar begrenzt.

**Aufwand und Schritte:** Zeitaufwand: ca. 3 Abende. Schritte: (1) GitHub-Account und oeffentliches Repository anlegen, (2) Projekt mit 'git init' initialisieren und in regelmaessigen Commits den Fortschritt dokumentieren, (3) einen Feature-Branch ('erweiterung-formular' o.ae.) erstellen, bearbeiten und mergen, (4) README.md mit Projektbeschreibung, Screenshot und Laufzeitanleitung ergaenzen. Dokumentation: Je Commit erklaeren, was geaendert wurde und warum.

### Erweiterung 2: Algorithmen und Datenstrukturen in PHP: Suchen und Sortieren

Algorithmen und Datenstrukturen sind das theoretische Fundament jeder Programmierung. Wenn du in deinem Projekt eine eigene Sortier- oder Suchfunktion in PHP implementierst, beweist du, dass du Logik nicht nur reproduzierst, sondern selbst entwickelst. Das ist in der Verteidigung ein wertvolles Demonstrationsobjekt.

**Aufwand und Schritte:** Zeitaufwand: ca. 3-4 Abende. Schritte: (1) Einen realen Anwendungsfall im eigenen Projekt identifizieren (z.B. Produktliste sortieren, Suchfunktion fuer Eintraege), (2) Lineare Suche und Bubble-Sort in PHP von Hand implementieren (kein usort()), (3) Beide Algorithmen mit einem realen Datensatz aus dem Projekt testen, (4) Laufzeitvergleich: einmal sort() und einmal eigener Algorithmus, Ergebnis dokumentieren. Dokumentation: Flussdiagramm des Algorithmus als Kommentar oder README-Abschnitt.

### ToDo-Liste

- Woche 1-2: Git-Repository anlegen, Projekt einpflegen, ersten Feature-Branch erstellen.
- Parallel: Kriterium 'Formales – Syntax, MVC, kein Rechner/Automat, Abgabe' gezielt nacharbeiten – das staerkt die Gesamtbewertung.
- Woche 2-3: Erweiterungsthema 'Algorithmen und Datenstrukturen in PHP: Suchen und Sortieren' recherchieren und Umsetzungsplan notieren.
- Woche 3-5: Erweiterung 'Algorithmen und Datenstrukturen in PHP: Suchen und Sortieren' implementieren und Schritt fuer Schritt dokumentieren.
- Woche 5-6: Beide Erweiterungen im Browser demonstrieren und fuer die Verteidigung aufbereiten.
- Woche 6: Kurzes Verteidigungsskript erstellen: Was hast du getan, was hast du gelernt, was wuerdest du anders machen?

