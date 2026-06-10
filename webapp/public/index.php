
<?php
/**
 * index.php - Haupteinstiegspunkt der Webseite
 * 
 * Architektur:
 * - MVC-Pattern: Views als PHP-Layouts, Models/Controllers in separaten Dateien
 * - Modular aufgebaut mit PHP-Includes
 * - Responsive Design mit flexiblem Layout
 * 
 * Layout-Struktur:
 * 1. Head: Meta-Tags, CSS-Links
 * 2. Header: Logo und Branding
 * 3. Navigation: Hauptmenü
 * 4. Main: Dynamischer Inhalt (Content-Include)
 * 5. Footer: Menü, Impressum, Datenschutz
 */
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<?php include 'layouts/head.php';?>
	</head>
	<body>
		
			<header>
				<?php include 'layouts/header.php';?>
			</header>
			<nav>
				<?php include 'layouts/nav.php';?>
			</nav>
			<aside>
				<!-- Sidebar (optional) -->
			</aside>
			<main>
				<?php include 'layouts/content.php';?>
			</main>
			<footer>
				<?php include 'layouts/footer.php';?>
			</footer>
		
	</body>
</html>