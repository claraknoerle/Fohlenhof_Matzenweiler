<?php include 'layouts/head.php';?>
<?php
class RechnerModel {
    public $alter;
    public $dauer;
    public $preisProMonat = 300;

    public function __construct($alter, $dauer) {
        $this->alter = $alter;
        $this->dauer = $dauer;
    }

    public function berechneZukunftsalter() {
        // Alter nach Dauer
        return $this->alter + $this->dauer;
    }

    public function berechneGesamtkosten() {
        // Dauer in Monaten * Preis
        return $this->dauer * 12 * $this->preisProMonat;
    }
}
?>