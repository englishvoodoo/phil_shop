<?php
// models/ProductImage.php

class ProductImage extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function resize()
	{

		
		// create the folder for this product if it doesn't already exist
		$product_image_folder = './product_images/'.$this->product_id;
		if(!file_exists($product_image_folder)) {
			echo "<BR>creating image folder";
			mkdir($product_image_folder);
		}

		// sort out the image name
		// is this a thumbnail?
		if($this->image_type == '2') {
			$tmp_array = explode(".", $this->image_src);

			// this isn't strictly correct... there may be full stops in the file name..
			$destination_image = $tmp_array[0]."_thumb.".$tmp_array[1];
		} else {
			$destination_image = $this->image_src;			
		}

		// sort out the image size
		if($this->image_type == '2') {
			$config['width']	= 100;
			$config['height']	= 100;
		} else {
			$config['width']	= 300;
			$config['height']	= 300;
		}

		$config['image_library'] = 'gd2';
		$config['quality']		= '100%';
		$config['source_image']	= './product_images/uploads/'.$this->image_src;
		$config['new_image'] 	= $product_image_folder.'/'.$destination_image;
		//$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		

		$this->load->library('image_lib', $config); 

		$this->image_lib->resize();

		echo $this->image_lib->display_errors();

		// for saving...
		$this->image_src = $destination_image;

		#echo "<BR>destination_image:".$destination_image;exit();

		#echo "<BR>done";
		#exit();

	}


	public function save()
	{


		$sqltext = "INSERT INTO product_images (
								product_id,
								image_src,
								image_type,
								image_alt
							) VALUES (
								'".$this->product_id."',
								'".$this->image_src."',
								'".$this->image_type."',
								'".$this->image_alt."'
							)";
		$query = $this->db->query($sqltext);

		

	}

	public function delete()
	{

		$sqltext = "DELETE FROM product_images WHERE product_id = '".$this->product_id."' AND image_id = '".$this->image_id."'";
		$query = $this->db->query($sqltext);

		return TRUE;

	}



	public function setData($data)
	{

		$this->image_id 	= $data['image_id'];
		$this->product_id 	= $data['product_id'];
		$this->image_src 	= $data['upload_data']['file_name'];
		$this->image_type 	= $data['image_type'];
		$this->image_alt 	= $data['image_alt'];



	}

	
	

	

	
}
?>