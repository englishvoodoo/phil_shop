<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Delivery extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('DeliverySchedule');

	}

	
	public function index()
	{



		$DeliverySchedule = new DeliverySchedule();


		#$PhilClass = new PhilClass();
		#$PhilClass->input();
		#exit();

		$schedule_list = $DeliverySchedule->getList();

		$data = array(
					'schedule_list'	=> $schedule_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_delivery', $data);
		$this->load->view('admin_footer');

	}

	public function detail() {

		if($_POST) {

			$schedule_title = $this->input->post('schedule_title');
			$schedule_id 	= $this->input->post('schedule_id');

			$this->form_validation->set_rules('schedule_title', 'Title', 'required');

			if ($this->form_validation->run() == FALSE) {

			

				// reload the form
				$data = array(
							'schedule_id'		=> $schedule_id,
							'schedule_title'	=> set_value('schedule_title'),
							);

				$this->load->view('admin_header');
				$this->load->view('admin_delivery_detail', $data);
				$this->load->view('admin_footer');

			} else {

				// save the record

				$DeliverySchedule = new DeliverySchedule();
				$data = array(
							'schedule_id'		=> $schedule_id,
							'schedule_title' 	=> $schedule_title,
							);
				$DeliverySchedule->setData($data);
				$DeliverySchedule->save();

				redirect('admin_delivery/index');

			}

			

			

		} else {

			$schedule_id = $this->uri->segment(4);

			if($schedule_id) {

				$DeliverySchedule = new DeliverySchedule();
				$DeliverySchedule->setId($schedule_id);
				$schedule_details = $DeliverySchedule->getDetails();

				$data = array(
							'schedule_id'		=> $schedule_id,
							'schedule_title'	=> $schedule_details[0]->schedule_title,
							);

				$this->load->view('admin_header');
				$this->load->view('admin_delivery_detail', $data);
				$this->load->view('admin_footer');

			} else {

				$data = array(
							'schedule_id'		=> '',
							'schedule_title'	=> '',
							);

				$this->load->view('admin_header');
				$this->load->view('admin_delivery_detail', $data);
				$this->load->view('admin_footer');

			}

			

		}

	}

	

	

	

	
	
}

