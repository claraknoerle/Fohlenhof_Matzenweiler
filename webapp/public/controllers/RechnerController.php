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
        $zielalter = "";
        $endAlter = "";
        $gesamtkosten = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alter = floatval($_POST['alter']);
            $zielalter = floatval($_POST['zielalter']);

            $model = new RechnerModel($alter, $zielalter);
            $endAlter = $model->berechneZukunftsalter();
            $gesamtkosten = $model->berechneGesamtkosten();
        }

        $this->view->zeigeFormular($alter, $zielalter);

        if ($endAlter !== "" && $gesamtkosten !== "") {
            $this->view->zeigeErgebnisse($endAlter, $gesamtkosten);
        }
    }
}
?>