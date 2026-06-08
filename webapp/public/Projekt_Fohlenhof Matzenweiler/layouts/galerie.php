<?php
include ("head.php") // Lädt den <head>-Bereich (CSS, Meta, evtl. JS)//
?>
<?php
include ("header.php") // Lädt den sichtbaren Seitenkopf / Navigation//
?>

    <?php
        $verzeichnisse = ['images', 'img', 'bilder', 'bild'];
        $bilder = [];
        foreach ($verzeichnisse as $verzeichnis) {
            $bilder = array_merge($bilder, glob($verzeichnis . '/*.{jfif,jpeg,jpg,png}', GLOB_BRACE) ?: []);
        }
        $bilder = array_unique($bilder);

        if (!empty($bilder)) {
            foreach ($bilder as $bild) {
                $titel = pathinfo($bild, PATHINFO_FILENAME);
                $alt = 'Foto vom Fohlenhof: ' . $titel;
                echo '<figure class="gallery-item">';
                echo '<img src="' . htmlspecialchars($bild) . '" alt="' . htmlspecialchars($alt) . '" class="bild" onclick="this.classList.toggle(\'gross\')">';
                echo '<figcaption>' . htmlspecialchars($titel) . '</figcaption>';
                echo '</figure>';
            }
        } else {
            echo '<p>Keine Bilder in den Ordnern images, img, bilder oder bild gefunden.</p>';
        }
    ?>
 
<?php
include ("footer.php") // Bindet den Footer ein (z.B. Impressum etc.)//
?>
 