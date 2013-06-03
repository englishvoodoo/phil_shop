<?php
// models/AjaxOutput.php

class AjaxOutput extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}


	public function setOutputType($output_type)
	{

		$this->output_type = $output_type;

	}

	public function outputDroplist()
	{

		$raw_options 	= $this->data['options'];
		$field_id		= $this->data['field_id'];
		$field_title	= $this->data['field_title'];

		$options = array();
	
		foreach($raw_options as $option_item) {

			$options[$option_item->$field_id] = $option_item->$field_title;

		}

		echo form_dropdown('add_option_group_id', $options, '', ' id= "add_option_group_id" ');

	}

	public function output()
	{

		switch($this->output_type)
		{


			case "product_option_group_droplist" :

				$option_group_droplist = $this->data['option_group_droplist'];

	
				$options = array();
				foreach($option_group_droplist as $option_group) {

					$options[$option_group->option_group_id] = $option_group->option_group_title;

				}

				echo form_dropdown('add_option_group_id', $options, '', ' id= "add_option_group_id" ');

				break;

			case "product_option_group_list" :

				$option_group_list = $this->data['option_group_list'];

				foreach($option_group_list as $option_group)
				{

					echo "<div>".$option_group->option_group_title." <a href='#' id='option_group_delete_btn' onclick='javascript:delete_product_option_group(".$option_group->option_group_id.");'>delete</a></div>";
				}
				//echo "done";
				break;

				break;

			case "product_category_list" :
				//var_dump($this->data['category_list']);
				$category_list = $this->data['category_list'];

				foreach($category_list as $category)
				{

					echo "<div>".$category->category_title." <a href='#' id='category_delete_btn' onclick='javascript:delete_product_category(".$category->category_id.");'>delete</a></div>";
				}
				//echo "done";
				break;

			case "product_category_droplist" :
				//var_dump($this->data['category_droplist']);
				$category_droplist = $this->data['category_droplist'];

				#foreach($category_droplist as $category)
				#{
#
#					echo "<div>".$category->category_title."</div>";
#				}

				$options = array();
				foreach($category_droplist as $tmp_category) {

					$options[$tmp_category->category_id] = $tmp_category->category_title;

				}

				echo form_dropdown('add_category_id', $options, '', ' id= "add_category_id" ');


				//echo "done";
				break;


		}

	}

	public function setData($data)
	{

		$this->data = $data;

	}

}
?>