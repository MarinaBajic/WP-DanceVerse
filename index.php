<?php

require_once("classes/Utils.php");
$utils = new Utils();
$utils->insertDance();
$form_class = Utils::toggleAddDanceVisibility();

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

	<?php include("header.html"); ?>

	<main class="main">
		<section class="hero">
			<img class="hero__bg" src="assets/bg.jpg">
			<div class="hero__banner banner">
				<h1 class="heading heading--h1">Dance Verse</h1>
				<span class="banner__desc">Dance your heart out!</span>
				<a class="banner__btn" href=".#dances">See choreographies</a>
			</div>
		</section>
		<section id="dances" class="dances">
			<div class="wrapper">
				<div class="dances__content">
					<?php $utils->printAllDances(); ?>
				</div>
			</div>
		</section>
		<section id="add-dance" class="<?php echo $form_class; ?>">
			<div class="wrapper">
				<div class="add-dance__content">
					<h2 class="heading heading--h2">Add new dance</h2>
					<form class="add-dance__form" method="post">
						<div class="add-dance__item">
							<label for="title" class="add-dance__label">Title</label>
							<input class="add-dance__input" id="title" type="text" name="title" placeholder="Best Dance Ever">
						</div>
						<div class="add-dance__item">
							<label for="choreographer" class="add-dance__label">Choreographer</label>
							<input class="add-dance__input" id="choreographer" type="text" name="choreographer" placeholder="Marina Bajic">
						</div>
						<div class="add-dance__item">
							<label for="video-url" class="add-dance__label">Video Url</label>
							<input class="add-dance__input" id="video-url" type="text" name="video-url" placeholder="https://...">
						</div>
						<div class="add-dance__item">
							<label for="music" class="add-dance__label">Music</label>
							<input class="add-dance__input" id="music" type="text" name="music" placeholder="Blackbear - Runnin low">
						</div>
						<div class="add-dance__item">
							<label for="style" class="add-dance__label">Dance Style</label>
							<select class="add-dance__input" name="style" id="style">
								<option value="Other">--other--</option>
								<?php
								foreach ($utils->getStyles() as $style) {
									echo "<option value='$style'>$style</option>";
								}
								?>
							</select>
						</div>
						<div class="add-dance__item">
							<label for="difficulty" class="add-dance__label">Difficulty</label>
							<input class="add-dance__input" id="difficulty" type="number" name="difficulty" placeholder="10" min="1" max="10">
						</div>
						<div class="add-dance__item">
							<label for="duration" class="add-dance__label">Duration</label>
							<input class="add-dance__input" id="duration" type="time" name="duration" step="1">
						</div>
						<input class="add-dance__btn" type="submit" value="Add new dance" name="add-dance">
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>