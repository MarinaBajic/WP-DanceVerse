<?php

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}

require_once("classes/Utils.php");
$utils = new Utils();

$message_photo = Utils::checkProfilePhoto();
Utils::logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DanceVerse | Favorite Dances</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
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
					<form class="photo__form form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="500000">
						<div class="form__item">
							<label for="photo" class="form__label">Profile photo</label>
							<input type="file" name="photo" id="photo" class="form__input">
						</div>
						<input type="submit" value="Add photo" name="add-photo" class="form__btn">
						<span class="message"><?php echo $message_photo ?></span>
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>