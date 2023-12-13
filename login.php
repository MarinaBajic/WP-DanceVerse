<?php

session_start();

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
			<h2 class="header header--h2">Login</h2>
			<form class="login__form form" method="post">
				<div class="form__item">
					<label for="username" class="form__label">Username</label>
					<input type="text" id="username" class="form__input">
				</div>
				<div class="form__item">
					<label for="password" class="form__label">Password</label>
					<input type="password" id="password" class="form__input">
				</div>
				<input type="submit" value="Log in" name="Login" class="form__btn">
			</form>
		</section>
	</main>

	<?php include("footer.html"); ?>

</body>
</html>