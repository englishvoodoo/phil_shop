<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('cart');

		$this->load->model('Product');
		$this->load->model('ProductList');
		$this->load->model('ProductDetail');

		$this->load->model('OptionGroup');
		$this->load->model('OptionValue');

		$this->load->model('CategoryList');
		
		$this->load->model('objCart');

	}

	public function index()
	{
//$this->session->sess_destroy();exit();
		$CategoryList = new CategoryList();
		$category_list = $CategoryList->getList();

		$Cart = new objCart();
		$cart_lines = $Cart->getCartLines();

		$data = array(
					'category_list'		=> $category_list,
					'cart_lines'		=> $cart_lines,
					);
		
		$this->load->view('shop_header', $data);
		$this->load->view('shop_cart');
		$this->load->view('shop_footer');
	}

	

	public function add()
	{
	
		$product_id = $this->uri->segment(4);
		$options_str = $this->uri->segment(6);

		$quantity = $this->uri->segment(8);
		

		if($options_str != '___') {

			//echo "<BR>options_str:".$options_str;
		
			$options_str = substr($options_str,0, strlen($options_str)-1);

			$tmp_array = explode("-", $options_str);

			$options_array = array();

			$cnt = 0;
			foreach($tmp_array as $option_row) {
				$cnt ++;
				
				$option_row = str_replace("option_","",$option_row);
				
				$tmp = explode("_",$option_row);

				$options_array[$cnt]['id']	= $tmp[0];
				$options_array[$cnt]['value']	= $tmp[1];

			}

		} else {

			$options_array = NULL;

		}

		//var_dump($options_array);exit();
		
		$Product = new Product();
		$Product->setId($product_id);
		$product_details = $Product->getData();

		
		$Cart = new objCart();

		$data = array(
					'product_id'	=> $product_id,
					'name'			=> $product_details[0]->product_title,
					'price'			=> $product_details[0]->product_price,
					'quantity'		=> $quantity,
					'options'		=> $options_array,
					);

		$Cart->setData($data);
		$Cart->save();

		redirect('cart');

	}

	public function update()
	{

		$Cart = new objCart();
		$Cart->update();

		redirect('cart');
	}

	public function xupdate()
	{

		$Cart = new objCart();
		$Cart->setData($this->cart->contents());
		$Cart->update();

		redirect('cart');
	}

	



	

	
}

