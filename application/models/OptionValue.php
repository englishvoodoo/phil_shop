<?php
// models/OptionValue.php

class OptionValue extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)
	{

		$this->option_value_id 		= $data['option_value_id'];
		$this->option_group_id 		= $data['option_group_id'];
		$this->option_value_title 	= $data['option_value_title'];

	}

	public function save()
	{

		if($this->option_value_id) {

			$sqltext = "UPDATE option_values SET option_value_title = '".$this->option_value_title."' WHERE option_value_id = '".$this->option_value_id."'";
			$query = $this->db->query($sqltext);
		
		} else {

			$sqltext = "INSERT INTO option_values (
							option_value_title, 
							option_group_id
							) VALUES (
							'".$this->option_value_title."',
							'".$this->option_group_id."'
							)";
			$query = $this->db->query($sqltext);

			$colour_id = $this->db->insert_id();

			$this->colour_id = $colour_id;

		}

	}

	public function getId()
	{

		return $this->option_id;
	}

	public function setId($option_value_id)
	{

		$this->option_value_id = $option_value_id;

	}

	public function getDetails()
	{

		$sqltext = "SELECT * FROM option_values WHERE option_value_id = '".$this->option_value_id."'";
		//echo "<BR>sqltext:".$sqltext;
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