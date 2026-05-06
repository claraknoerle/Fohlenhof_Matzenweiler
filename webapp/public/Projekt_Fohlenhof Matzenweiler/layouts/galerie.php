<?php
include ("head.php") // Lädt den <head>-Bereich (CSS, Meta, evtl. JS)//
?>
<?php
include ("header.php") // Lädt den sichtbaren Seitenkopf / Navigation//
?>

    <?php
        // Deine Bild-Variable
    $meinBild ="bild/Bild 1.jfif";   // Bild 1
    $meinBild2 ="bild/Bild 2.jfif";  // Bild 2
    $meinBild3 ="bild/Bild 3.jfif";  // Bild 3
    $meinBild4 ="bild/Bild 4.jfif";  // Bild 4
    $meinBild5 ="bild/Bild 5.jfif";  // Bild 5
    $meinBild6 ="bild/Bild 6.jfif";  // Bild 6
    $meinBild7 ="bild/Bild 7.jfif";  // Bild 7
    $meinBild8 ="bild/Bild 8.jfif";  // Bild 8
    $meinBild9 ="bild/Bild 9.jfif";  // Bild 9
    $meinBild10 ="bild/Bild 10.jfif"; // Bild 10
    $meinBild11 ="bild/Bild 11.jfif"; // Bild 11
    $meinBild12 ="bild/Bild 12.jfif"; // Bild 12
    $meinBild13 ="bild/Bild 13.jfif"; // Bild 13
    $meinBild14 ="bild/Bild 14.jfif"; // Bild 14
									
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
 