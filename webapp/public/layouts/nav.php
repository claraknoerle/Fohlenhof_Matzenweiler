<?php
    $navBase = (strpos($_SERVER['SCRIPT_NAME'], '/layouts/') !== false) ? '../index.php' : '';
    $searchQuery = trim($_GET['q'] ?? '');
    $searchAction = 'search.php';
?>
<nav class="navigation">
 <!-- Navigation-Container (wird meist per CSS gestylt) -->
        <label for="menu-toggle" class="hamburger">&#9776; Menü</label><!--Label dient als Klick-Element (Hamburger-Menü ☰)Wenn man darauf klickt, wird die Checkbox mit der ID "menu-toggle" aktiviert/deaktiviert-->
        <input type="checkbox" id="menu-toggle"><!-- Unsichtbare Checkbox (wird per CSS versteckt)Steuert, ob das Menü geöffnet oder geschlossen ist -->

        <ul id="menu"> <!-- Liste mit den Navigationspunkten -->
            <li><a href="<?php echo $navBase; ?>#Home">Home</a></li>
            <li><a href="<?php echo $navBase; ?>#Über uns">Über uns</a></li>
            <li><a href="<?php echo $navBase; ?>#Anlage">Anlage</a></li>
            <li><a href="<?php echo $navBase; ?>#Team">Team</a></li>
            <li><a href="<?php echo $navBase; ?>#Angebote">Angebote</a></li>
            <li><a href="<?php echo $navBase; ?>#Bilder">Bilder</a></li>
            <li><a href="<?php echo $navBase; ?>#Kontakt">Kontakt</a></li>
            <li class="search-item">
                <input type="checkbox" id="search-toggle" class="search-toggle-checkbox" hidden>
                <label for="search-toggle" class="search-toggle" aria-label="Suche öffnen">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                        <circle cx="11" cy="11" r="7" fill="none" stroke="black" stroke-width="2" />
                        <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="black" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </label>
                <form action="<?php echo $searchAction; ?>" method="get" class="search-form">
                    <input type="search" name="q" value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Suchbegriff" aria-label="Suchbegriff">
                    <button type="submit">Suchen</button>
                </form>
            </li>
        </ul>
    </nav>