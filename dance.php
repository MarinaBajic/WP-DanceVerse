<?php

require_once("classes/Utils.php");
$utils = new Utils();
$utils->deleteDance();

$dance = isset($_GET["id"]) ? $utils->findDanceById($_GET["id"]) : null;

$favorite_dance_class = Utils::isUserLoggedIn() ? "" : "hidden";
$dance_delete_class = Utils::isUserLoggedIn() ? "" : "hidden";

$is_favorite = isset($_COOKIE["favorites"][$dance->getId()]);
$add_favorite = isset($_GET["favorite"]) && $_GET["favorite"] == "yes";
$remove_favorite = isset($_GET["favorite"]) && $_GET["favorite"] == "no";

$add_favorite_class = $add_favorite || $is_favorite ? "hidden" : "";
$remove_favorite_class = $add_favorite || $is_favorite ? "" : "hidden";
$favorite_message = $add_favorite || $is_favorite ? " - Favorite !" : " - Add to favorites";

if ($add_favorite) {
	setcookie("favorites[{$dance->getId()}]", $dance->getId(), 0, "/");
}
if ($remove_favorite) {
	setcookie("favorites[{$dance->getId()}]", $dance->getId(), time() - 0, "/");
	$add_favorite_class = "";
	$remove_favorite_class = "hidden";
	$favorite_message = " -  Add to favorites";
}


// if (isset($_COOKIE["favorites"][$dance->getId()]) || isset($_GET["favorite"])) {
// 	$favorite_no_class = "hidden";
// 	$favorite_yes_class = "";
// 	$favorite_message = " -  Favorite !";
// 	if (isset($_GET["favorite"]) && $_GET["favorite"] == "no") {
// 		$favorite_no_class = "";
// 		$favorite_yes_class = "hidden";
// 		$favorite_message = " -  Add to favorites";
// 		setcookie("favorites[{$dance->getId()}]", $dance->getId(), time() - 0, "/");
// 	}
// 	else if (isset($_GET["favorite"])) {
// 		setcookie("favorites[{$dance->getId()}]", $dance->getId(), 0, "/");
// 	}
// }
// else {
// 	$favorite_no_class = "";
// 	$favorite_yes_class = "hidden";
// 	$favorite_message = " -  Add to favorites";
// }

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
					<div class="details__favorites favorites <?php echo $favorite_dance_class; ?>">
						<a class="<?php echo $add_favorite_class; ?>" href="?id=<?php echo $dance->getId(); ?>&favorite=yes">
							<img class="favorites__star" src="assets/star-outline.svg" alt="star">
						</a>
						<a class="<?php echo $remove_favorite_class; ?>" href="?id=<?php echo $dance->getId(); ?>&favorite=no">
							<img class="favorites__star" src="assets/star-fill.svg" alt="star">
						</a>
						<span class="favorites__text"><?php echo $favorite_message; ?></span>
					</div>
					<form method="post" class="<?php echo $dance_delete_class; ?>">
						<input type="hidden" name="dance-id" value="<?php echo $dance->getId(); ?>">
						<input class="details__btn" type="submit" name="delete" value="Delete choreography">
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>