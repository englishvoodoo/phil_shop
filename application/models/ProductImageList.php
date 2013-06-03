<?php
// models/ProductImageList.php

class ProductImageList extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)
	{

		$this->colour_id = $data['colour_id'];
		$this->colour_title = $data['colour_title'];

	}

	public function save()
	{

		if($this->colour_id) {

			$sqltext = "UPDATE colours SET colour_title = '".$this->colour_title."' WHERE colour_id = '".$this->colour_id."'";
			$query = $this->db->query($sqltext);
		
		} else {

			$sqltext = "INSERT INTO colours (colour_title) VALUES ('".$this->colour_title."')";
			$query = $this->db->query($sqltext);

			$colour_id = $this->db->insert_id();

			$this->colour_id = $colour_id;

		}

	}

	public function getId()
	{

		return $this->option_id;
	}

	public function setId($product_id)
	{

		$this->product_id = $product_id;

	}

	
	

	public function getImages()
	{

		$sqltext = "SELECT * FROM product_images WHERE product_id = '".$this->product_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	
}
?>