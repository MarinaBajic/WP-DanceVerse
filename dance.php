<?php

require_once("classes/Utils.php");
$utils = new Utils();
$utils->deleteDance();

$dance = null;
if (isset($_GET["id"])) {
	$dance = $utils->findDanceById($_GET["id"]);
}

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
					<form method="post">
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