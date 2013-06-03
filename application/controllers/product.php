<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('ProductList');
		$this->load->model('ProductDetail');
		$this->load->model('ProductRelated');
		$this->load->model('ProductOptions');

		$this->load->model('CategoryList');
		$this->load->model('Category');

	}

	public function index()
	{

		
		
		$this->load->view('shop_header');
		$this->load->view('home');
		$this->load->view('shop_footer');
	}

	public function browse()
	{

		$category_id = $this->uri->segment(4);
		
		$ProductList = new ProductList();


		if($category_id) {

			$ProductList->setCategoryId($category_id);

			$Category = new Category();
			$Category->setId($category_id);
			$category_details = $Category->getData();
			$category_title = $category_details[0]->category_title;
			$category_desc 	= $category_details[0]->category_desc;
		} else {
			$category_title = '';
			$category_desc	= '';
		}

		$product_list = $ProductList->getData();
		

		$CategoryList = new CategoryList();
		$category_list = $CategoryList->getList();

		$data = array(
					'category_title'	=> $category_title,
					'category_desc'		=> $category_desc,
					'product_list'		=> $product_list,
					'category_list'		=> $category_list,
					);

		$this->load->view('shop_header', $data);
		$this->load->view('shop_product_browse', $data);
		$this->load->view('shop_footer');
	}

	public function detail()
	{
	
		$product_id = $this->uri->segment(4);

		$ProductDetail = new ProductDetail();
		$ProductDetail->setId($product_id);
		$product_details = $ProductDetail->getData();

		$product_images = $ProductDetail->getImageMain();

		$CategoryList = new CategoryList();
		$category_list = $CategoryList->getList();

		$ProductRelated = new ProductRelated();
		$ProductRelated->setId($product_id);
		$related_products = $ProductRelated->getList();

		$ProductOptions = new ProductOptions();
		$ProductOptions->setProductId($product_id);
		$product_options = $ProductOptions->getProductOptions();

		

	
		$data = array(
					'product_details'	=> $product_details,
					'product_images'	=> $product_images,
					'category_list'		=> $category_list,
					'related_products'	=> $related_products,
					'product_options'	=> $product_options,
					'category_title'	=> '',
					);

		//var_dump($data);exit();

		$this->load->view('shop_header', $data);
		$this->load->view('shop_product_detail', $data);
		$this->load->view('shop_footer');
	}

	



	

	
}

