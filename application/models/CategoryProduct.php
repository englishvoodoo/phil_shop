<?php
// models/CategoryProduct.php

class CategoryProduct extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setProductId($product_id)
	{

		$this->product_id = $product_id;

	}

	public function setCategoryId($category_id)
	{

		$this->category_id = $category_id;

	}

	public function add()
	{

		$sqltext = "INSERT INTO category_product (
									category_id,
									product_id
								) VALUES (
									'".$this->category_id."',
									'".$this->product_id."'
									)";
		$this->db->query($sqltext);

	}

	public function delete()
	{

		$sqltext = "DELETE FROM category_product 
							WHERE 
							category_id = '".$this->category_id."' AND 
							product_id = '".$this->product_id."'";
		$this->db->query($sqltext);

	}

	public function getList()
	{

		$sqltext = "SELECT * FROM category_product 
						JOIN categories ON categories.category_id = category_product.category_id 
						WHERE product_id = '".$this->product_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getRemainingList()
	{

		$sqltext = "SELECT * FROM categories
							WHERE categories.category_id NOT IN
							(SELECT category_id FROM category_product WHERE category_product.product_id = '".$this->product_id."')";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

}
?>