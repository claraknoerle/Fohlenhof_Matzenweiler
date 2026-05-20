<?php include 'layouts/head.php';?>
<?php
class RechnerModel {
    public $alter;
    public $zielalter;
    public $preisProMonat = 300;

    public function __construct($alter, $zielalter) {
        $this->alter = $alter;
        $this->zielalter = $zielalter;
    }

    public function berechneZukunftsalter() {
        // Das Zielalter der Aufzucht
        return $this->zielalter;
    }

    public function berechneGesamtkosten() {
        // Kosten: von aktuellem Alter bis Zielalter
        $aufzuchtdauer = $this->zielalter - $this->alter;
        if ($aufzuchtdauer < 0) {
            return 0; // Zielalter darf nicht vor aktuellem Alter liegen
        }
        return $aufzuchtdauer * 12 * $this->preisProMonat;
    }
}
?>