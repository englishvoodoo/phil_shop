<?php
// models/ProductList.php

class ProductList extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function getData()
	{

		if(isset($this->category_id)) {
			$sqltext = "SELECT 
							products.product_id AS true_product_id,
							products.*,
							product_images.* FROM products 
							INNER JOIN category_product ON category_product.product_id = products.product_id 
							LEFT JOIN product_images ON product_images.product_id = products.product_id 
							WHERE 
							category_product.category_id = '".$this->category_id."'";
		} else {
			$sqltext = "SELECT 
							products.product_id AS true_product_id,
							products.*,
							product_images.* FROM products 
							LEFT JOIN product_images ON product_images.product_id = products.product_id 
							ORDER BY product_title ASC";
		}
//echo "<BR>sqltext:".$sqltext;exit();
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;
		
	}

	public function setID($product_id) {

		$this->product_id = $product_id;

	}

	public function setCategoryId($category_id)
	{

		$this->category_id = $category_id;

	}

	public function getNonRelated()
	{

		$sqltext = "SELECT * FROM products 
						WHERE 
						product_id NOT IN (SELECT related_product_id FROM product_related WHERE product_id = '".$this->product_id."') 
						ORDER BY product_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;
		
	}

	public function getByCategory()
	{


	}

}
?>