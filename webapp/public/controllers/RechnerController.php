<?php include 'layouts/head.php';?>
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alter = floatval($_POST['alter']);
            $dauer = floatval($_POST['dauer']);

            $model = new RechnerModel($alter, $dauer);
            $zukunftsalter = $model->berechneZukunftsalter();
            $gesamtkosten = $model->berechneGesamtkosten();
        }

        $this->view->zeigeFormular($alter, $dauer);

        if ($zukunftsalter !== "" && $gesamtkosten !== "") {
            $this->view->zeigeErgebnisse($zukunftsalter, $gesamtkosten);
        }
    }
}
?>