<?php

require_once("database/db_utils.php");
$db = new Database();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dance Verse</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<header class="header">
		<div class="wrapper">
			<div class="header_content">
				<a href="." class="logo">Dance<span>Verse</span></a>
				<nav class="nav">
					<a href="#" class="nav_item">DANCES</a>
					<a href="#" class="nav_item">ADD DANCE</a>
					<a href="#" class="nav_item">SEARCH</a>
				</nav>
			</div>
		</div>
	</header>

	<main>
		<section class="hero">
			<div class="hero_bg">
				<img src="assets/bg.jpg">
			</div>
			<div class="hero_banner">
				<h1 class="heading heading--h1">Dance Verse</h1>
			</div>
		</section>
		<?php
		foreach ($db->getAllDances() as $dance) {
			echo $dance->getHtml();
		}
		?>

	</main>

</body>

</html>