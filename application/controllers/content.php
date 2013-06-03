<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('StaticContent');
		$this->load->model('CategoryList');

	}
	public function page()
	{
		
		$Content = new StaticContent();

		$page = $this->uri->segment(3);

		if($page == '') {
			$page = '404';
		}

		

		$Content->setPage($page);

		
		$CategoryList = new CategoryList();
		$category_list = $CategoryList->getList();

		$data = array(
					'category_list'		=> $category_list,
					'page_content'	=> $Content->getContent(),
					);

		$this->load->view('shop_header', $data);
		$this->load->view('content_page', $data);
		$this->load->view('shop_footer');
	}



	



	

	
}

