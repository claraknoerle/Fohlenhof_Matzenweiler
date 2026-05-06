<?php
class RechnerModel {
    public $alter;
    public $dauer;
    public $preisProMonat = 300;
    private $pdo;

    public function __construct($alter, $dauer) {
        $this->alter = $alter;
        $this->dauer = $dauer;
        $this->connectDB();
    }

    private function connectDB() {
        try {
            $this->pdo = new PDO(
                'mysql:host=mysql;dbname=appdb;charset=utf8',
                'appuser',
                'userpass123'
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
        }
    }

    public function berechneZukunftsalter() {
        return $this->alter + $this->dauer;
    }

    public function berechneGesamtkosten() {
        return $this->dauer * 12 * $this->preisProMonat;
    }

    public function speichereBerechnung() {
        $zukunftsalter = $this->berechneZukunftsalter();
        $gesamtkosten = $this->berechneGesamtkosten();

        $stmt = $this->pdo->prepare("INSERT INTO berechnungen (alter, dauer, zukunftsalter, gesamtkosten) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->alter, $this->dauer, $zukunftsalter, $gesamtkosten]);

        return $this->pdo->lastInsertId();
    }

    public function holeAlleBerechnungen() {
        $stmt = $this->pdo->query("SELECT * FROM berechnungen ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>