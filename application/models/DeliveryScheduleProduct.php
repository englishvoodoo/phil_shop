<?php
// models/DeliverySchedule.php



class DeliveryScheduleProduct extends CI_Model
{
	
	public function __construct()
	{

		$this->load->database();

	}

	public function setId($schedule_id) {

		$this->schedule_id = $schedule_id;

	}

	public function setProductId($product_id) {

		$this->product_id = $product_id;

	}

	public function getDetails() {

		$sqltext = "SELECT * FROM delivery_schedule WHERE schedule_id = '".$this->schedule_id."'";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getList()
	{

		$sqltext = "SELECT * FROM delivery_schedule 
						WHERE delivery_schedule.schedule_id NOT IN (
							SELECT schedule_id FROM product_delivery WHERE product_id = '".$this->product_id."') 
						ORDER BY schedule_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function getListProduct()
	{

		$sqltext = "SELECT * FROM product_delivery 
						INNER JOIN delivery_schedule ON delivery_schedule.schedule_id = product_delivery.schedule_id 
						ORDER BY schedule_title ASC";
		$query = $this->db->query($sqltext);
		$result = $query->result();

		return $result;

	}

	public function setData($data) {

		$this->schedule_id 		= $data['schedule_id'];
		$this->product_id	 	= $data['product_id'];

	}

	public function save() {

		$sqltext = "INSERT INTO product_delivery (
							schedule_id,
							product_id
						) VALUES (
							'".$this->schedule_id."',
							'".$this->product_id."'
						)";
		$query = $this->db->query($sqltext);
		

		return TRUE;

	}

	

}
?>