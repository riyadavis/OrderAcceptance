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
            $getData = $this->db->query("select * from cart_table where customer_id = '$userid'")->result_array();
            return $getData;
        }
        else
        {
            return "invalid user";
        }
        
    }

    public function InsertOrder()
    {

        $items = json_decode($_POST['cartItems']);
        $deliveryBoyId = 1;
        $orderArray = array('time_stamp'=>Date('Y-m-d h:i:s'),
                        'customer_id'=>$this->session->userdata('userid'),
                        'getItems'=>json_encode($items),
                        'deliveryBoyId'=>$deliveryBoyId);
        $cartId = $this->input->post('cartId');
        $userid = $this->session->userdata('userid');
        // return $cartId;
        $orderId = $this->db->query("select * from customer_order where customer_id = '$userid'")->row();
        if($this->db->affected_rows()>0)
        {
            $this->db->trans_start();
            $this->db->where('customer_id',$userid);
                $this->db->update('customer_order',$orderArray);
            $this->db->trans_complete();
        }
        else
        {
            $this->db->trans_start();
                $this->db->insert('customer_order',$orderArray);
            // $orderId = $this->db->insert_id();
            $this->db->trans_complete();
        
        }
        
            // $setOrderId = array('order_id'=>$orderId);
            $this->db->trans_start();
                $this->db->where('id',$cartId);
                $this->db->set('items_added',"");
                    $this->db->update('cart_table');
            $this->db->trans_complete();
        return "order placed";
       
    }
}