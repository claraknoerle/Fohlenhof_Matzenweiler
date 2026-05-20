<?php include 'layouts/head.php';?>
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
}
?>