<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderAcceptanceDatabase extends CI_Model {

    public function ViewCart()
    {
        //user_id session variable
        $this->session->set_userdata('userid',1);
        if($this->session->has_userdata('userid'))
        {
            $userid = $this->session->userdata('userid');
            $getData = $this->db->query("select * from cart where user_id = '$userid'AND order_id = 0")->result_array();
            return $getData;
        }
        else
        {
            return "invalid user";
        }
        
    }

    public function InsertOrder()
    {

        $arr = json_decode($_POST['arr']);
        $orderTime = array('time_stamp'=>Date('Y-m-d h:i:s'),
                        'customer_id'=>$this->session->userdata('userid'));
        $this->db->trans_start();
            $this->db->insert('customer_order',$orderTime);
            $orderId = $this->db->insert_id();
        $this->db->trans_complete();
        
            $setOrderId = array('order_id'=>$orderId);
            $this->db->trans_start();
                $this->db->where_in('id',$arr);
                    $this->db->update('cart',$setOrderId);
            $this->db->trans_complete();
        return $setOrderId;
       
    }
}