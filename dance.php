<?php

require_once("classes/Utils.php");
$utils = new Utils();

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
	<title><?php echo $dance->getTitle(); ?></title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php include("header.html"); ?>

	<main class="main">
		<section class="details">
			<?php echo $dance->getHtmlDetails(); ?>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>