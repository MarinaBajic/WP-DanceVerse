<?php

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}

require_once("classes/Utils.php");
$utils = new Utils();

Utils::logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DanceVerse | Favorite Dances</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php include("header.php"); ?>

	<main class="main">
		<section class="section-bg favorites">
			<div class="wrapper">
				<div class="favorites__content">
					<h2 class="heading heading--h2">Favorite dances</h2>
					<div class="dances__print">
						<?php
						if (Utils::getFavoriteDances() == null) {
							echo "<span class='message'>No favorite dances :(</span>";
						} else {
							foreach (Utils::getFavoriteDances() as $dance) {
								echo $utils->findDanceById($dance)->getHtml();
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>