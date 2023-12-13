<?php

require_once("classes/Utils.php");
$utils = new Utils();
$utils->login();
$utils->insertUser();
$register_class = Utils::toggleComponentVisibility("register");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DanceVerse | Login</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<?php include("header.html"); ?>

	<main class="main">
		<section class="login">
			<div class="wrapper">
				<div class="login__content">
					<h2 class="heading heading--h2">Login</h2>
					<form class="login__form form" method="post">
						<div class="form__item">
							<label for="username" class="form__label">Username</label>
							<input type="text" id="username" class="form__input" name="username">
						</div>
						<div class="form__item">
							<label for="password" class="form__label">Password</label>
							<input type="password" id="password" class="form__input" name="password">
						</div>
						<input type="submit" value="Log in" name="login" class="form__btn">
					</form>
					<span class="login__footer">Don't have an account? <a href="login.php?register#register">Register here.</a></span>
				</div>
			</div>
		</section>
		<section id="register" class="<?php echo $register_class; ?>">
			<div class="wrapper">
				<div class="register__content">
					<h2 class="heading heading--h2">Register</h2>
					<form class="login__form form" method="post">
						<div class="form__item">
							<label for="username" class="form__label">Username</label>
							<input type="text" id="username" class="form__input" name="username">
						</div>
						<div class="form__item">
							<label for="password" class="form__label">Password</label>
							<input type="password" id="password" class="form__input" name="password">
						</div>
						<input type="submit" value="Register" name="register" class="form__btn">
					</form>
				</div>
			</div>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>

</html>