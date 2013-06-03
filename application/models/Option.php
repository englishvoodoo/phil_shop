<?php
// models/Option.php

class Option extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)
	{

		$this->option_id 		= $data['option_id'];
		$this->option_title 	= $data['option_title'];
		$this->option_type_id 	= $data['option_type_id'];

	}

	public function save()
	{

		if($this->option_id) {

			$sqltext = "UPDATE options SET 
							option_title = '".$this->option_title."',
							option_type_id = '".$this->option_type_id."'
							 WHERE option_id = '".$this->option_id."'";
			//echo "<BR>sqltext:".$sqltext;exit();
			$query = $this->db->query($sqltext);
		
		} else {

			$sqltext = "INSERT INTO options (
							option_title,
							option_type_id
						) VALUES (
							'".$this->option_title."',
							'".$this->option_type_id."'
						)";
			$query = $this->db->query($sqltext);

			$option_id = $this->db->insert_id();

			$this->option_id = $option_id;

		}

	}

	public function getId()
	{

		return $this->option_id;
	}

	public function setId($option_id)
	{

		$this->option_id = $option_id;

	}

	public function getDetails()
	{

		$sqltext = "SELECT * FROM options WHERE option_id = '".$this->option_id."'";
		$query = $this->db->query($sqltext);

		$result = $query->result();

		return $result;

	}
	

	public function getList()
	{

		$sqltext = "SELECT * FROM options ORDER BY option_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	
}
?>