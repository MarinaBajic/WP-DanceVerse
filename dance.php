<?php

require_once("classes/Utils.php");
$utils = new Utils();
$utils->deleteDance();

$dance_delete_class = "hidden";
if (Utils::isUserLoggedIn()) {
	$dance_delete_class = "";
}

$dance = null;
if (isset($_GET["id"])) {
	$dance = $utils->findDanceById($_GET["id"]);
}

$favorite_class = "hidden";
if (Utils::isUserLoggedIn()) {
	$favorite_class = "";
}

if (isset($_COOKIE["favorites"][$dance->getId()]) || isset($_GET["favorite"])) {
	$favorite_no_class = "hidden";
	$favorite_yes_class = "";
	$favorite_message = " -  Favorite !";
	if (isset($_GET["favorite"]) && $_GET["favorite"] == "no") {
		$favorite_no_class = "";
		$favorite_yes_class = "hidden";
		$favorite_message = " -  Add to favorites";
		setcookie("favorites[{$dance->getId()}]", $dance->getId(), time() - 0, "/");
	}
	else if (isset($_GET["favorite"])) {
		setcookie("favorites[{$dance->getId()}]", $dance->getId(), 0, "/");
	}
}
else {
	$favorite_no_class = "";
	$favorite_yes_class = "hidden";
	$favorite_message = " -  Add to favorites";
}

Utils::logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DanceVerse | <?php echo $dance->getTitle(); ?></title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php include("header.php"); ?>

	<main class="main">
		<section class="details">
			<div class="wrapper">
				<div class="details__content">
					<?php echo $dance->getHtmlDetails(); ?>
					<form method="post" class="<?php echo $dance_delete_class; ?>">
						<input type="hidden" name="dance-id" value="<?php echo $dance->getId(); ?>">
						<input class="details__btn" type="submit" name="delete" value="Delete choreography">
					</form>
					<div class="details__favorites favorites <?php echo $favorite_class; ?>">
						<a href="?id=<?php echo $dance->getId(); ?>&favorite">
							<img class="favorites__star <?php echo $favorite_no_class; ?>" src="assets/star-outline.svg" alt="star">
						</a>
						<a href="?id=<?php echo $dance->getId(); ?>&favorite=no">
							<img class="favorites__star <?php echo $favorite_yes_class; ?>" src="assets/star-fill.svg" alt="star">
						</a>
						<span class="favorites__text"><?php echo $favorite_message; ?></span>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>