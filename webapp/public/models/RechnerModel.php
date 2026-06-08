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

    public function berechneGesamtkosten(): float {
        $aufzuchtdauer = $this->zielalter - $this->alter;
        if ($aufzuchtdauer < 0) {
            return 0.0;
        }
        return $aufzuchtdauer * 12 * self::PREIS_PRO_MONAT;
    }
}
?>