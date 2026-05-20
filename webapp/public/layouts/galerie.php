<?php
include ("head.php") // Lädt den <head>-Bereich (CSS, Meta, evtl. JS)//
?>
<?php
include ("header.php") // Lädt den sichtbaren Seitenkopf / Navigation//
?>

    <?php
        // Deine Bild-Variable
    $meinBild ="images/Bild 1.jfif";   // Bild 1
    $meinBild2 ="images/Bild 2.jfif";  // Bild 2
    $meinBild3 ="images/Bild 3.jfif";  // Bild 3
    $meinBild4 ="images/Bild 4.jfif";  // Bild 4
    $meinBild5 ="images/Bild 5.jfif";  // Bild 5
    $meinBild6 ="images/Bild 6.jfif";  // Bild 6
    $meinBild7 ="images/Bild 7.jfif";  // Bild 7
    $meinBild8 ="images/Bild 8.jfif";  // Bild 8
    $meinBild9 ="images/Bild 9.jfif";  // Bild 9
    $meinBild10 ="images/Bild 10.jfif"; // Bild 10
    $meinBild11 ="images/Bild 11.jfif"; // Bild 11
    $meinBild12 ="images/Bild 12.jfif"; // Bild 12
    $meinBild13 ="images/Bild 13.jfif"; // Bild 13
    $meinBild14 ="images/Bild 14.jfif"; // Bild 14
									
    ?>
 
    <!-- Das Bild: Beim Klicken wird die Klasse "gross" an- oder ausgeschaltet -->
    <img src="<?php echo $meinBild; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild2; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild3; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild4; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild5; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild6; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild7; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild8; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild9; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild10; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild11; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild12; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
 		<img src="<?php echo $meinBild13; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
         <img src="<?php echo $meinBild14; ?>"
         class="bild"
         onclick="this.classList.toggle('gross')">
    
 
<?php
include ("footer.php") // Bindet den Footer ein (z.B. Impressum etc.)//
?>
 