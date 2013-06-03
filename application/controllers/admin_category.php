<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Category extends CI_Controller {

	public function categories()
	{

		$this->load->model('CategoryList');

		$CategoryList = new CategoryList();

		$category_list = $CategoryList->getList();

		$data = array(
					'category_list'	=> $category_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_category_list', $data);
		$this->load->view('admin_footer');

	}

	public function category_detail()
	{

		$category_id = $this->uri->segment(4);

		$this->load->model('Category');

		$Category = new Category();

		$Category->setId($category_id);

		if($_POST) {

			$category_title = $this->input->post('category_title');
			$category_desc = $this->input->post('category_desc');

			$data = array(
						'category_id'		=> $category_id,
						'category_title'	=> $category_title,
						'category_desc'		=> $category_desc,
						);

			$Category->setData($data);
			$Category->save();


		} 

		$category_detail = $Category->getData();

		$data = array(
					'category_detail'	=> $category_detail,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_category_detail', $data);
		$this->load->view('admin_footer');

		

	}

	public function category_add()
	{

		$this->load->model('Category');

		if($_POST) {

			$category_title = $this->input->post('category_title');

			// validation here

			$Category = new Category();

			$data = array(
						'category_id'		=> '',
						'category_title'	=> $category_title,
						);
			$Category->setData($data);
			$category_id = $Category->save();


			redirect('admin/category_detail/category_id/'.$category_id);

		} else {
		
			$data = NULL;

			$this->load->view('admin_header');
			$this->load->view('admin_category_add', $data);
			$this->load->view('admin_footer');

		}

	}
}

