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

	public function findDanceById($id)
	{
		foreach ($this->db->getAllDances() as $dance) {
			if ($dance->getId() == $id) {
				return $dance;
			}
		}
		return null;
	}

	public static function printProfilePhoto()
	{
		if (isset($_FILES["photo"])) {
			echo "<div class='profile-photo'>";
			echo "<img src='assets/{$_FILES["photo"]["name"]}' alt='Profile photo'>";
			echo "</div>";
		}
	}

	public static function checkProfilePhoto()
	{
		$message = "";
		if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
			if ($_FILES["photo"]["type"] != "image/jpeg") {
				$message = "JPEG photos only, thanks!";
			} else if (!move_uploaded_file($_FILES["photo"]["tmp_name"], "assets/" . basename($_FILES["photo"]["name"]))) {
				$message = "Sorry, there was a problem uploading that photo. " . $_FILES["photo"]["error"];
			}
		} else if (isset($_FILES["photo"])) {
			switch ($_FILES["photo"]["error"]) {
				case UPLOAD_ERR_INI_SIZE:
					$message = "The photo is larger than the server allows.";
					break;
				case UPLOAD_ERR_FORM_SIZE:
					$message = "The photo is larger than the script allows.";
					break;
				case UPLOAD_ERR_NO_FILE:
					$message = "No file was uploaded. Make sure you choose a file to upload.";
					break;
				default:
					$message = "Please contact your server administrator for help.";
			}
		}
		return $message;
	}

	public function insertUser()
	{
		$message = "";
		if (!isset($_POST["register"])) {
			return $message;
		}
		if (empty($_POST["username"])) {
			$message = "Please enter a username.";
		} else if (empty($_POST["password"])) {
			$message = "Please enter a password.";
		} else {
			$username = htmlspecialchars($_POST["username"]);
			$password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
			if ($this->db->insertUser($username, $password)) {
				$message .= "Insert successful :D";
				header('Location: ' . $_SERVER['PHP_SELF']);
			} else {
				$message .= "Insert unsuccessful :(";
			}
		}
		return $message;
	}

	public function insertDance()
	{
		$message = "";
		if (!isset($_POST["add-dance"])) {
			return $message;
		}
		if (empty($_POST["title"])) {
			$message = "Please enter a title.";
		} else if (empty($_POST["difficulty"])) {
			$message = "Please enter difficulty.";
		} else if (empty($_POST["style"])) {
			$message = "Please select a dance style.";
		} else if (empty($_POST["video-url"])) {
			$message = "Please enter video url.";
		} else if (empty($_POST["choreographer"])) {
			$message = "Please enter a choreographer.";
		} else {
			$title = htmlspecialchars($_POST["title"]);
			$difficulty = htmlspecialchars($_POST["difficulty"]);
			$style = htmlspecialchars($_POST["style"]);
			$video_url = htmlspecialchars($_POST["video-url"]);
			$choreographer = htmlspecialchars($_POST["choreographer"]);
			$duration = htmlspecialchars($_POST["duration"]);
			$music = htmlspecialchars($_POST["music"]);
			if ($this->db->insertDance($title, $difficulty, $style, $video_url, $choreographer, $duration, $music)) {
				$message .= "Insert successful :D";
				header('Location: ' . $_SERVER['PHP_SELF']);
			} else {
				$message .= "Insert unsuccessful :(";
			}
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

	public function printAllDances()
	{
		foreach ($this->db->getAllDances() as $dance) {
			echo $dance->getHtml();
		}
	}

	public function filterByStyle()
	{
		if (isset($_GET["search"])) {
			$style = htmlspecialchars($_GET["style"]);
			if ($style == "All") {
				$this->printAllDances();
				return;
			}
			foreach ($this->db->getAllDances() as $dance) {
				if ($dance->getStyle() == $style) {
					echo $dance->getHtml();
				}
			}
		}
	}

	public function printDances()
	{
		if (!empty($_GET["search"])) {
			$this->filterByStyle();
		} else {
			$this->printAllDances();
		}
	}

	public static function toggleComponentVisibility($base_class)
	{
		if (!isset($_GET["$base_class"])) {
			$base_class .= " hidden";
		}
		return $base_class;
	}

	public function login()
	{
		$message = "";
		if (!isset($_POST["login"])) return;
		if (empty($_POST["username"]) || empty($_POST["password"])) {
			$message = "Please enter username AND password.";
			return $message;
		}

		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);

		foreach ($this->db->getAllUsers() as $user) {
			if ($username == $user->getUsername() && password_verify($password, $user->getPassword())) {
				Utils::loginSession($username);
				$message = "Login successful!";
				return $message;
			}
		}
		$message = "Invalid credentials.";
		return $message;
	}

	public static function loginSession($username)
	{
		session_start();
		$_SESSION["username"] = $username;
		header("Location: index.php");
	}

	public static function logout()
	{
		if (isset($_POST["logout"])) {
			setcookie("PHPSESSID", "", time() - 0, "/");
			session_destroy();
			header("Location: index.php");
		}
	}

	public static function isUserLoggedIn()
	{
		if (empty($_SESSION["username"])) {
			return false;
		}
		return true;
	}

	public static function getFavoriteDances()
	{
		if (empty($_COOKIE["favorites"][$_SESSION["username"]])) {
			return null;
		}
		return $_COOKIE["favorites"][$_SESSION["username"]];
	}
}
