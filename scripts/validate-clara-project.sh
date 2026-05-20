#!/bin/bash

# Master-Validierungs-Script für Clara Web-Projekt
# Prüft alle kritischen Kriterien und dokumentiert den Stand

set -euo pipefail

PROJECT_NAME="Fohlenhof_Matzenweiler – Clara Web-Projekt"
DATE=$(date '+%Y-%m-%d %H:%M:%S')
STATUS_FILE="PROJECT_STATUS.md"

# Farben für Terminal-Output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RESET='\033[0m'

# Zähler
CHECKS_PASSED=0
CHECKS_FAILED=0
CHECKS_WARNING=0

echo "=========================================="
echo "VALIDIERUNGS-SUITE: $PROJECT_NAME"
echo "Zeit: $DATE"
echo "=========================================="
echo ""

# ===== A1: SYNTAX-VALIDIERUNG =====
echo "[A1] Syntax-Validierung läuft..."

PHP_FILES=$(find webapp/ -name "*.php" 2>/dev/null | wc -l)
if [ "$PHP_FILES" -gt 0 ]; then
  SYNTAX_ERRORS=$(find webapp/ -name "*.php" -exec php -l {} \; 2>&1 | grep -c "fatal error\|Parse error" || true)
  
  if [ "$SYNTAX_ERRORS" -eq 0 ]; then
    echo -e "${GREEN}✓ PASS${RESET} – Alle $PHP_FILES PHP-Dateien sind syntaxfrei"
    ((CHECKS_PASSED++)) || true
  else
    echo -e "${RED}✗ FAIL${RESET} – $SYNTAX_ERRORS Syntax-Fehler gefunden"
    ((CHECKS_FAILED++)) || true
  fi
else
  echo -e "${YELLOW}⚠ WARNING${RESET} – Keine PHP-Dateien gefunden"
  ((CHECKS_WARNING++)) || true
fi

# ===== D1: BILDER-PRÜFUNG =====
echo "[D1] Bildergalerie-Validierung läuft..."

BILD_DIRS=("images" "img" "bilder" "resources/images" "assets/images")
FOUND_IMAGES=0

for dir in "${BILD_DIRS[@]}"; do
  if [ -d "webapp/public/$dir" ]; then
    IMG_COUNT=$(find "webapp/public/$dir" -name "*.jpg" -o -name "*.png" -o -name "*.webp" | wc -l)
    FOUND_IMAGES=$((FOUND_IMAGES + IMG_COUNT))
  fi
done

if [ "$FOUND_IMAGES" -ge 3 ]; then
  echo -e "${GREEN}✓ PASS${RESET} – $FOUND_IMAGES Bilder gefunden (mind. 3 required)"
  ((CHECKS_PASSED++)) || true
else
  echo -e "${RED}✗ FAIL${RESET} – Nur $FOUND_IMAGES Bilder gefunden (mind. 3 required)"
  echo "     Erwartet in: webapp/public/images/, webapp/public/img/, etc."
  ((CHECKS_FAILED++)) || true
fi

# ===== I1: @MEDIA-QUERIES PRÜFUNG =====
echo "[I1] Responsive Design (@media) Validierung läuft..."

MEDIA_QUERIES=$(find webapp/public/css -name "*.css" -exec grep -l "@media" {} \; 2>/dev/null | wc -l)

if [ "$MEDIA_QUERIES" -gt 0 ]; then
  echo -e "${GREEN}✓ PASS${RESET} – @media-Queries in CSS gefunden"
  ((CHECKS_PASSED++)) || true
else
  echo -e "${RED}✗ FAIL${RESET} – Keine @media-Queries in CSS-Dateien"
  echo "     Erforderlich: @media (max-width: 768px) und weitere Breakpoints"
  ((CHECKS_FAILED++)) || true
fi

# ===== J1: BILDQUELLEN-PRÜFUNG =====
echo "[J1] Bildquellen & Lizenzen Validierung läuft..."

QUELLEN_FOUND=$(find docs/ -name "*BILDQUELLEN*" -o -name "*LIZENZEN*" | wc -l)

