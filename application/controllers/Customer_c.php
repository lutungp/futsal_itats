<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_c extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('customer_m');
    $this->load_plugin_head[] = base_url()."assets/metronic_v4.5.6/theme/assets/global/plugins/datatables/datatables.min.css";
    $this->load_plugin_head[] = base_url()."assets/metronic_v4.5.6/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css";
  }

  function index()
  {
    $this->get_header();
    $this->customer_list();
    $this->get_footer();
  }

  function customer_list()
  {
    $data = array('customers'   => $this->select_config('customers', ''),
                  'action'      => "customer_c/customer_form",
                );
    $this->load->view('master/customer_master/customer_list_v', $data);
  }

  function customer_form()
  {
    $where = '';
    $where_user_id = '';
    $url   = "master/customer_master/customer_form";
    $data  = array('action_add'   => "customer_c/add_customer",
                   'action_close' => "customer_c",
                   'customer_details' => false,
                   'customer'    => $this->select_config('customers', $where)
                    );
    $this->get_page($data,$url);
  }

  function add_customer()
  {
    $i_id = $this->input->post('i_id');
    $i_name = $this->input->post('i_name');
    $i_address = $this->input->post('i_address');
    $i_phone = $this->input->post('i_phone');
    $i_email = $this->input->post('i_email');

    $data = array(
                  'customer_id'         => '',
                  'customer_name'       => $i_name,
                  'customer_address'    => $i_address,
                  'customer_phone'      => $i_phone,
                  'customer_email'      => $i_email
                  );

    $this->create_config('customers', $data);

    redirect('customer_c');
  }

  function edit_customer($id)
  {
    $where = '';
    $where_customer_id  = "WHERE customer_id = '$id'";

    $action         = "master/customer_master/customer_form";
    $data  = array('action_add'     => "customer_c/update_customer",
                   'action_close'   => "customer_c",
                   'customer_details'   => $this->select_config('customers', $where_customer_id)->row()
                    );

    $this->get_page($data, $action);

  }

  function update_customer()
  {
    $i_id = $this->input->post('i_id');
    $i_name = $this->input->post('i_name');
    $i_address = $this->input->post('i_address');
    $i_phone = $this->input->post('i_phone');
    $i_email = $this->input->post('i_email');

    $data = array(
                  'customer_name'       => $i_name,
                  'customer_address'    => $i_address,
                  'customer_phone'      => $i_phone,
                  'customer_email'      => $i_email
                  );

    $where = array(
      'customer_id' => $i_id
    );

   $this->update_config('customers', $data, $where);

   redirect('customer_c');

  }

  function delete_customer($id)
  {
    $where = array(
      'customer_id' => $id
    );

    $this->delete_config('customers',$where);
    redirect('customer_c');

  }

}
