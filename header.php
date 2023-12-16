<?php

require_once("classes/Utils.php");

$user_logged_in = Utils::isUserLoggedIn() ? "" : "hidden";
$log_in_btn = Utils::isUserLoggedIn() ? "hidden" : "";

$add_dance_link = Utils::isUserLoggedIn() ? ".?add-dance#add-dance" : "login.php";
$favorites_link = Utils::isUserLoggedIn() ? "favorites.php" : "login.php";

?>

<header class="header">
	<div class="wrapper">
		<div class="header__content">
			<a href="." class="logo">Dance<span>Verse</span></a>
			<nav class="nav">
				<a href=".#dances" class="nav__item">DANCES</a>
				<a href="<?php echo $add_dance_link; ?>" class="nav__item <?php echo $user_logged_in; ?>">ADD DANCE</a>
				<a href="<?php echo $favorites_link; ?>" class="nav__item <?php echo $user_logged_in; ?>">FAVORITES</a>
				<a href=".?search#search" class="nav__item">SEARCH</a>
			</nav>
			<div class="header__log log">
				<a href="login.php" class="log__btn <?php echo $log_in_btn; ?>">Log in</a>
				<form method="post" class="<?php echo $user_logged_in; ?>">
					<input type="submit" value="Log out" class="log__btn" name="logout">
				</form>
			</div>
		</div>
	</div>
</header>