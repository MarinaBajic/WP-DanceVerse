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
			<iframe class='dance__video' src=''></iframe>
			<div class='dance__desc'>
				<span class='dance__heading'>{$this->title}</span>
				<span class='dance__choreographer'>by {$this->choreographer}</span>
			</div>
		</div>
		";
	}
}