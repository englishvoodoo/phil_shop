<?php
// models/DeliverySchedule.php

abstract class AbTestAbstract {

	abstract public function input();

}

class PhilClass extends AbTestAbstract{

	public function test()
	{

		echo "<BR>AHA";
	}

	public function output() {
		echo "<BR>output()";
	}

	public function input() {
		echo "<BR>input()";
	}



}

class DeliverySchedule extends CI_Model
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


		$sqltext = "SELECT * FROM delivery_schedule ORDER BY schedule_title ASC";
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

		$this->schedule_id = $data['schedule_id'];
		$this->schedule_title = $data['schedule_title'];

	}

	public function save() {

		if($this->schedule_id) {
			$sqltext = "UPDATE delivery_schedule SET schedule_title = '".$this->schedule_title."' WHERE schedule_id = '".$this->schedule_id."'";
			$query = $this->db->query($sqltext);
		} else {
			$sqltext = "INSERT INTO delivery_schedule (schedule_title) VALUES ('".$this->schedule_title."')";
			$query = $this->db->query($sqltext);
		}

		return TRUE;

	}

	

}
?>