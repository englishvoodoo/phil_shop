<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Product_Delivery extends CI_Controller {

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
		$this->load->model('DeliverySchedule');
		$this->load->model('DeliveryScheduleProduct');

	}

	public function add() {

		$product_id 	= $this->input->post('product_id');
		$schedule_id 	= $this->input->post('schedule_id');

		$DeliveryScheduleProduct = new DeliveryScheduleProduct();
		$data = array(
					'product_id'	=> $product_id,
					'schedule_id'	=> $schedule_id,
					);
		$DeliveryScheduleProduct->setData($data);
		$DeliveryScheduleProduct->save();

		redirect('admin_product_delivery/index/product_id/'.$product_id);
	}

	public function index()
	{

		$product_id = $this->uri->segment(4);

		$Product = new Product();
		$Product->setId($product_id);
		$product_detail = $Product->getData();

		$DeliveryScheduleProduct = new DeliveryScheduleProduct();
		$DeliveryScheduleProduct->setProductId($product_id);
		$schedule_list = $DeliveryScheduleProduct->getListProduct();

		$full_schedule_list = $DeliveryScheduleProduct->getList();

		$data = array(
					'product_detail'	=> $product_detail,
					'schedule_list'		=> $schedule_list,
					'full_schedule_list'		=> $full_schedule_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_product_delivery', $data);
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

	public function do_upload()
	{

		$product_id = $this->input->post('product_id');
		$image_type = $this->input->post('image_type');
		$image_alt 	= $this->input->post('image_alt');


		$config['upload_path'] = './product_images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			var_dump($error);exit();
		}

		$data = array(
					'upload_data' 	=> $this->upload->data(),
					'product_id'	=> $product_id,
					'image_type'	=> $image_type,
					'image_alt'	=> $image_alt,
					);

		$ProductImage = new ProductImage();
		$ProductImage->setData($data);
		$ProductImage->resize();
		$ProductImage->save();

		// redirect to images list
		redirect('admin_product_images/index/product_id/'.$product_id);

	}

	

}

