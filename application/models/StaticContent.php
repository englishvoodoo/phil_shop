<?php
// models/Content.php

class StaticContent extends CI_Model
{
	
	public function __construct()
	{

		

	}

	public function setPage($page)
	{

		$this->page = $page;

	}

	public function getContent()
	{

		switch($this->page)
		{

			case "about_us" :
				$content = "about us content";
				break;

			case "contact" :
				$content = "contact page";
				break;

			case "404" :
			default :
				$content = "sorry - page not found";
				break;


		}

		return $content;

	}

	

}
?>