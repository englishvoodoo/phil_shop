<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Option extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="well text-error">', '</div>');

	}

	public function option_list()
	{

		$this->load->model('Option');
		
		$Option = new Option();

		$option_list = $Option->getList();

		$data = array(
					'option_list'	=> $option_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_option_list', $data);
		$this->load->view('admin_footer');

	}

	public function option_group_add()
	{

		$option_id 			= $this->input->post('option_id');
		$option_group_id 	= $this->input->post('option_group_id');
		$option_group_title = $this->input->post('option_group_title');

		$this->load->model('OptionGroup');

		$OptionGroup = new OptionGroup();

		$data = array(
					'option_id'				=> $option_id,
					'option_group_id'		=> $option_group_id,
					'option_group_title'	=> $option_group_title,
					);

		$OptionGroup->setData($data);
		$OptionGroup->save();

		redirect('admin_option/option_detail_groups/option_id/'.$option_id);

	}

	public function option_detail()
	{

		$this->load->model('Option');

		$option_id = $this->uri->segment(4);

		if($_POST) {

			$option_id = $this->input->post('option_id');

			$Option = new Option();

			$data = array(
							'option_id'			=> $option_id,
							'option_title'		=> $this->input->post('option_title'),
							'option_type_id'	=> $this->input->post('option_type_id'),
							);

			// validate
			$this->form_validation->set_rules('option_title', 'Title', 'required');

			if (!$this->form_validation->run() == FALSE) {
				// success : save
				$Option->setData($data);
				$Option->save();

				$option_id = $Option->getId();

				$this->session->set_flashdata('msg', 'Record saved');
			}

		}

		if($option_id) {

			// detail view

			$Option = new Option();
			$Option->setId($option_id);
			$option_details = $Option->getDetails();

			$data = array(
						'option_id'			=> $option_id,
						'option_title'		=> $option_details[0]->option_title,
						'option_type_id'	=> $option_details[0]->option_type_id,
						);

			$this->load->view('admin_header');
			$this->load->view('admin_option_detail', $data);
			$this->load->view('admin_footer');

		} else {

			// add view

			$data = array(
						'option_id'			=> '',
						'option_title'		=> '',
						'option_type_id'	=> '',
						);

			$this->load->view('admin_header');
			$this->load->view('admin_option_detail', $data);
			$this->load->view('admin_footer');
		
		}

	}

	public function option_detail_groups()
	{

		$option_id = $this->uri->segment(4);
		

		$this->load->model('Option');
		
		$Option = new Option();
		$Option->setId($option_id);

		$option_details = $Option->getDetails();


		$this->load->model('OptionGroup');

		$OptionGroup = new OptionGroup();

		$OptionGroup->setOptionId($option_id);
		$option_groups_list = $OptionGroup->getListByOptionId();

		$data = array(
					'option_details'		=> $option_details,
					'option_groups_list'	=> $option_groups_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_option_detail_groups', $data);
		$this->load->view('admin_footer');
	}

	public function option_groups()
	{

		$this->load->model('OptionGroup');

		$OptionGroup = new OptionGroup();

		$option_group_list = $OptionGroup->getList();

		$data = array(
					'option_group_list'	=> $option_group_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_option_group_list', $data);
		$this->load->view('admin_footer');
	}



	public function option_value_add()
	{

		$this->load->model('OptionValue');

		$option_value_id 	= $this->input->post('option_value_id');
		$option_group_id 	= $this->input->post('option_group_id');
		$option_value_title = $this->input->post('option_value_title');

		$data = array(
					'option_value_id'		=> $option_value_id,
					'option_group_id'		=> $option_group_id,
					'option_value_title'	=> $option_value_title,
					);

		$OptionValue = new OptionValue();
		$OptionValue->setData($data);
		$OptionValue->save();

		redirect('admin_option/option_group_values/option_group_id/'.$option_group_id);


	}

	public function option_group_values()
	{

		$option_group_id = $this->uri->segment(4);

		$this->load->model('OptionGroup');

		$OptionGroup = new OptionGroup();

		$OptionGroup->setId($option_group_id);

		$option_group_details = $OptionGroup->getDetails();
		$option_values_list = $OptionGroup->getValues();

		$data = array(
					'option_group_details'	=> $option_group_details,
					'option_values_list'	=> $option_values_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_option_group_values', $data);
		$this->load->view('admin_footer');

	}

	

	public function options()
	{

		$data = NULL;

		$this->load->view('admin_header');
		$this->load->view('admin_options_main', $data);
		$this->load->view('admin_footer');

	}

	public function options_colours()
	{

		$this->load->model('ColoursList');

		$ColoursList = new ColoursList();

		$colours_list = $ColoursList->getAll();

		$data = array(
					'colours_list'	=> $colours_list,
					);

		$this->load->view('admin_header');
		$this->load->view('admin_options_colours', $data);
		$this->load->view('admin_footer');

	}

	public function options_colours_add()
	{

		if($_POST) {

			// validate here
			$this->form_validation->set_rules('colour_title', 'Colour Title', 'required');
			
			if ($this->form_validation->run() == FALSE) {

				// reload the form and show the errors
				$this->load->view('admin_header');
				$this->load->view('admin_options_colours_add');
				$this->load->view('admin_footer');

			} else {

				$colour_id 			= $this->input->post('colour_id');
				$colour_title 			= $this->input->post('colour_title');
				
				$this->load->model('Colour');

				$Colour = new Colour();

				$data = array(
							'colour_id'		=> $colour_id,
							'colour_title'	=> $colour_title,
							
							);
				$Colour->setData($data);
				$Colour->save();
				$colour_id = $Colour->getId();

				$this->session->set_flashdata('status', 'updated');

				//redirect('admin/options_colours_detail/colour_id/'.$colour_id);
				redirect('admin/options_colours');

			}

		} else {

			$data = NULL;

			$this->load->view('admin_header');
			$this->load->view('admin_options_colours_add', $data);
			$this->load->view('admin_footer');

		}
	}

	public function options_colours_detail()
	{

		$this->load->model('Colour');

		$colour_id = $this->uri->segment(4);

		$Colour = new Colour();
		$Colour->setId($colour_id);

		$colour_details = $Colour->getDetails();

		$data = array(
					'colour_details'	=> $colour_details,
					);


		$this->load->view('admin_header');
		$this->load->view('admin_options_colours_detail', $data);
		$this->load->view('admin_footer');


	}

	public function options_sizes()
	{

		$data = NULL;

		$this->load->view('admin_header');
		$this->load->view('admin_options_sizes', $data);
		$this->load->view('admin_footer');

	}

	public function options_custom()
	{

		$data = NULL;

		$this->load->view('admin_header');
		$this->load->view('admin_options_custom', $data);
		$this->load->view('admin_footer');

	}
	
}

