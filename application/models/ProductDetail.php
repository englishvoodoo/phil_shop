<?php
// models/ProductDetail.php

class ProductDetail extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)

	{

		$this->product_id 			= $data['product_id'];
		$this->product_title 		= $data['product_title'];
		$this->product_description 	= $data['product_description'];
		$this->product_price 		= $data['product_price'];
		$this->product_code 		= $data['product_code'];
		$this->product_status 		= $data['product_status'];
		$this->product_stock 		= $data['product_stock'];


	}

	public function getData()
	{

		$sqltext = "SELECT * FROM products WHERE product_id = '".$this->product_id."'";
		//echo "<BR>sqltext:".$sqltext;
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getImageMain()
	{

		$sqltext = "SELECT * FROM product_images WHERE product_id = '".$this->product_id."' AND image_type = '1'";
		$query = $this->db->query($sqltext);
		$result = $query->result();
		if($result) {

			return $result;

		} else {

			return NULL;

		}

	}

	public function save()
	{

		//echo "<BR>this->product_id:".$this->product_id;exit();
		if($this->product_id) {
			// update
			$sqltext = "UPDATE products SET 
							product_title = '".$this->product_title."',
							product_description = '".$this->product_description."',
							product_price = '".$this->product_price."',
							product_code = '".$this->product_code."',
							product_status = '".$this->product_status."',
							product_stock = '".$this->product_stock."'
							 WHERE product_id = '".$this->product_id."'";
			$this->db->query($sqltext);

		} else {
			// insert
			$sqltext = "INSERT INTO products (
								product_title,
								product_description,
								product_price,
								product_code,
								product_status,
								product_stock
								) VALUES (
								'".$this->product_title."',
								'".$this->product_description."',
								'".$this->product_price."',
								'".$this->product_code."',
								'".$this->product_status."',
								'".$this->product_stock."'
								)";
			$this->db->query($sqltext);

			$this->product_id = $this->db->insert_id();
		}
		

	}

	public function getId()
	{

		return $this->product_id;

	}

	public function setId($product_id)
	{

		$this->product_id = $product_id;

	}

}
?>