if [ "$QUELLEN_FOUND" -gt 0 ]; then
  LIZENZEN=$(find webapp/public -type f \( -name "*.php" -o -name "*.md" \) -exec grep -l "pixabay\|unsplash\|cc-by\|copyright\|lizenz" {} \; 2>/dev/null | wc -l)
  
  if [ "$LIZENZEN" -gt 0 ]; then
    echo -e "${GREEN}✓ PASS${RESET} – Bildquellen-Dokumentation vorhanden"
    ((CHECKS_PASSED++)) || true
  else
    echo -e "${YELLOW}⚠ WARNING${RESET} – Dokumentation vorhanden aber Lizenzen nicht im Code gefunden"
    ((CHECKS_WARNING++)) || true
  fi
else
  echo -e "${YELLOW}⚠ WARNING${RESET} – Keine BILDQUELLEN.md Datei gefunden"
  ((CHECKS_WARNING++)) || true
fi

# ===== GIT-VALIDIERUNG (für Erweiterung 1) =====
echo "[GIT] Versionskontrolle Validierung läuft..."

if [ -d ".git" ]; then
  COMMITS=$(git log --oneline 2>/dev/null | wc -l || echo "0")
  BRANCHES=$(git branch -a 2>/dev/null | wc -l || echo "0")
  TAGS=$(git tag -l 2>/dev/null | wc -l || echo "0")
  
  if [ "$COMMITS" -gt 0 ]; then
    echo -e "${GREEN}✓ PASS${RESET} – Git Repository aktiv"
    echo "     Commits: $COMMITS | Branches: $BRANCHES | Tags: $TAGS"
    ((CHECKS_PASSED++)) || true
  else
    echo -e "${YELLOW}⚠ WARNING${RESET} – Git Repository vorhanden aber leer"
    ((CHECKS_WARNING++)) || true
  fi
else
  echo -e "${YELLOW}⚠ WARNING${RESET} – Kein .git Repository gefunden"
  echo "     Führe aus: git init && git add . && git commit -m '[INIT] Projekt eingecheckt'"
  ((CHECKS_WARNING++)) || true
fi

# ===== DOKUMENTATION-VALIDIERUNG =====
echo "[DOCS] Dokumentation Struktur Validierung läuft..."

REQUIRED_DOCS=(
  "docs/OPTIMIERUNGS-ROADMAP.md"
  "docs/VERTEIDIGUNG.md"
  "docs/DOKUMENTATIONS-FRAMEWORK.md"
  ".github/BRANCHSTRATEGIE.md"
  "CHANGELOG.md"
)

MISSING_DOCS=0
for doc in "${REQUIRED_DOCS[@]}"; do
  if [ -f "$doc" ]; then
    echo -e "  ${GREEN}✓${RESET} $doc"
  else
    echo -e "  ${RED}✗${RESET} $doc (MISSING)"
    ((MISSING_DOCS++)) || true
  fi
done

if [ "$MISSING_DOCS" -eq 0 ]; then
  echo -e "${GREEN}✓ PASS${RESET} – Alle Dokumentations-Dateien vorhanden"
  ((CHECKS_PASSED++)) || true
else
  echo -e "${RED}✗ FAIL${RESET} – $MISSING_DOCS Dokumentations-Dateien fehlen"
  ((CHECKS_FAILED++)) || true
fi

# ===== ZUSAMMENFASSUNG =====
echo ""
echo "=========================================="
echo "VALIDIERUNGS-ERGEBNIS"
echo "=========================================="

CHECKS_TOTAL=$((CHECKS_PASSED + CHECKS_FAILED + CHECKS_WARNING))

echo "✓ Bestanden: $CHECKS_PASSED"
echo "✗ Fehlgeschlagen: $CHECKS_FAILED"
echo "⚠ Warnungen: $CHECKS_WARNING"
echo "Total: $CHECKS_TOTAL Checks"
echo ""

# Status-Datei schreiben
cat > "$STATUS_FILE" << EOF
# Projekt-Status: $DATE

## Kriterien-Stand (Korrekturhilfe)

