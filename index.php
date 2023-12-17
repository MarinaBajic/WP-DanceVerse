<?php
session_start();

require_once("classes/Utils.php");
$utils = new Utils();
$message_insert_dance = $utils->insertDance();

$add_form_class = Utils::isUserLoggedIn() && isset($_GET["add-dance"]) ? "" : "hidden";
$search_form_class = Utils::toggleComponentVisibility("search");

$message_photo = Utils::checkPhoto();

Utils::logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dance Verse</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>

	<?php include("header.php"); ?>

	<main class="main">
		<section class="hero">
			<img class="hero__bg" src="assets/bg.jpg">
			<div class="hero__banner banner">
				<h1 class="heading heading--h1">Dance Verse</h1>
				<span class="banner__desc">Dance your heart out!</span>
				<a class="banner__btn" href=".#dances">See choreographies</a>
			</div>
		</section>
		<section id="dances" class="section-bg dances">
			<div class="wrapper">
				<div class="dances__content">
					<form id="search" class="dances__search <?php echo $search_form_class; ?>" method="get">
						<label class="search__label" for="style">Search by style:</label>
						<select class="search__input" name="style" id="style">
							<option value="All">--all--</option>
							<?php
							foreach ($utils->getStyles() as $style) {
								echo "<option value='$style'>$style</option>";
							}
							?>
							<option value="Other">Other</option>
						</select>
						<input class="search__btn" type="submit" name="search" value="Search">
					</form>
					<div class="dances__print">
						<?php $utils->printDances(); ?>
					</div>
				</div>
			</div>
		</section>
		<section id="gallery" class="gallery <?php echo $user_logged_in ?>">
			<div class="wrapper">
				<div class="gallery__content">
					<h2 class="heading heading--h2">Shared gallery</h2>
					<form class="gallery__form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="MAX_FILE_SIZE" value="500000">
						<label for="photo" class="gallery__label">Your photo:</label>
						<input type="file" name="photo" id="photo" class="gallery__input">
						<input type="submit" value="Add photo" name="add-photo" class="gallery__btn">
					</form>
					<span class="message"><?php echo $message_photo ?></span>
					<div class="gallery__print">
						<?php
						Utils::printPhotos();
						?>
					</div>
				</div>
			</div>
		</section>
		<section id="add-dance" class="section-bg add-dance <?php echo $add_form_class; ?>">
			<div class="wrapper">
				<div class="add-dance__content">
					<h2 class="heading heading--h2">Add new dance</h2>
					<form class="add-dance__form form" method="post">
						<div class="form__item">
							<label for="title" class="form__label">Title</label>
							<input class="form__input" id="title" type="text" name="title" placeholder="Best Dance Ever">
						</div>
						<div class="form__item">
							<label for="choreographer" class="form__label">Choreographer</label>
							<input class="form__input" id="choreographer" type="text" name="choreographer" placeholder="Marina Bajic">
						</div>
						<div class="form__item">
							<label for="video-url" class="form__label">Video Url</label>
							<input class="form__input" id="video-url" type="text" name="video-url" placeholder="https://...">
						</div>
						<div class="form__item">
							<label for="music" class="form__label">Music</label>
							<input class="form__input" id="music" type="text" name="music" placeholder="Blackbear - Runnin low">
						</div>
						<div class="form__item">
							<label for="style" class="form__label">Dance Style</label>
							<select class="form__input" name="style" id="style">
								<option value="Other">--other--</option>
								<?php
								foreach ($utils->getStyles() as $style) {
									echo "<option value='$style'>$style</option>";
								}
								?>
							</select>
						</div>
						<div class="form__item">
							<label for="difficulty" class="form__label">Difficulty</label>
							<input class="form__input" id="difficulty" type="number" name="difficulty" placeholder="10" min="1" max="10">
						</div>
						<div class="form__item">
							<label for="duration" class="form__label">Duration</label>
							<input class="form__input" id="duration" type="time" name="duration" step="1">
						</div>
						<input class="form__btn" type="submit" value="Add new dance" name="add-dance">
					</form>
					<span class="message"><?php echo $message_insert_dance; ?></span>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>