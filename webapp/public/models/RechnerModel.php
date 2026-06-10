<?php
/**
 * RechnerModel.php - Geschäftslogik für Fohlengüterkalkulation
 * 
 * Verantwortlichkeiten:
 * - Berechnung des Aufzuchtalters und der Aufzuchtdauer
 * - Kostenermittlung basierend auf monatlicher Rate
 * - Sichere Handhabe mit privaten Properties und Type-Hints
 */

class RechnerModel {
    /** @var float Aktuelles Alter des Fohlens in Jahren */
    private float $alter;
    
    /** @var float Zielalter am Ende der Aufzucht in Jahren */
    private float $zielalter;
    
    /** @var int Monatliche Aufzuchtkosten in Euro */
    private const PREIS_PRO_MONAT = 300;

    /**
     * Konstruktor - Initialisiert Model mit Alter und Zielalter
     * 
     * @param float $alter Aktuelles Alter des Fohlens in Jahren
     * @param float $zielalter Zielalter am Ende der Aufzucht in Jahren
     */
    public function __construct(float $alter, float $zielalter) {
        $this->alter = $alter;
        $this->zielalter = $zielalter;
    }

    /**
     * Gibt das Zielalter am Ende der Aufzucht zurück
     * 
     * @return float Zielalter in Jahren
     */
    public function berechneZukunftsalter(): float {
        return $this->zielalter;
    }

    /**
     * Berechnet die Aufzuchtdauer in Jahren
     * 
     * Logik: Zielalter minus aktuelles Alter
     * Sicherheit: Negative Werte werden zu 0.0 normalisiert
     * 
     * @return float Aufzuchtdauer in Jahren (mindestens 0.0)
     */
    public function berechneAufzuchtdauer(): float {
        $aufzuchtdauer = $this->zielalter - $this->alter;
        // Normalisiere negative Werte
        return $aufzuchtdauer < 0 ? 0.0 : $aufzuchtdauer;
    }

    /**
     * Berechnet die Gesamtaufzuchtkosten
     * 
     * Formel: Aufzuchtdauer (Jahre) × 12 (Monate/Jahr) × Preis pro Monat
     * 
     * @return float Gesamtkosten in Euro
     */
    public function berechneGesamtkosten(): float {
        $aufzuchtdauer = $this->berechneAufzuchtdauer();
        // Berechne: Jahre -> Monate -> Kosten
        return $aufzuchtdauer * 12 * self::PREIS_PRO_MONAT;
    }
}
?>