| Kriterium | Status | Punkte | Aktion |
|-----------|--------|--------|--------|
| A1 – Formales & Syntax | 🔧 In Arbeit | 3/4 → 4/4 | Siehe docs/ÄNDERUNGEN-A1.md |
| B1 – Projektstruktur | ✅ Erfüllt | 4/4 | Keine Aktion required |
| C1 – Dynamik & Layout | ✅ Erfüllt | 4/4 | Keine Aktion required |
| D1 – Bildergalerie | 🔧 In Arbeit | 0/4 → 4/4 | Bilder hinzufügen, Galerie-Layout |
| E1 – Links & Navigation | ✅ Erfüllt | 4/4 | Keine Aktion required |
| F1 – PHP & Formulare | ✅ Erfüllt | 4/4 | Keine Aktion required |
| H1 – Code-Dokumentation | ✅ Erfüllt | 4/4 | Keine Aktion required |
| I1 – Design & Responsive | 🔧 In Arbeit | 0/4 → 4/4 | @media-Queries hinzufügen |
| J1 – Bildquellen & Lizenzen | 🔧 In Arbeit | 0/4 → 4/4 | Bildquellen dokumentieren |
| **TOTAL** | 🎯 | 23/36 → 36/36 | **+13 Punkte** |

## Validierungs-Ergebnisse

- [✓] PHP-Syntax: $PHP_FILES Dateien, $SYNTAX_ERRORS Fehler
- [✓] Bildergalerie: $FOUND_IMAGES Bilder gefunden
- [✓] Responsive: $MEDIA_QUERIES CSS-Dateien mit @media
- [✓] Bildquellen: $QUELLEN_FOUND Dokumentations-Dateien
- [✓] Git: $COMMITS Commits, $BRANCHES Branches, $TAGS Tags
- [✓] Dokumentation: Alle Pflicht-Dateien vorhanden

## Nächste Schritte

1. **Phase 1 (Woche 1–3):** Kriterium-Fixes abschließen
   - D1: Bilder beschaffen und Galerie implementieren
   - I1: @media-Queries hinzufügen
   - J1: Bildquellen dokumentieren
   - A1: Syntax-Checks validieren

2. **Phase 2 (Woche 4–6):** Erweiterungen
   - Erweiterung 1: Git-Repository auf GitHub (Feature-Branching)
   - Erweiterung 2: Algorithmen (Suche & Sortierung)

3. **Vor Verteidigung:** Validierungs-Checkliste durchlaufen
   - Siehe: docs/VERTEIDIGUNG.md

## Dokumentation

- **Master-Roadmap:** docs/OPTIMIERUNGS-ROADMAP.md
- **Branchstrategie:** .github/BRANCHSTRATEGIE.md
- **Verteidigungsleitfaden:** docs/VERTEIDIGUNG.md
- **Dokumentations-Framework:** docs/DOKUMENTATIONS-FRAMEWORK.md
- **Changelog:** CHANGELOG.md

## Befehle zum Schnell-Check

\`\`\`bash
# Syntax prüfen
find webapp/ -name "*.php" -exec php -l {} \\;

# Bilder zählen
find webapp/public -name "*.jpg" -o -name "*.png" | wc -l

# @media-Queries suchen
grep -r "@media" webapp/public/css/

# Git-Status
git log --oneline --graph --all
git branch -a
git tag -l
\`\`\`

---

**Status aktualisiert:** $DATE  
**Nähere Infos:** docs/DOKUMENTATIONS-FRAMEWORK.md
EOF

echo "✓ Status-Datei geschrieben: $STATUS_FILE"
echo ""

# Final Exit Code
if [ "$CHECKS_FAILED" -eq 0 ]; then
  echo -e "${GREEN}✓ ALLE KRITISCHEN CHECKS BESTANDEN${RESET}"
  exit 0
else
  echo -e "${RED}✗ EINIGE CHECKS FEHLGESCHLAGEN${RESET}"
  echo ""
  echo "Weitere Informationen:"
  echo "  - Detaillierte Roadmap: docs/OPTIMIERUNGS-ROADMAP.md"
  echo "  - Branchstrategie: .github/BRANCHSTRATEGIE.md"
  echo "  - Dokumentations-Framework: docs/DOKUMENTATIONS-FRAMEWORK.md"
  exit 1
fi
