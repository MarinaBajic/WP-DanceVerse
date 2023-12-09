<?php

require_once("db_utils.php");

$db = new Database();

print_r($db->getAllDances());
echo "<br>";

// $db->insertDance("test2", "desc", 2, "test2");
$db->deleteDance(0);
print_r($db->getAllDances());
echo "<br>";
`