<?php
// models/ColoursList.php

class ColoursList extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	

	public function getAll()
	{

		$sqltext = "SELECT * FROM colours ORDER BY colour_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	
}
?>