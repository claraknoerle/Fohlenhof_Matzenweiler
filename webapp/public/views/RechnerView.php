<?php
/**
 * RechnerView.php - View-Schicht für Kalkulator-UI
 * 
 * Verantwortlichkeiten:
 * - HTML-Rendering des Kalkulatorformulars
 * - JavaScript-Integration für Frontend-Validierung
 * - Fehlerausgabe und Ergebnisdarstellung
 * - XSS-Schutz durch htmlspecialchars()
 */

class RechnerView {
    /**
     * Rendert das Kalkulator-Formular mit Eingabefeldern und JavaScript
     * 
     * Features:
     * - HTML-Form mit POST-Methode
     * - Frontend-Validierung via JavaScript
     * - Echtzeit-Berechnung am Client
     * - XSS-Schutz durch htmlspecialchars()
     * 
     * @param string $alter Altwert aus vorherigem Request
     * @param string $zielalter Zielalter-Altwert aus vorherigem Request
     */
    public function zeigeFormular($alter = "", $zielalter = "") {
        // Sicherheit: HTML-Special-Characters escapen gegen XSS
        $sicheresAlter = htmlspecialchars($alter, ENT_QUOTES, 'UTF-8');
        $sicheresZielalter = htmlspecialchars($zielalter, ENT_QUOTES, 'UTF-8');

        echo <<<HTML
        <div class="container rechner-form">
            <form id="rechner-form" method="post" novalidate>
                <!-- Eingabefeld: Aktuelles Fohlenalter -->
                <div class="form-row">
                    <label for="alter">Aktuelles Alter des Fohlens (in Jahren)</label>
                    <input type="number" id="alter" name="alter" value="$sicheresAlter" step="0.1" min="0" placeholder="z.B. 0.5" required>
                </div>
                <!-- Eingabefeld: Zielaufzuchtsalter -->
                <div class="form-row">
                    <label for="zielalter">Zielalter am Ende der Aufzucht (in Jahren)</label>
                    <input type="number" id="zielalter" name="zielalter" value="$sicheresZielalter" step="0.1" min="0" placeholder="z.B. 3" required>
                </div>
                <div class="form-row">
                    <button type="submit" id="rechner-submit">Jetzt berechnen</button>
                </div>
            </form>

            <div id="rechner-result" class="result" aria-live="polite"></div>
        </div>
        <script>
            // Warte auf vollständiges DOM-Rendering, bevor Event-Listener registriert werden
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('rechner-form');
                var resultEl = document.getElementById('rechner-result');
                var PRICE_PER_MONTH = 300; // Konstante: Monatliche Aufzuchtkosten

                // Sicherheit: Abbruch, wenn Formular nicht existiert
                if (!form) return;

                // Event-Listener für Formularabsendung
                form.addEventListener('submit', function(e) {
                    // Verhindere Standard-Form-Submission (wir verwenden JavaScript)
                    e.preventDefault();

                    // Input-Elemente referenzieren
                    var alterInput = document.getElementById('alter');
                    var zielalterInput = document.getElementById('zielalter');

                    // Eingabewerte parsen (deutsche Kommazahl -> Punkt-Dezimal)
                    var alter = parseFloat(alterInput.value.replace(',', '.'));
                    var zielalter = parseFloat(zielalterInput.value.replace(',', '.'));

                    // Array für Validierungsfehler
                    var errors = [];
                    // Validierung: Alter muss gültig und >= 0 sein
                    if (isNaN(alter) || alter < 0) {
                        errors.push('Gib ein gültiges aktuelles Alter >= 0 an.');
                    }
                    // Validierung: Zielalter muss gültig und >= 0 sein
                    if (isNaN(zielalter) || zielalter < 0) {
                        errors.push('Gib ein gültiges Zielalter >= 0 an.');
                    }
                    // Validierung: Zielalter muss >= aktuelles Alter sein
                    if (!isNaN(alter) && !isNaN(zielalter) && zielalter < alter) {
                        errors.push('Das Zielalter muss >= aktuelles Alter sein.');
                    }

                    // Bei Fehlern: Fehlermeldungen anzeigen und abbrechen
                    if (errors.length) {
                        resultEl.innerHTML = '<div class="error">' + errors.map(function(error) {
                            return '<p>' + error + '</p>';
                        }).join('') + '</div>';
                        return; // Abbruch
                    }

                    // Berechnungen durchführen (Client-seitig)
                    var aufzuchtdauer = zielalter - alter;
                    var gesamtkosten = aufzuchtdauer * 12 * PRICE_PER_MONTH;
                    
                    // Formatierung: Deutsche Währung (EUR) mit Locale-Format
                    var fmt = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });

                    // Ergebnisse in formatierter Karte anzeigen
                    resultEl.innerHTML = '<div class="result-card">' +
                        '<p><strong>Aufzucht bis Alter:</strong> ' + zielalter.toFixed(1) + ' Jahre</p>' +
                        '<p><strong>Aufzuchtdauer:</strong> ' + aufzuchtdauer.toFixed(1) + ' Jahre</p>' +
                        '<p><strong>Gesamtkosten:</strong> ' + fmt.format(gesamtkosten) + '</p>' +
                        '</div>';
                });
            });
        </script>
        HTML;
    }

    /**
     * Rendert Liste von Validierungsfehlern
     * 
     * @param array $errors Array mit Fehlermeldungen
     */
    public function zeigeFehler(array $errors) {
        // Keine Fehler: Abbruch
        if (empty($errors)) {
            return;
        }

        echo '<div class="error-list">';
        echo '<ul>';
        foreach ($errors as $error) {
            // XSS-Schutz: HTML-Entities escapen
            echo '<li>'.htmlspecialchars($error).'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    /**
     * Rendert Berechnungsergebnisse in formatierter Karte
     * 
     * Format: Deutsche Zahlenformatierung (Komma als Dezimaltrenner)
     * 
     * @param float $zielalter Zielalter in Jahren
     * @param float $aufzuchtdauer Aufzuchtdauer in Jahren
     * @param float $gesamtkosten Gesamtaufzuchtkosten in Euro
     */
    public function zeigeErgebnisse($zielalter, $aufzuchtdauer, $gesamtkosten) {
        // Deutsche Zahlenformatierung (Komma als Dezimaltrennzeichen, Punkt für Tausender)
        $k = number_format($gesamtkosten, 2, ',', '.');
        $dauer = number_format($aufzuchtdauer, 1, ',', '.');
        
        // XSS-Schutz: HTML-Entities escapen
        $sicheresZielalter = htmlspecialchars((string)$zielalter, ENT_QUOTES, 'UTF-8');
        $sicheresDauer = htmlspecialchars($dauer, ENT_QUOTES, 'UTF-8');

        // HTML-Ergebnisausgabe mit Formatierter Zahlen
        $html = '<div class="result-card">'
            . '<p><strong>Alter am Ende:</strong> ' . $sicheresZielalter . ' Jahre</p>'
            . '<p><strong>Aufzuchtdauer:</strong> ' . $sicheresDauer . ' Jahre</p>'
            . '<p><strong>Gesamtkosten:</strong> ' . $k . ' €</p>'
            . '</div>';

        $payload = json_encode($html, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        echo "<script>var result = document.getElementById('rechner-result'); if (result) { result.innerHTML = $payload; }</script>";
    }

    public function zeigeBerechnungsHistorie($berechnungen) {
        if (!empty($berechnungen)) {
            echo "<h2>Berechnungshistorie</h2>";
            echo "<div class=\"table-container\">";
            echo "<table>";
            echo "<tr><th>ID</th><th>Alter</th><th>Dauer</th><th>Zukunftsalter</th><th>Gesamtkosten</th><th>Datum</th></tr>";
            foreach ($berechnungen as $b) {
                $preis = number_format($b['gesamtkosten'], 2, ',', '.');
                echo "<tr>";
                echo '<td>' . htmlspecialchars((string)$b['id']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$b['alter']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$b['dauer']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$b['zukunftsalter']) . '</td>';
                echo '<td>' . $preis . ' €</td>';
                echo '<td>' . htmlspecialchars((string)$b['created_at']) . '</td>';
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
    }
}
?>