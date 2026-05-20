# Änderungen J1 – Impressum, Datenschutz und Bildquellen

**Ziel:** Bildnachweise, Lizenzen und Datenschutzdokumentation vervollständigen.

## Ausgangslage

- Korrekturhilfe: Punktestand 0/4 bei J1
- Probleme: Keine Bildquelle/Lizenz in PHP-, HTML- oder Markdown-Dateien vorhanden
- Ziel: Vollständiges Bildquellen-Verzeichnis mit Lizenzangaben und ein Link im Footer

## Geplante Änderungen

1. `docs/BILDQUELLEN.md`
   - Vollständige Liste aller verwendeten Bilder
   - Quelle, Lizenz, Autor und Original-URL dokumentieren

2. `webapp/public/layouts/galerie.php`
   - Bildunterschriften mit Quelle und Lizenz einfügen
   - `alt`- und `title`-Attribute für Bilder ergänzen

3. `webapp/public/layouts/footer.php`
   - Link zur Bildquellen-Dokumentation hinzufügen

4. `webapp/public/layouts/datenschutz.php`
   - Datenschutzhinweis für externe Ressourcen ergänzen
   - Verweise auf Bildrechte und Lizenzen prüfen

## Tests

- `grep -r "pixabay\|unsplash\|cc-by\|copyright\|lizenz" webapp/public/ docs/`
- Darstellung von Imprint/Datenschutz prüfen
- Bildquellen-Dokumentation im Browser erreichbar machen

## Begründung für die Verteidigung

Mit vollständigen Bildnachweisen zeigt das Projekt rechtliche und ethische Sorgfalt. Das ist ein Qualitätsmerkmal, das über reine Programmierarbeit hinausgeht.
