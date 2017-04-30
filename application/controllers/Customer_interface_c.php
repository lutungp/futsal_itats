<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_interface_c extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Customer_interface_m');
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->get_header_customer();
    $this->customer_interface();
    $this->get_footer_customer();
  }

  function customer_interface()
  {
    $where         = '';
    $data = array(
					'branches'		=> $this->select_config('branches',$where)
					// 'action'	=> "Customer_interface_c/buil",
				);

    $this->load->view('customer_interface/customer_interface_view', $data);
  }


  // data-json
  function get_lapangan()
  {
    $branch_id = $this->input->post('branch_id');
    $where_branch_id = "WHERE branch = '$branch_id'";
    $q_buildings = $this->Customer_interface_m->get_lapangan($branch_id);
    // <div class="status-lapangan">Available</div>
    foreach ($q_buildings->result() as $r_building)
    {
      $status_building = "<div class='status-lapangan no-available'>".$r_building->status_building_name."</div>";
      if ($r_building->status_building_id == 1) { $status_building = "<div class='status-lapangan available'>".$r_building->status_building_name."</div>"; }

      $data[] = array(
                                'building_id'     => $r_building->building_id,
                                'building_status' => $r_building->building_status,
                                'building_name'   => $r_building->building_name,
                                'building_img'    => $r_building->building_img,
                                'path'            =>  base_url().'assets/img/buildings/',
                                'status_building_name'  => $r_building->status_building_name,
                                'status_building_id'    => $r_building->status_building_id,
                                'status'          => $status_building,
                                'branch'          => $r_building->branch
                              );

    };
    echo json_encode($data);

  }

  function popmodal_booking($branch, $building)
  {
      $where_building_and_branch_id = array(
          'building_id' => $building,
          'branch' => $branch
     );

     $data = array(
                    'buildings' => $this->select_config_array('buildings', $where_building_and_branch_id)->row(),
                    'building_id' => $building,
                    'branch_id' => $branch
                  );

      $this->load->view('customer_interface/popmodal_booking', $data);
  }

  function get_time()
  {
    $building   = $this->input->post('building_id');
    $branch     = $this->input->post('branch_id');
    $i_tangggal = $this->input->post('i_tangggal');

    $where_building_and_branch_id = array(
        'building_booking_building' => $building,
        'building_booking_branch'   => $branch,
        'building_booking_date'     => $i_tangggal
      );

    $data['booking'] = $this->Global_m->select_config_array('building_booking', $where_building_and_branch_id)->row();
    echo json_encode($data);
  }

}
