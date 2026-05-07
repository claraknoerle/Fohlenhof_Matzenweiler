<?php
require_once 'models/RechnerModel.php';
require_once 'views/RechnerView.php';

class RechnerController {
    private $view;

    public function __construct() {
        $this->view = new RechnerView();
    }

    public function starten() {
        $alter = "";
        $dauer = "";
        $zukunftsalter = "";
        $gesamtkosten = "";
        $berechnungen = [];

        // Hole alle gespeicherten Berechnungen
        $model = new RechnerModel(0, 0); // Dummy für DB-Verbindung
        $berechnungen = $model->holeAlleBerechnungen();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alter = floatval($_POST['alter']);
            $dauer = floatval($_POST['dauer']);

            $model = new RechnerModel($alter, $dauer);
            $zukunftsalter = $model->berechneZukunftsalter();
            $gesamtkosten = $model->berechneGesamtkosten();

            // Speichere die Berechnung
            $model->speichereBerechnung();

            // Aktualisiere die Liste
            $berechnungen = $model->holeAlleBerechnungen();
        }

        $this->view->zeigeFormular($alter, $dauer);

        if ($zukunftsalter !== "" && $gesamtkosten !== "") {
            $this->view->zeigeErgebnisse($zukunftsalter, $gesamtkosten);
        }

        $this->view->zeigeBerechnungsHistorie($berechnungen);
    }
}
?>