<?php

require_once("database/db_utils.php");

$db = new Database();

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

	<?php
	foreach($db->getAllDances() as $dance) {
		echo $dance->getHtml();
	}
	?>

</body>

</html>