<?php

require_once("database/Database.php");

class Utils
{

	private $db;
	private $message;
	private $styles;

	public function __construct()
	{
		$this->db = new Database();
		$this->message = "";
		$this->styles = array("Ballet", "Hip Hop", "Salsa", "Tango", "Bollywood", "Contemporary", "Ballroom", "Kathak", "Flamenco", "Krump");
	}

	public function getDatabase()
	{
		return $this->db;
	}

	public function getStyles()
	{
		return $this->styles;
	}

	public function getMessage()
	{
		if ($this->message != "") {
			return "
			<script type='text/javascript'>
				window.onload = function () { alert({$this->message}); } 
			</script>";
		}
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function printAllDances()
	{
		foreach ($this->db->getAllDances() as $dance) {
			echo $dance->getHtml();
		}
	}

	public function findDanceById($id)
	{
		foreach ($this->db->getAllDances() as $dance) {
			if ($dance->getId() == $id) {
				return $dance;
			}
		}
		return null;
	}

	public function insertDance()
	{
		if (isset($_POST["add-dance"])) {
			$title = htmlspecialchars($_POST["title"]);
			$difficulty = htmlspecialchars($_POST["difficulty"]);
			$style = htmlspecialchars($_POST["style"]);
			$video_url = htmlspecialchars($_POST["video-url"]);
			$choreographer = htmlspecialchars($_POST["choreographer"]);
			$duration = htmlspecialchars($_POST["duration"]);
			$music = htmlspecialchars($_POST["music"]);
			if ($this->db->insertDance($title, $difficulty, $style, $video_url, $choreographer, $duration, $music)) {
				$this->setMessage("Insert successful :D");
			} else {
				$this->setMessage("Insert unsuccessful :(");
			}
			header('Location: ' . $_SERVER['PHP_SELF']);
		}
	}

	public static function toggleAddDanceVisibility() {
		$form_class = "add-dance";
		if (!isset($_GET["add-dance"])) {
			$form_class .= " hidden";
		}
		return $form_class;
	}

}
