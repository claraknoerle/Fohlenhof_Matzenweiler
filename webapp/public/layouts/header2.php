<?php
    $headerBase = (strpos($_SERVER['SCRIPT_NAME'], '/layouts/') !== false) ? '../' : '';
?>
<header> <!-- Kopfbereich der Website -->

    <div class="header-title"> <!-- Container für Logo + Titel -->

        <img src="<?php echo $headerBase; ?>images/Logo.png" alt="Logo" class="logo-img"> 
        <!-- Logo-Bild (alt = Beschreibung für Barrierefreiheit/SEO) -->

        <h1>Fohlenhof Matzenweiler</h1> 
        <!-- Hauptüberschrift der Seite -->

    </div>

</header> <!-- Ende des Header-Bereichs -->