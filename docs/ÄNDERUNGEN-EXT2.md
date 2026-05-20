# Änderungen EXT2 – Algorithmen & Datenstrukturen

**Ziel:** Eigene Algorithmus-Implementierung in PHP demonstrieren und erklären.

## Ausgangslage

- Korrekturhilfe: Erweiterungsthema vorgeschlagen, aber noch nicht umgesetzt
- Probleme: Keine selbst entwickelten Such- und Sortieralgorithmen im Projekt
- Ziel: Lineare Suche und Bubble Sort in PHP implementieren und gegenüber Built-in-Funktionen vergleichen

## Geplante Änderungen

1. `webapp/public/models/SearchAlgorithm.php`
   - Implementierung einer linearen Suche
   - Dokumentation der Komplexität O(n)

2. `webapp/public/models/SortAlgorithm.php`
   - Bubble-Sort-Implementierung
   - Vergleich mit PHP `sort()`

3. `webapp/public/layouts/algorithmen-demo.php`
   - Interaktive Demo: Suche und Sortierung im Browser
   - Anzeige von Laufzeiten und Ergebnissen

4. `docs/handbuch/ALGORITHMEN.md`
   - Pseudocode, Flussdiagramme, Komplexitätsanalyse
   - Erklärungen zu Best Case / Worst Case

## Tests

- Suche nach definierten Einträgen im Browser
- Vergleich Bubble Sort vs. PHP Sort
- Dokumentation der Messergebnisse

## Begründung für die Verteidigung

Eigenständige Algorithmus-Implementationen zeigen, dass ich nicht nur fertige Funktionen nutze, sondern die zugrundeliegende Logik verstehe. Das ist ein klarer Qualitätsbeweis für die schriftliche und mündliche Verteidigung.
