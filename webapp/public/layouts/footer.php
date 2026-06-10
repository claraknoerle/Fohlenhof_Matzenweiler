<footer class="main-footer"> 
    <?php
        $footerBase = (strpos($_SERVER['SCRIPT_NAME'], '/layouts/') !== false) ? '../index.php' : '';
    ?>
    <div class="footer-container">
        
        <div class="footer-section"> <!-- Enthält Name, Adresse, Kontakt & Social Media -->
            <h2>Fohlenhof Matzenweiler</h2> <!-- Titel / Name -->
            <p>Matzenweiler 4<br>88353 Kißlegg</p>
            <p>07563 909254</p> <!-- Telefonnummer -->
            <p>
                <a href="mailto:fohlenhof.knorle@gmx.de" class="footer-link">fohlenhof.knorle@gmx.de</a> <!-- Klickbare E-Mail (öffnet Mailprogramm) -->
            </p>
            <div class="social-icons">  <!-- Container für Social Media Icons -->
                <a href="https://www.instagram.com/fohlenhof_matzenweiler/" target="_blank"> <!-- Öffnet Instagram im neuen Tab -->
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="instagram-icon"> <!-- Instagram Logo -->
                </a>
            </div>
        </div>

        <div class="footer-section right"> <!-- Navigationsbereich im Footer -->
            <h3>Menü</h3> <!-- Überschrift -->
            
            <ul class="footer-menu">  <!-- Liste mit Seiten-Links -->
            
                <li><a href="<?php echo $footerBase; ?>#Home" class="footer-link">Home</a></li>
                <li><a href="<?php echo $footerBase; ?>#Über uns" class="footer-link">Über uns</a></li>
                <li><a href="<?php echo $footerBase; ?>#Anlage" class="footer-link">Anlage</a></li>
                <li><a href="<?php echo $footerBase; ?>#Team" class="footer-link">Team</a></li>
                <li><a href="<?php echo $footerBase; ?>#Angebote" class="footer-link">Angebote</a></li>
                <li><a href="<?php echo $footerBase; ?>#Bilder" class="footer-link">Bilder</a></li>
                <li><a href="<?php echo $footerBase; ?>#Kontakt" class="footer-link">Kontakt</a></li>
                
            </ul>
        </div>

    </div>
              
    <div class="footer-bottom">  <!-- Unterer Bereich → Hinweis + rechtliche Links -->
        <p><i>Unsere Website befindet sich im Aufbau!</i></p> <!-- Info-Text -->
<div class="footer-legal-links">  <!-- Impressum & Datenschutz -->

<a href="layouts/impressum.php">Impressum</a>
<a href="layouts/datenschutz.php">Datenschutz</a>
    </div>
    </div>
</footer>