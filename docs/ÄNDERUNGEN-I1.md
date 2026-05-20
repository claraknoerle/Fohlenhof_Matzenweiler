# Änderungen I1 – Farbgestaltung & Responsive Design

**Ziel:** Responsive Design durch @media-Queries und konsistente Gestaltung erreichen.

## Ausgangslage

- Korrekturhilfe: Punktestand 0/4 bei I1
- Probleme: Keine `@media`-Regex in CSS gefunden
- Ziel: Mindestens drei Breakpoints und responsives Layout implementieren

## Geplante Änderungen

1. `webapp/public/css/styles.css`
   - Breakpoint-Kommentare hinzufügen
   - `@media (max-width: 768px)` und `@media (max-width: 480px)` implementieren

2. `webapp/public/css/galerie.css`
   - Responsive Galerie-Grid anpassen
   - Mobile-Layout prüfen

3. Dokumentation
   - `docs/handbuch/ARCHITEKTUR.md` um responsive Gestaltungsprinzipien erweitern
   - `docs/VERTEIDIGUNG.md` um Erklärungen zu Breakpoints ergänzen

## Tests

- `grep -r "@media" webapp/public/css/`
- Responsive Test in Browser DevTools
- Kontrolle von Navigation und Textdarstellung auf kleinen Bildschirmen

## Begründung für die Verteidigung

Responsive Design ist heute Standard. Mit @media-Queries zeige ich, dass die Website auf verschiedenen Geräten korrekt skaliert und bedienbar bleibt.
