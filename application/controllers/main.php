<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('CategoryList');

	}
	public function index()
	{
		
		
		$CategoryList = new CategoryList();
		$category_list = $CategoryList->getList();

		$data = array(
					'category_list'		=> $category_list,
					);

		$this->load->view('shop_header', $data);
		$this->load->view('home');
		$this->load->view('shop_footer');
	}

	



	

	
}

