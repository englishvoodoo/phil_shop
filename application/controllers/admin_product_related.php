<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Product_Related extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('Product');
		$this->load->model('ProductOptions');
		$this->load->model('OptionGroup');
		$this->load->model('ProductImageList');
		$this->load->model('ProductImage');
		$this->load->model('ProductRelated');
		$this->load->model('ProductList');

	}

	public function add() {

		$product_id 		= $this->input->post('product_id');
		$related_product_id = $this->input->post('related_product_id');

		$ProductRelated = new ProductRelated();
		$data = array(
					'product_id'			=> $product_id,
					'related_product_id'	=> $related_product_id,
					);
		$ProductRelated->setData($data);
		$ProductRelated->save();

		redirect('admin_product_related/index/product_id/'.$product_id);
	}

	public function index()
	{

		$product_id = $this->uri->segment(4);

		$Product = new Product();
		$Product->setId($product_id);
		$product_detail = $Product->getData();

		$ProductRelated = new ProductRelated();
		$ProductRelated->setId($product_id);
		$related_list = $ProductRelated->getList();

		$ProductList = new ProductList();
		$ProductList->setId($product_id);
		$product_list = $ProductList->getNonRelated();

		$data = array(
					'product_detail'	=> $product_detail,
					'related_list'		=> $related_list,
					'product_list'		=> $product_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_product_related', $data);
		$this->load->view('admin_footer');
	}

	public function delete()
	{
		
		$product_id = $this->uri->segment(4);
		$image_id 	= $this->uri->segment(6);

		$ProductImage = new ProductImage();

		$data = array(
					'product_id'	=> $product_id,
					'image_id'		=> $image_id,
					);
		$ProductImage->setData($data);
		$ProductImage->delete();

		// redirect to images list
		redirect('admin_product_images/index/product_id/'.$product_id);

	}

	

	

}

