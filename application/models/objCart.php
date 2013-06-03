<?php
// models/objCart.php

class objCart extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();



	}

	

	public function setId($product_id) {

		$this->product_id = $product_id;

	}

	public function setQty($quantity) {

		$this->quantity = $quantity;

	}

	public function setOptions($data) {

	
		$this->options = $data;

	}

	public function getCartLines()
	{

		$cart = $this->session->userdata('cart');



		return $cart;

	}

	public function setCartLines()
	{

		//var_dump($this->cart_lines);exit();

		$this->session->set_userdata('cart', $this->cart_lines);

	}

	

	public function save()
	{
//$this->session->sess_destroy();exit();
		echo "<BR>updateCart()";

		// cart structure : array of lines : each line is also an array
		//var_dump($this->data);

		$cart_lines = $this->getCartLines();

		var_dump($cart_lines);

		$line_count = count($cart_lines);
		//echo "<BR>line_count:".$line_count;

		$cart_array = array();

		$cnt = 0;
		if($cart_lines) {
			foreach($cart_lines as $line) {

				$cnt ++;

				$cart_array[$cnt]['product_id'] 	= $line['product_id'];
				$cart_array[$cnt]['quantity'] 		= $line['quantity'];
				$cart_array[$cnt]['name'] 			= $line['name'];
				$cart_array[$cnt]['price'] 			= $line['price'];
				$cart_array[$cnt]['options'] 		= $line['options'];

			}
		}

		// does this product already exist in the cart?
		$cnt = 0;
		$line_exists = false;
		if($cart_lines) {
			

			foreach($cart_lines as $line) {

				$cnt ++;

				if($this->data['product_id'] == $line['product_id']) {
					echo "<BR>already exists...";

					$line_exists = true;

					// are the options the same?
					$existing_id	= $line['options'][1]['id'];
					$existing_value	= $line['options'][1]['value'];

					$new_id			= $this->data['options'][1]['id'];
					$new_value		= $this->data['options'][1]['value'];

					if($existing_id == $new_id && $existing_value == $new_value) {
				
					  	// The arrays are the same
						$line_exists = true;
		
					} else {

						$line_exists = false;

					}

				}

			}
		}

		if($line_exists) {

			// update line quantity
			$quantity = $line['quantity'] + $this->data['quantity'];

			$cart_array[$cnt]['quantity'] 		= $quantity;

			
		} else {

			// add line

			$cart_array[$line_count+1]['product_id'] 	= $this->data['product_id'];
			$cart_array[$line_count+1]['quantity'] 		= $this->data['quantity'];
			$cart_array[$line_count+1]['name'] 			= $this->data['name'];
			$cart_array[$line_count+1]['price'] 		= $this->data['price'];
			$cart_array[$line_count+1]['options'] 		= $this->data['options'];

		}


		$this->session->set_userdata('cart', $cart_array);

		//exit();
	}

	public function add()
	{

		$ProductDetail = new ProductDetail();
		$ProductDetail->setId($this->product_id);
		$product_details = $ProductDetail->getData();

		$data = array(
					'product_id'	=> $product_details[0]->product_id,
					'quantity'		=> $this->quantity,
					'name'    		=> $product_details[0]->product_title,
	           		'options'		=> $this->options,
					);
		$this->setData($data);
		$this->updateCart();

		exit();

		// does this product already exist in the cart (with the same options!)
		$item_exists = false;
		foreach ($this->cart->contents() as $items) {

			//echo "<BR>id:".$items['id'];

			if($items['id'] == $this->product_id) {
				//echo "<BR>item located in cart";
				$item_exists = true;
				$this->quantity = $this->quantity + $items['qty'];
				$rowid 		= $items['rowid'];
				$options 	= $items['options'];

				var_dump($options);

				$existing_id	= $options[1]['id'];
				$existing_value	= $options[1]['value'];

				$new_id			= $this->options[1]['id'];
				$new_value		= $this->options[1]['value'];

				if($existing_id == $new_id && $existing_value == $new_value) {
			
				  // The arrays are the same
					echo "<BR>same options";
					$item_exists = true;
				} else {
					echo "<BR>different options";
					$item_exists = false;

				}
			}
		}

		#echo "<BR>item_exists:".$item_exists;
		#exit();

		if($item_exists) {
			//echo "<BR>item located in cart";
			// update the quantity
			$data = array(
						'rowid'	=> $rowid,
						'qty'	=> $this->quantity,
						);
			//var_dump($data);exit();
			$this->cart->update($data); 
			
		} else {
			// insert

			$data = array(
	               'id'      	=> $this->product_id,
	               'qty'     	=> $this->quantity,
	               'price'   	=> $product_details[0]->product_price,
	               'name'    	=> $product_details[0]->product_title,
	               'options'	=> $this->options,
	               //'options' => array('Size' => 'L', 'Color' => 'Red')
	            );
			$this->cart->insert($data);

		}

	}

	public function OLD_add() {

		$ProductDetail = new ProductDetail();
		$ProductDetail->setId($this->product_id);
		$product_details = $ProductDetail->getData();

		var_dump($this->options);
		#exit();



		// does this product already exist in the cart (with the same options!)
		$item_exists = false;
		foreach ($this->cart->contents() as $items) {

			//echo "<BR>id:".$items['id'];

			if($items['id'] == $this->product_id) {
				//echo "<BR>item located in cart";
				$item_exists = true;
				$this->quantity = $this->quantity + $items['qty'];
				$rowid 		= $items['rowid'];
				$options 	= $items['options'];

				var_dump($options);

				$existing_id	= $options[1]['id'];
				$existing_value	= $options[1]['value'];

				$new_id			= $this->options[1]['id'];
				$new_value		= $this->options[1]['value'];

				if($existing_id == $new_id && $existing_value == $new_value) {
			
				  // The arrays are the same
					echo "<BR>same options";
					$item_exists = true;
				} else {
					echo "<BR>different options";
					$item_exists = false;

				}
			}
		}

		#echo "<BR>item_exists:".$item_exists;
		#exit();

		if($item_exists) {
			//echo "<BR>item located in cart";
			// update the quantity
			$data = array(
						'rowid'	=> $rowid,
						'qty'	=> $this->quantity,
						);
			//var_dump($data);exit();
			$this->cart->update($data); 
			
		} else {
			// insert

			$data = array(
	               'id'      	=> $this->product_id,
	               'qty'     	=> $this->quantity,
	               'price'   	=> $product_details[0]->product_price,
	               'name'    	=> $product_details[0]->product_title,
	               'options'	=> $this->options,
	               //'options' => array('Size' => 'L', 'Color' => 'Red')
	            );
			$this->cart->insert($data);

		}

		


		

	}

	public function setData($data)
	{

		$this->data = $data;
	}

	public function update()
	{

		$cart_lines = $this->getCartLines();

		//var_dump($cart_lines);
		$cnt = 0;
		foreach($cart_lines as $line) {
			
			$cnt ++;

			var_dump($line);

			$existing_quantity = $line['quantity'];
			echo "<BR>--->".$existing_quantity;

			//$qty 	= $this->input->post($cnt)['qty'];
			$qty 	= $this->input->post($cnt.'_qty');

			echo "<BR>:::".$qty;

			// update the quantity
			$cart_lines[$cnt]['quantity'] 		= $qty;

		}

	

		$this->session->set_userdata('cart', $cart_lines);
		//exit();

	}

	public function xupdate()
	{

		$cnt = 1;

		foreach($this->data as $line) {

			$qty 	= $this->input->post($cnt)['qty'];
			$rowid 	= $this->input->post($cnt)['rowid'];

			//echo "<BR>tmp_qty:".$tmp_qty['qty'];

			// update
			$data = array(
               'rowid' => $rowid,
               'qty'   => $qty,
            );

			$this->cart->update($data); 

			$cnt ++;

		}
		//exit();
	}

	public function getNonRelated()
	{

		$sqltext = "SELECT * FROM products 
						WHERE 
						product_id NOT IN (SELECT related_product_id FROM product_related WHERE product_id = '".$this->product_id."') 
						ORDER BY product_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;
		
	}

}
?>