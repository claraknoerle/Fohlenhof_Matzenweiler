<?php
/**
 * RechnerController.php - Controller für Fohlenkalkulator
 * 
 * Verantwortlichkeiten:
 * - Verarbeitet POST-Anfragen von RechnerView
 * - Validiert Eingaben (Alter und Zielalter)
 * - Orchestriert Berechnungslogik via RechnerModel
 * - Rendert Ausgabe über RechnerView
 * 
 * MVC-Pattern:
 * - Model (RechnerModel): Geschäftslogik für Kostencalculation
 * - View (RechnerView): HTML-Rendering und Frontend-Logik
 * - Controller (diese Datei): Koordination und Request-Handling
 */

require_once __DIR__ . '/../models/RechnerModel.php';
require_once __DIR__ . '/../views/RechnerView.php';

/**
 * Kalkulator-Controller für Fohlengütermittlung
 */
class RechnerController {
    /** @var RechnerView Instance der View-Klasse */
    private RechnerView $view;

    /**
     * Konstruktor - Initialisiert View-Komponente
     */
    public function __construct() {
        $this->view = new RechnerView();
    }

    /**
     * Validiert und liest Float-Werte aus POST-Request
     * 
     * @param string $name Name des POST-Parameters
     * @return float|null Validierter Float oder null bei Fehler
     */
    private function leseFloat(string $name): ?float {
        $value = filter_input(INPUT_POST, $name, FILTER_VALIDATE_FLOAT);
        return $value === false ? null : $value;
    }

    /**
     * Hauptmethode - Verarbeitet Request und Berechnung
     * 
     * Workflow:
     * 1. Formulardaten validieren
     * 2. Model-Berechnungen durchführen
     * 3. Formular und Ergebnisse via View rendern
     */
    public function starten() {
        // Eingabeparameter aus POST lesen und validieren
        $alter = $this->leseFloat('alter');
        $zielalter = $this->leseFloat('zielalter');
        $errors = [];
        $endAlter = null;
        $aufzuchtdauer = null;
        $gesamtkosten = null;

        // Bei POST-Request: Validierung und Berechnung
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eingabevalidierung
            if ($alter === null || $zielalter === null) {
                $errors[] = 'Bitte gib alter und Zielalter als gültige Zahlen ein.';
            } else {
                // Model instantiieren und Berechnungen durchführen
                $model = new RechnerModel($alter, $zielalter);
                $endAlter = $model->berechneZukunftsalter();
                $aufzuchtdauer = $model->berechneAufzuchtdauer();
                $gesamtkosten = $model->berechneGesamtkosten();
            }
        }

        // Formular rendern
        $this->view->zeigeFormular($alter ?? '', $zielalter ?? '');

        // Fehler bei Validierungsproblemen rendern
        if (!empty($errors)) {
            $this->view->zeigeFehler($errors);
        }

        // Berechnungsergebnisse rendern (wenn erfolgreiche Verarbeitung)
        if ($endAlter !== null && $aufzuchtdauer !== null && $gesamtkosten !== null) {
            $this->view->zeigeErgebnisse($endAlter, $aufzuchtdauer, $gesamtkosten);
        }
    }
}
?>