<?php
class RechnerModel {
    private float $alter;
    private float $zielalter;
    private const PREIS_PRO_MONAT = 300;

    public function __construct(float $alter, float $zielalter) {
        $this->alter = $alter;
        $this->zielalter = $zielalter;
    }

    public function berechneZukunftsalter(): float {
        return $this->zielalter;
    }

    public function berechneAufzuchtdauer(): float {
        $aufzuchtdauer = $this->zielalter - $this->alter;
        return $aufzuchtdauer < 0 ? 0.0 : $aufzuchtdauer;
    }

    public function berechneGesamtkosten(): float {
        $aufzuchtdauer = $this->berechneAufzuchtdauer();
        return $aufzuchtdauer * 12 * self::PREIS_PRO_MONAT;
    }
}
?>