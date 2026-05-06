#!/usr/bin/env bash
set -euo pipefail

fail=0

note_fail() {
  echo "[arch] FAIL: $1"
  fail=1
}

echo "[arch] Starte Architekturvalidierung..."

# PHP-Syntax-Check
find webapp/ -name "*.php" -exec php -l {} \; >/dev/null 2>&1 || note_fail "PHP-Syntaxfehler gefunden"

# OOP-Guardrails: Keine direkten Datenbankabfragen außerhalb Models
if grep -r "new PDO\|mysqli_" webapp/public/Projekt_Fohlenhof\ Matzenweiler/controllers/ >/dev/null 2>&1; then
  note_fail "Controller führt direkte Datenbankoperationen aus (bitte Model verwenden)."
fi

# Kapselung: Keine öffentlichen Setter für interne Zustände
if grep -r "public function set" webapp/public/Projekt_Fohlenhof\ Matzenweiler/models/ >/dev/null 2>&1; then
  note_fail "Model exponiert mutierende Setter für interne Zustände."
fi

if [[ $fail -ne 0 ]]; then
  echo "[arch] Architekturvalidierung fehlgeschlagen"
  exit 1
fi

echo "[arch] Architekturvalidierung erfolgreich"
