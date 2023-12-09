<?php

require_once("constants.php");

class Database {

	private $conn;

	public function __construct($configFile = "config.ini")
	{
		if ($config = parse_ini_file($configFile)) {
			$host = $config["host"];
			$database = $config["database"];
			$user = $config["user"];
			$password = $config["password"];
			$this->conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
		} else
			exit("Missing configuration file.");
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function __destruct()
	{
		$this->conn = null;
	}

	public function getAllDances()
	{
		$result = array();
		$sql = "SELECT * FROM " . TBL_DANCE;
		try {
			$query_result = $this->conn->query($sql);
			foreach ($query_result as $q) {
				$result[] = $q;
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public function insertDance($title, $description, $difficulty, $style)
	{
		$sql = "INSERT INTO " . TBL_DANCE . " (" . COL_DANCE_TITLE . ", " . COL_DANCE_DESC . ", " . COL_DANCE_DIFFICULTY . ", " . COL_DANCE_STYLE . ") VALUES (:title, :description, :difficulty, :style);";
		try {
			$st = $this->conn->prepare($sql);
			$st->bindValue(":title", $title);
			$st->bindValue(":description", $description);
			$st->bindValue(":difficulty", $difficulty);
			$st->bindValue(":style", $style);
			$st->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
		return true;
	}

	public function deleteDance($id)
	{
		$sql = "DELETE FROM " . TBL_DANCE . " WHERE " . COL_DANCE_ID . " = :id";
		try {
			$st = $this->conn->prepare($sql);
			$st->bindValue(":id", $id);
			$st->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
		return true;
	}
}