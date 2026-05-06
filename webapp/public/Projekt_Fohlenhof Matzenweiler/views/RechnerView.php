<?php
class RechnerView {
    public function zeigeFormular($alter = "", $dauer = "") {
        echo '
        <form method="post">
            <label>Aktuelles Alter (in Jahren):</label><br>
            <input type="text" name="alter" value="'.htmlspecialchars($alter).'" placeholder="z.B. 0.5"><br>
            <label>Dauer der Aufzucht (in Jahren):</label><br>
            <input type="text" name="dauer" value="'.htmlspecialchars($dauer).'" placeholder="z.B. 3"><br>
            <button type="submit">Jetzt berechnen</button>
        </form>
        ';
    }

    public function zeigeErgebnisse($zukunftsalter, $gesamtkosten) {
        echo "<p>Zukunftsalter: $zukunftsalter Jahre</p>";
        echo "<p>Gesamtkosten: ".number_format($gesamtkosten, 2, ',', '.')." €</p>";
    }

    public function zeigeBerechnungsHistorie($berechnungen) {
        if (!empty($berechnungen)) {
            echo "<h2>Berechnungshistorie</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Alter</th><th>Dauer</th><th>Zukunftsalter</th><th>Gesamtkosten</th><th>Datum</th></tr>";
            foreach ($berechnungen as $b) {
                echo "<tr>";
                echo "<td>{$b['id']}</td>";
                echo "<td>{$b['alter']}</td>";
                echo "<td>{$b['dauer']}</td>";
                echo "<td>{$b['zukunftsalter']}</td>";
                echo "<td>".number_format($b['gesamtkosten'], 2, ',', '.')." €</td>";
                echo "<td>{$b['created_at']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
?>