<?php
// models/Categories.php

class Categories extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}


	public function getAll()
	{

		$sqltext = "SELECT * FROM categories ORDER BY category_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

}
?>