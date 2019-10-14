<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderAcceptanceApi extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		$this->load->model('OrderAcceptanceDatabase');
		if($this->session->has_userdata('userauth') == FALSE)
        {
			$this->OrderAcceptanceDatabase->SaltData();
			if($this->session->has_userdata('userauth') == FALSE)
			{
				echo json_encode("error");
				die();
			}
		}
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

	public function confirmMessage()
	{
		$this->load->view('vendor/autoload.php');
		$options = array(
			'cluster' => 'ap2',
			'useTLS' => true
			);
			$pusher = new Pusher\Pusher(
			'e6256b34427ca9b29815',
			'e1a37e8c0910ae055d3b',
			'838370',
			$options
			);
	
			$data['message'] = 'Your Order is confirmed';
			$pusher->trigger('my-channel', 'my-event', $data);
	}
}
