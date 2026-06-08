<?php
class RechnerView {
    public function zeigeFormular($alter = "", $zielalter = "") {
        echo '
        <div class="container rechner-form">
            <form id="rechner-form" method="post" novalidate>
                <div class="form-row">
                    <label for="alter">Aktuelles Alter des Fohlens (in Jahren)</label>
                    <input type="number" id="alter" name="alter" value="'.htmlspecialchars($alter).'" step="0.1" min="0" placeholder="z.B. 0.5" required>
                </div>
                <div class="form-row">
                    <label for="zielalter">Zielalter am Ende der Aufzucht (in Jahren)</label>
                    <input type="number" id="zielalter" name="zielalter" value="'.htmlspecialchars($zielalter).'" step="0.1" min="0" placeholder="z.B. 3" required>
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

    public function zeigeErgebnisse($zielalter, $gesamtkosten) {
        $k = number_format($gesamtkosten, 2, ',', '.');
        echo "<div id=\"server-result\" class=\"result\">";
        echo "<p><strong>Aufzucht bis Alter:</strong> " . htmlspecialchars((string)$zielalter) . " Jahre</p>";
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