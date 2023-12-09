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
			<div class="header__content">
				<a href="." class="logo">Dance<span>Verse</span></a>
				<nav class="nav">
					<a href="#" class="nav__item">DANCES</a>
					<a href="#" class="nav__item">ADD DANCE</a>
					<a href="#" class="nav__item">SEARCH</a>
				</nav>
			</div>
		</div>
	</header>

	<main class="main">
		<section class="hero">
			<img class="hero__bg" src="assets/bg.jpg">
			<div class="hero__banner banner">
				<h1 class="heading heading--h1">Dance Verse</h1>
				<span class="banner__desc">Dance your heart out!</span>
				<a class="banner__btn" href="#">See choreographies</a>
			</div>
		</section>
		<section class="dances">
			<div class="wrapper">
				<div class="dances__content">

				</div>
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