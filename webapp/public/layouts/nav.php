<?php
    $navBase = (strpos($_SERVER['SCRIPT_NAME'], '/layouts/') !== false) ? '../index.php' : '';
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
        </ul>
    </nav>