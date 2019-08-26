<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderAcceptanceApi extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		$this->load->model('OrderAcceptanceDatabase');
	}

	public function index()
	{
		redirect('OrderAcceptanceApi/Order');
	}

	public function Order()
	{
		$this->load->view('Order');
	}

	public function ViewCart()
	{
		$data = $this->OrderAcceptanceDatabase->ViewCart();
		echo json_encode($data);
	}

	public function InsertOrder()
	{
		$returnData = $this->OrderAcceptanceDatabase->InsertOrder();
		echo json_encode($returnData);
	}
}
