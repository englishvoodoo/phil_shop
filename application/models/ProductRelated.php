<?php
// models/ProductImage.php

class ProductRelated extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	
	public function setId($product_id) {

		$this->product_id = $product_id;

	}

	public function getList() {

		$sqltext = "SELECT * FROM product_related 
						JOIN products ON products.product_id = product_related.related_product_id 
						LEFT JOIN product_images ON product_images.product_id = products.product_id 
						WHERE 
						product_related.product_id = '".$this->product_id."' 
						GROUP BY products.product_id 
						ORDER BY product_images.image_type desc";
		//echo "<BR>sqltext:".$sqltext;
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	

	public function delete()
	{

		$sqltext = "DELETE FROM product_images WHERE product_id = '".$this->product_id."' AND image_id = '".$this->image_id."'";
		$query = $this->db->query($sqltext);

		return TRUE;

	}



	public function setData($data)
	{

		$this->product_id 			= $data['product_id'];
		$this->related_product_id 	= $data['related_product_id'];
	
	}

	public function save()
	{

		$sqltext = "SELECT * FROM product_related WHERE 
						product_id = '".$this->product_id."' AND 
						related_product_id = '".$this->related_product_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();
		if(!$result) {
			$sqltext = "INSERT INTO product_related (
							product_id,
							related_product_id
							) VALUES (
							'".$this->product_id."',
							'".$this->related_product_id."')";
			$query = $this->db->query($sqltext);
		}

	}

	
	

	

	
}
?>