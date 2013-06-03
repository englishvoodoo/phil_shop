<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Product extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('AdminProduct');
		$this->load->model('ProductOptions');
		$this->load->model('OptionGroup');
		$this->load->model('ProductImageList');

	}

	public function product_images()
	{

		$product_id = $this->uri->segment(4);

		$Product = new AdminProduct();
		$Product->setId($product_id);
		$product_detail = $Product->getData();

		$ProductImageList = new ProductImageList();
		$ProductImageList->setId($product_id);

		$image_list = $ProductImageList->getImages();

		$data = array(
					'product_detail'	=> $product_detail,
					'image_list'		=> $image_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_product_images', $data);
		$this->load->view('admin_footer');
	}

	public function product_options()
	{

		$product_id = $this->uri->segment(4);



		$Product = new AdminProduct();
		$Product->setId($product_id);
		$product_detail = $Product->getData();

		$ProductOptions = new ProductOptions();

		$ProductOptions->setProductId($product_id);

		$option_group_list = $ProductOptions->getOptionGroups();

		$OptionGroup = new OptionGroup();

		$option_group_full_list = $OptionGroup->getList();
	
		$data = array(
					'product_detail'			=> $product_detail,
					'option_group_list'			=> $option_group_list,
					'option_group_full_list'	=> $option_group_full_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_product_options', $data);
		$this->load->view('admin_footer');

	}

	public function product_add()
	{

		

		if($_POST) {

			// validate here
			$this->form_validation->set_rules('product_title', 'Product Title', 'required');
			$this->form_validation->set_rules('product_description', 'Product Description', 'required');
			$this->form_validation->set_rules('product_price', 'Product Price', 'required');

			if ($this->form_validation->run() == FALSE) {

				// reload the form and show the errors
				$this->load->view('admin_header');
				$this->load->view('admin_product_add');
				$this->load->view('admin_footer');

			} else {


				$product_id				= $this->input->post('product_id');

				$product_title 			= $this->input->post('product_title');
				$product_description 	= $this->input->post('product_description');
				$product_price 			= $this->input->post('product_price');
				$product_code 			= $this->input->post('product_code');
				$product_status 		= $this->input->post('product_status');
				$product_stock 			= $this->input->post('product_stock');

				$Product = new AdminProduct();
				$data = array(
							'product_id'			=> $product_id,
							'product_title'			=> $product_title,
							'product_description'	=> $product_description,
							'product_price'			=> $product_price,
							'product_code'			=> $product_code,
							'product_status'		=> $product_status,
							'product_stock'			=> $product_stock,
							);
				$Product->setData($data);
				$Product->save();
				$product_id = $Product->getId();

				$this->session->set_flashdata('status', 'updated');

				redirect('admin_product/product_detail/product_id/'.$product_id);

			}

		} else {

			$this->load->view('admin_header');
			$this->load->view('admin_product_add');
			$this->load->view('admin_footer');
		}

	}

	public function product_list()
	{

		
		$this->load->model('ProductList');


		$ProductList = new ProductList();
		$products = $ProductList->getData();

		
		
		$data = array(
					'products'	=> $products,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_product_list', $data);
		$this->load->view('admin_footer');

	}

	public function product_detail()
	{

		$this->load->model('Product');
		$this->load->model('CategoryProduct');
		$this->load->model('Categories');

		$product_id = $this->uri->segment(4);

		$Product = new AdminProduct();
		$Product->setId($product_id);
		$product_detail = $Product->getData();

		$CategoryProduct = new CategoryProduct();
		$CategoryProduct->setProductId($product_id);
		$category_list = $CategoryProduct->getList();
		$all_categories = $CategoryProduct->getRemainingList();

		

		$data = array(
					'product_detail'	=> $product_detail,
					'category_list'		=> $category_list,
					'all_categories'	=> $all_categories,
					);

		//var_dump($data);exit();

		$this->load->view('admin_header');
		$this->load->view('admin_product_detail', $data);
		$this->load->view('admin_footer');

	}

}

