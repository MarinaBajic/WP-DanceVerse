<?php

class Dance {
	private $id;
	private $title;
	private $difficulty;
	private $style;
	private $video_url;
	private $choreographer;
	private $duration;
	private $music;

	public function __construct($id, $title, $difficulty, $style, $video_url, $choreographer, $duration, $music)
	{
		$this->id = $id;
		$this->title = $title;
		$this->difficulty = $difficulty;
		$this->style = $style;
		$this->video_url = $video_url;
		$this->choreographer = $choreographer;
		$this->duration = $duration;
		$this->music = $music;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getHtml() {
		return "
		<div class='dance'>
			<iframe class='dance_video' src=''></iframe>
			<span class='dance_heading'>{$this->title}</span>
			<span class='dance_choreographer'>by {$this->choreographer}</span>
		</div>
		";
	}
}