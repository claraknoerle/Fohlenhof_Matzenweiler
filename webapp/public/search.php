<?php
$searchQuery = trim($_GET['q'] ?? '');
$searchResults = [];

$items = [
    ['title' => 'Home', 'anchor' => 'Home', 'text' => 'Wir sind eine Familie aus Kißlegg im Allgäu und haben unsere Leidenschaft in die Aufzucht von Stutfohlen gesteckt. Auf unserem Hof wachsen die jungen Pferde in ruhiger, natürlicher Umgebung auf, mit viel Platz für Bewegung und Entfaltung.'],
    ['title' => 'Über uns', 'anchor' => 'Über uns', 'text' => 'Wir sind eine Familie aus Kißlegg im schönen Allgäu, die sich mit viel Herz und Hingabe der Aufzucht von Stutfohlen widmet. Auf unserem Hof wachsen die jungen Pferde in ruhiger Umgebung mit viel Platz und natürlicher Bewegung auf.'],
    ['title' => 'Anlage', 'anchor' => 'Anlage', 'text' => 'Unser idyllisch gelegener Fohlenhof in Matzenweiler bei Kißlegg bietet eine perfekte Kombination aus traditionellem Charme und modernem Komfort. Eingebettet in die wunderschöne Landschaft des Allgäus, bieten wir sowohl Pferden als auch ihren Besitzern ein Zuhause inmitten der Natur.'],
    ['title' => 'Team', 'anchor' => 'Team', 'text' => 'Wolfgang, Julia, Clara, Linda und Frieda sind Mitglieder unseres Familienbetriebs und arbeiten mit viel Herz und Erfahrung an der Aufzucht unserer Stutfohlen.'],
    ['title' => 'Angebote', 'anchor' => 'Angebote', 'text' => 'Wir bieten Stutfohlenaufzucht, Boxenhaltung und verschiedene Leistungen für junge Pferde im Allgäu.'],
    ['title' => 'Bilder', 'anchor' => 'Bilder', 'text' => 'Unsere Bildergalerie zeigt Eindrücke vom Hof, den Pferden und der Landschaft.'],
    ['title' => 'Kontakt', 'anchor' => 'Kontakt', 'text' => 'Kontaktiere uns telefonisch oder per E-Mail, wenn du Fragen zur Fohlenaufzucht oder zu unseren Angeboten hast.'],
];

if ($searchQuery !== '') {
    foreach ($items as $item) {
        if (stripos($item['text'], $searchQuery) !== false || stripos($item['title'], $searchQuery) !== false) {
            $searchResults[] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include __DIR__ . '/layouts/head.php'; ?>
</head>
<body>
    <header>
        <?php include __DIR__ . '/layouts/header.php'; ?>
    </header>
    <nav>
        <?php include __DIR__ . '/layouts/nav.php'; ?>
    </nav>
    <main class="search-page">
        <h1>Suche</h1>
        <form action="search.php" method="get">
            <input type="search" name="q" value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Suchbegriff eingeben..." aria-label="Suchbegriff">
            <button type="submit">Suchen</button>
        </form>

        <?php if ($searchQuery !== ''): ?>
            <section class="search-results">
                <h3>Suchergebnisse für „<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>"</h3>
                <?php if (count($searchResults) === 0): ?>
                    <p>Kein Ergebnis gefunden. Bitte versuche andere Begriffe.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($searchResults as $result): ?>
                            <li>
                                <strong><a href="index.php#<?php echo urlencode($result['anchor']); ?>">
                                    <?php echo htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </a></strong><br>
                                <?php echo htmlspecialchars($result['text'], ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>
    <footer>
        <?php include __DIR__ . '/layouts/footer.php'; ?>
    </footer>
</body>
</html>
