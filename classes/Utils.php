<?php

require_once("database/db_utils.php");

class Utils
{

	private $db;
	private $styles;

	public function __construct()
	{
		$this->db = new Database();
		$this->styles = array("Ballet", "Hip Hop", "Salsa", "Tango", "Bollywood", "Contemporary", "Ballroom", "Kathak", "Flamenco", "Krump");
	}

	public function getStyles() {
		return $this->styles;
	}

	public function printAllDances()
	{
		foreach ($this->db->getAllDances() as $dance) {
			echo $dance->getHtml();
		}
	}

}
