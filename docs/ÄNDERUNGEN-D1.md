# Änderungen D1 – Bilder & Galerie

**Ziel:** Eine funktionale Bildergalerie implementieren und das Kriterium D1 vollständig erfüllen.

## Ausgangslage

- Korrekturhilfe: Punktestand 0/4 bei D1
- Probleme: Keine Bilder in standardisierten Verzeichnissen (`images/`, `img/`, `bilder/`)
- Ziel: Mindestens 3 optimierte Bilder sowie eine Galerie mit responsive Darstellung

## Geplante Änderungen

1. `webapp/public/images/galerie/`
   - Verzeichnisstruktur für Bilder anlegen
   - Mindestens drei Bilder aufnehmen und optimieren

2. `webapp/public/layouts/galerie.php`
   - Neue Galerie-View mit `figure` und `figcaption`
   - Bildbeschreibung und Quelle einblenden

3. `webapp/public/css/galerie.css`
   - CSS Grid für responsive Galerie-Ansicht
   - Breakpoints für Desktop, Tablet und Mobile

4. `webapp/public/layouts/nav.php`
   - Galerie-Link zur Navigation hinzufügen

## Tests

- Galerie im Browser laden
- Verhalten auf Desktop, Tablet und Mobile prüfen
- Bildgröße < 200 KB verifizieren

## Begründung für die Verteidigung

Die Galerie ist das zentrale Feature für D1. Durch den Aufbau einer echten Bildergalerie zeige ich, dass ich nicht nur statischen Code schreibe, sondern visuelle Inhalte strukturiert und responsiv präsentiere.
