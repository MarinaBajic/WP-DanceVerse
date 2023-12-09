<?php

require_once("constants.php");
require_once("classes/Dance.php");

class Database
{

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
			foreach ($query_result as $query) {
				$result[] = new Dance(
					$query[COL_DANCE_ID],
					$query[COL_DANCE_TITLE],
					$query[COL_DANCE_DIFFICULTY],
					$query[COL_DANCE_STYLE],
					$query[COL_DANCE_VIDEO],
					$query[COL_DANCE_CHOREOGRAPHER],
					$query[COL_DANCE_DURATION],
					$query[COL_DANCE_MUSIC]
				);
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $result;
	}

	public function insertDance($title, $description, $difficulty, $style, $video_url, $choreographer, $duration, $music)
	{
		$sql = "INSERT INTO " . TBL_DANCE . " (" . COL_DANCE_TITLE . ", " . COL_DANCE_DIFFICULTY . ", " . COL_DANCE_STYLE . ", " . COL_DANCE_VIDEO . ", " . COL_DANCE_CHOREOGRAPHER . ", " . COL_DANCE_DURATION . ", " . COL_DANCE_MUSIC . ") VALUES (:title, :description, :difficulty, :style, :video, :choreographer, :duration, :music);";
		try {
			$st = $this->conn->prepare($sql);
			$st->bindValue(":title", $title);
			$st->bindValue(":description", $description);
			$st->bindValue(":difficulty", $difficulty);
			$st->bindValue(":style", $style);
			$st->bindValue(":video", $video_url);
			$st->bindValue(":choreographer", $choreographer);
			$st->bindValue(":duration", $duration);
			$st->bindValue(":music", $music);
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
