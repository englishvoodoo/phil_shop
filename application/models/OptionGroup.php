<?php
// models/OptionGroup.php

class OptionGroup extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)
	{

		$this->option_id 			= $data['option_id'];
		$this->option_group_id 		= $data['option_group_id'];
		$this->option_group_title 	= $data['option_group_title'];

	}

	public function save()
	{

		if($this->option_group_id) {

			$sqltext = "UPDATE option_groups SET option_group_title = '".$this->option_group_title."' 
							WHERE option_group_id = '".$this->option_group_id."'";
			$query = $this->db->query($sqltext);
		
		} else {

			$sqltext = "INSERT INTO option_groups (
								option_group_title,
								option_id
							) VALUES (
								'".$this->option_group_title."',
								'".$this->option_id."'
							)";
			$query = $this->db->query($sqltext);

			$option_group_id = $this->db->insert_id();

			$this->option_group_id = $option_group_id;

		}

	}

	public function getId()
	{

		return $this->option_group_id;
	}

	public function setId($option_group_id)
	{

		$this->option_group_id = $option_group_id;

	}

	public function getDetails()
	{

		$sqltext = "SELECT * FROM option_groups WHERE option_group_id = '".$this->option_group_id."'";
		$query = $this->db->query($sqltext);

		$result = $query->result();

		return $result;

	}
	

	public function getList()
	{

		$sqltext = "SELECT * FROM option_groups ORDER BY option_group_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function setOptionId($option_id)
	{

		$this->option_id = $option_id;

	}

	public function getListByOptionId()
	{

		$sqltext = "SELECT * FROM option_groups 
						WHERE option_id = '".$this->option_id."' ORDER BY option_group_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getValues()
	{

		$sqltext = "SELECT * FROM option_values WHERE option_group_id = '".$this->option_group_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	
}
?>