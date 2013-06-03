<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Ajax extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

	}
	
	public function ajax()
	{


		$action = $this->uri->segment(4);

		switch($action)
		{

			case "update_option_colour" :

				$this->load->model('Colour');

				$colour_id = $this->uri->segment(6);
				$colour_title = $this->uri->segment(8);

				$Colour = new Colour();
				$Colour->setId($colour_id);
				$data = array(
							'colour_id'	=> $colour_id,
							'colour_title' => $colour_title,
							);
				$Colour->setData($data);
				$Colour->save();

				break;

			case "add_product_category" :

				$this->load->model('CategoryProduct');

				$product_id = $this->uri->segment(6);
				$category_id = $this->uri->segment(8);

				$CategoryProduct = new CategoryProduct();
				$CategoryProduct->setProductId($product_id);
				$CategoryProduct->setCategoryId($category_id);

				$CategoryProduct->add();

				break;

			case "delete_product_category" :

				$this->load->model('CategoryProduct');

				$product_id = $this->uri->segment(6);
				$category_id = $this->uri->segment(8);
				
				$CategoryProduct = new CategoryProduct();
				$CategoryProduct->setProductId($product_id);
				$CategoryProduct->setCategoryId($category_id);
				
				$CategoryProduct->delete();

				break;

			case "reload_product_category_droplist" :

				$this->load->model('CategoryProduct');
				$this->load->model('AjaxOutput');

				$product_id = $this->uri->segment(6);
				
				$CategoryProduct = new CategoryProduct();
				$CategoryProduct->setProductId($product_id);
				$category_droplist = $CategoryProduct->getRemainingList();

				$AjaxOutput = new AjaxOutput();

				$data = array(
							'options'		=> $category_droplist,
							'field_id'		=> 'category_id',
							'field_title'	=> 'category_title',
							);
				$AjaxOutput->setData($data);
				
				$AjaxOutput->outputDroplist();

				break;

			case "reload_product_category_list" :

				$this->load->model('CategoryProduct');
				$this->load->model('AjaxOutput');

				$product_id = $this->uri->segment(6);
				
				$CategoryProduct = new CategoryProduct();
				$CategoryProduct->setProductId($product_id);
				$category_list = $CategoryProduct->getList();

				$AjaxOutput = new AjaxOutput();
				$AjaxOutput->setOutputType('product_category_list');
				$data = array(
							'category_list'	=> $category_list,
							);
				$AjaxOutput->setData($data);
				$AjaxOutput->output();

				//echo "<BR>******";

				break;

			case "reload_product_option_group_droplist":

				$this->load->model('ProductOptions');
				$this->load->model('AjaxOutput');

				$product_id = $this->uri->segment(6);
				
				$ProductOptions = new ProductOptions();
				$ProductOptions->setProductId($product_id);
				$option_group_droplist = $ProductOptions->getRemainingGroups();

				$AjaxOutput = new AjaxOutput();

				$data = array(
							'options'		=> $option_group_droplist,
							'field_id'		=> 'option_group_id',
							'field_title'	=> 'option_group_title',
							);
				$AjaxOutput->setData($data);
				
				$AjaxOutput->outputDroplist();

				break;

			case "reload_product_option_group_list":

				$this->load->model('ProductOptions');
				$this->load->model('AjaxOutput');

				$product_id = $this->uri->segment(6);
				
				$ProductOptions = new ProductOptions();
				$ProductOptions->setProductId($product_id);
				$option_group_list = $ProductOptions->getOptionGroups();

				$AjaxOutput = new AjaxOutput();
				$AjaxOutput->setOutputType('product_option_group_list');
				$data = array(
							'option_group_list'	=> $option_group_list,
							);
				$AjaxOutput->setData($data);
				$AjaxOutput->output();

				break;

			case "add_product_option_group":

				$this->load->model('ProductOptions');

				$product_id = $this->uri->segment(6);
				$option_group_id = $this->uri->segment(8);

				$ProductOptions = new ProductOptions();
				$data = array(
							'product_id'		=> $product_id,
							'option_group_id'	=> $option_group_id,
							);
				$ProductOptions->setData($data);
	
				$ProductOptions->add();

				break;

			case "delete_product_option_group":

				$this->load->model('ProductOptions');

				$product_id = $this->uri->segment(6);
				$option_group_id = $this->uri->segment(8);

				$ProductOptions = new ProductOptions();
				$data = array(
							'product_id'		=> $product_id,
							'option_group_id'	=> $option_group_id,
							);
				$ProductOptions->setData($data);
	
				$ProductOptions->delete();

				break;

		}
		


	}

}