<?php

require_once("classes/Utils.php");

$login_btn_class = "log__btn";
$logout_btn_class = "hidden";
$add_dance_btn_class = "hidden";

if (Utils::isUserLoggedIn()) {
	$login_btn_class .= " hidden";
	$logout_btn_class = "";
	$add_dance_btn_class = "";
}

?>

<header class="header">
	<div class="wrapper">
		<div class="header__content">
			<a href="." class="logo">Dance<span>Verse</span></a>
			<nav class="nav">
				<a href=".#dances" class="nav__item">DANCES</a>
				<a href=".?add-dance#add-dance" class="nav__item <?php echo $add_dance_btn_class; ?>">ADD DANCE</a>
				<a href=".?search#search" class="nav__item">SEARCH</a>
			</nav>
			<div class="header__log log">
				<a href="login.php" class="<?php echo $login_btn_class; ?>">Log in</a>
				<form method="post" class="<?php echo $logout_btn_class; ?>">
					<input type="submit" value="Log out" class="log__btn" name="logout">
				</form>
			</div>
		</div>
	</div>
</header>