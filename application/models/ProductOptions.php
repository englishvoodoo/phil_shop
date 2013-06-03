<?php
// models/ProductOptions.php

class ProductOptions extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setData($data)
	{

		$this->product_id 		= $data['product_id'];
		$this->option_group_id 	= $data['option_group_id'];

	}

	public function add()
	{

		$sqltext = "INSERT INTO product_option_group (
							product_id,
							option_group_id
						) VALUES (
							'".$this->product_id."',
							'".$this->option_group_id."'
						)";
		$query = $this->db->query($sqltext);

	}

	public function delete()
	{

		$sqltext = "DELETE FROM product_option_group 
						WHERE 
						product_id = '".$this->product_id."' AND 
						option_group_id = '".$this->option_group_id."'";
		$query = $this->db->query($sqltext);
				
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

	public function getRemainingGroups()
	{

		$sqltext = "SELECT * FROM option_groups 
						WHERE option_group_id NOT IN (
							SELECT option_group_id FROM product_option_group WHERE product_id = '".$this->product_id."'
							)";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getOptionGroups()
	{

		$sqltext = "SELECT * FROM product_option_group 
						JOIN option_groups ON option_groups.option_group_id = product_option_group.option_group_id 
						WHERE 
						product_id = '".$this->product_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getProductOptions()
	{

		$sqltext = "SELECT * FROM product_option_group 
						JOIN option_groups ON option_groups.option_group_id = product_option_group.option_group_id 
						WHERE 
						product_id = '".$this->product_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();
		$result_array = array();
		$cnt = 0;
		foreach($result as $row) {

			$cnt ++;

			$option_group_id		= $row->option_group_id;
			$option_group_title		= $row->option_group_title;
			$option_group_legend	= $row->option_group_legend;

			//echo "<BR>[".$option_group_legend."] option_group_title:".$option_group_title;

			$result_array[$cnt]['option_group_id']	= $option_group_id;
			$result_array[$cnt]['option_group_title']	= $option_group_title;
			$result_array[$cnt]['option_group_legend']	= $option_group_legend;

			$sqltext = "SELECT * FROM option_values WHERE option_group_id = '".$option_group_id."' 
							ORDER BY option_value_title ASC";
			$query = $this->db->query($sqltext);
			$result2 = $query->result();
			$detail_array = array();
			$detail_cnt = 0;
			foreach($result2 as $row2) {

				$detail_cnt ++;

				$option_value_id	= $row2->option_value_id;
				$option_value_title	= $row2->option_value_title;

				//echo "<BR> :: option_value_title:".$option_value_title;

				$detail_array[$detail_cnt]['option_value_id'] = $option_value_id;
				$detail_array[$detail_cnt]['option_value_title'] = $option_value_title;

			}

			//var_dump($detail_array);

			$result_array[$cnt]['detail'] = $detail_array;

		}

		//var_dump($result_array);

		#foreach($result_array as $option_group) {
#
#			echo "<BR>option_group:".$option_group['option_group_legend'];
#
#			$option_value_array = $option_group['detail'];
#
#			foreach($option_value_array as $option_value) {
#
#				echo "<BR>-----option_value:".$option_value['option_value_title'];
#
#			}
#
#		}

		return $result_array;



	}

	

	public function setProductId($product_id)
	{

		$this->product_id = $product_id;

	}



	
}
?>