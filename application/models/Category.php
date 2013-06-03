<?php
// models/Category.php

class Category extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setId($category_id)
	{

		$this->category_id = $category_id;

	}

	public function getData()
	{


		$sqltext = "SELECT * FROM categories WHERE category_id = '".$this->category_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function setData($data)
	{

		$this->category_id		= $data['category_id'];
		$this->category_title 	= $data['category_title'];
		$this->category_desc 	= $data['category_desc'];

	}

	public function save()
	{

		if($this->category_id) {

			$sqltext = "UPDATE categories SET 
							category_title = '".$this->category_title."',
							category_desc = '".$this->category_desc."' 
							WHERE category_id = '".$this->category_id."'";
			$query = $this->db->query($sqltext);

		} else {

			$sqltext = "INSERT INTO categories (
							category_title,
							category_desc
						) VALUES (
							'".$this->category_title."',
							'".$this->category_desc."'
						)";
			$query = $this->db->query($sqltext);

			$this->category_id = $this->db->insert_id();

		}

		return $this->category_id;

	}

}
?>