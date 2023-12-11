<?php

require_once("database/Database.php");

class Utils
{

	private $db;
	private $styles;

	public function __construct()
	{
		$this->db = new Database();
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
		$message = "";
		if (isset($_POST["add-dance"])) {
			$title = htmlspecialchars($_POST["title"]);
			$difficulty = htmlspecialchars($_POST["difficulty"]);
			$style = htmlspecialchars($_POST["style"]);
			$video_url = htmlspecialchars($_POST["video-url"]);
			$choreographer = htmlspecialchars($_POST["choreographer"]);
			$duration = htmlspecialchars($_POST["duration"]);
			$music = htmlspecialchars($_POST["music"]);
			if ($this->db->insertDance($title, $difficulty, $style, $video_url, $choreographer, $duration, $music)) {
				$message .= "Insert successful :D";
			} else {
				$message .= "Insert unsuccessful :(";
			}
			header('Location: ' . $_SERVER['PHP_SELF']);
		}
		return $message;
	}

	public function deleteDance()
	{
		$message = "";
		if (isset($_POST["delete"])) {
			$dance_id = htmlspecialchars($_POST["dance-id"]);
			if ($this->db->deleteDance($dance_id)) {
				$message .= "Delete successful :D";
			} else {
				$message .= "Delete unsuccessful :(";
			}
			header('Location: index.php');
		}
		return $message;
	}

	public static function toggleAddDanceVisibility() {
		$form_class = "add-dance";
		if (!isset($_GET["add-dance"])) {
			$form_class .= " hidden";
		}
		return $form_class;
	}

}
