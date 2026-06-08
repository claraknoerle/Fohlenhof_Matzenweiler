<?php
class RechnerView {
    public function zeigeFormular($alter = "", $zielalter = "") {
        $sicheresAlter = htmlspecialchars($alter, ENT_QUOTES, 'UTF-8');
        $sicheresZielalter = htmlspecialchars($zielalter, ENT_QUOTES, 'UTF-8');

        echo <<<HTML
        <div class="container rechner-form">
            <form id="rechner-form" method="post" novalidate>
                <div class="form-row">
                    <label for="alter">Aktuelles Alter des Fohlens (in Jahren)</label>
                    <input type="number" id="alter" name="alter" value="$sicheresAlter" step="0.1" min="0" placeholder="z.B. 0.5" required>
                </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('rechner-form');
                var resultEl = document.getElementById('rechner-result');
                var PRICE_PER_MONTH = 300;

                if (!form) return;

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    var alterInput = document.getElementById('alter');
                    var zielalterInput = document.getElementById('zielalter');

                    var alter = parseFloat(alterInput.value.replace(',', '.'));
                    var zielalter = parseFloat(zielalterInput.value.replace(',', '.'));

                    var errors = [];
                    if (isNaN(alter) || alter < 0) {
                        errors.push('Gib ein gültiges aktuelles Alter >= 0 an.');
                    }
                    if (isNaN(zielalter) || zielalter < 0) {
                        errors.push('Gib ein gültiges Zielalter >= 0 an.');
                    }
                    if (!isNaN(alter) && !isNaN(zielalter) && zielalter < alter) {
                        errors.push('Das Zielalter muss >= aktuelles Alter sein.');
                    }

                    if (errors.length) {
                        resultEl.innerHTML = '<div class="error">' + errors.map(function(error) {
                            return '<p>' + error + '</p>';
                        }).join('') + '</div>';
                        return;
                    }

                    var aufzuchtdauer = zielalter - alter;
                    var gesamtkosten = aufzuchtdauer * 12 * PRICE_PER_MONTH;
                    var fmt = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });

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

    public function zeigeFehler(array $errors) {
        if (empty($errors)) {
            return;
        }

        echo '<div class="error-list">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>'.htmlspecialchars($error).'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    public function zeigeErgebnisse($zielalter, $aufzuchtdauer, $gesamtkosten) {
        $k = number_format($gesamtkosten, 2, ',', '.');
        $dauer = number_format($aufzuchtdauer, 1, ',', '.');
        $sicheresZielalter = htmlspecialchars((string)$zielalter, ENT_QUOTES, 'UTF-8');
        $sicheresDauer = htmlspecialchars($dauer, ENT_QUOTES, 'UTF-8');

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