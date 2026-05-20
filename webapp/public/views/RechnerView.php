<?php
class RechnerView {
    public function zeigeFormular($alter = "", $dauer = "") {
        echo '
        <div class="container rechner-form">
            <form id="rechner-form" method="post" novalidate>
                <div class="form-row">
                    <label for="alter">Aktuelles Alter (in Jahren)</label>
                    <input type="number" id="alter" name="alter" value="'.htmlspecialchars($alter).'" step="0.1" min="0" placeholder="z.B. 0.5" required>
                </div>
                <div class="form-row">
                    <label for="dauer">Dauer der Aufzucht (in Jahren)</label>
                    <input type="number" id="dauer" name="dauer" value="'.htmlspecialchars($dauer).'" step="0.1" min="0" placeholder="z.B. 3" required>
                </div>
                <div class="form-row">
                    <button type="submit" id="rechner-submit">Jetzt berechnen</button>
                </div>
            </form>

            <div id="rechner-result" class="result" aria-live="polite"></div>
        </div>
        <script src="js/rechner.js"></script>
        ';
    }

    public function zeigeErgebnisse($zukunftsalter, $gesamtkosten) {
        $k = number_format($gesamtkosten, 2, ',', '.');
        echo "<div id=\"server-result\" class=\"result\">";
        echo "<p><strong>Zukunftsalter:</strong> $zukunftsalter Jahre</p>";
        echo "<p><strong>Gesamtkosten:</strong> $k €</p>";
        echo "</div>";
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
                echo "<td>{$b['id']}</td>";
                echo "<td>{$b['alter']}</td>";
                echo "<td>{$b['dauer']}</td>";
                echo "<td>{$b['zukunftsalter']}</td>";
                echo "<td>{$preis} €</td>";
                echo "<td>{$b['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
    }
}
?>