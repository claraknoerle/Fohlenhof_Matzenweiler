<?php
require_once __DIR__ . '/../models/RechnerModel.php';
require_once __DIR__ . '/../views/RechnerView.php';

class RechnerController {
    private RechnerView $view;

    public function __construct() {
        $this->view = new RechnerView();
    }

    private function leseFloat(string $name): ?float {
        $value = filter_input(INPUT_POST, $name, FILTER_VALIDATE_FLOAT);
        return $value === false ? null : $value;
    }

    public function starten() {
        $alter = $this->leseFloat('alter');
        $zielalter = $this->leseFloat('zielalter');
        $errors = [];
        $endAlter = null;
        $aufzuchtdauer = null;
        $gesamtkosten = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($alter === null || $zielalter === null) {
                $errors[] = 'Bitte gib alter und Zielalter als gültige Zahlen ein.';
            } else {
                $model = new RechnerModel($alter, $zielalter);
                $endAlter = $model->berechneZukunftsalter();
                $aufzuchtdauer = $model->berechneAufzuchtdauer();
                $gesamtkosten = $model->berechneGesamtkosten();
            }
        }

        $this->view->zeigeFormular($alter ?? '', $zielalter ?? '');

        if (!empty($errors)) {
            $this->view->zeigeFehler($errors);
        }

        if ($endAlter !== null && $aufzuchtdauer !== null && $gesamtkosten !== null) {
            $this->view->zeigeErgebnisse($endAlter, $aufzuchtdauer, $gesamtkosten);
        }
    }
}
?>