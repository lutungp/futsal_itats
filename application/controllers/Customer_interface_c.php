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
                    'buildings'   => $this->select_config_array('buildings', $where_building_and_branch_id)->row(),
                    'building_id' => $building,
                    'branch_id'   => $branch,
                    'action'      => "Customer_interface_c/save_booking"
                  );

      $this->load->view('customer_interface/popmodal_booking', $data);
  }

  function get_time()
  {
    $building   = $this->input->post('building_id');
    $branch     = $this->input->post('branch_id');
    $i_tangggal = $this->input->post('i_tangggal');
    $i_tangggal_   = date("Y-m-d", strtotime($i_tangggal));

    $where_building_and_branch_id = array(
        'building_booking_building' => $building,
        'building_booking_branch'   => $branch,
        'building_booking_date_for' => $i_tangggal_
      );

    $where_branch_id = array('branch_id' => $branch );

    $q_booking = $this->Global_m->select_config_array('building_booking', $where_building_and_branch_id);
    $r_branch  = $this->Global_m->select_config_array('branches', $where_branch_id)->row();

    foreach ($q_booking->result() as $r_booking) {
      $data['booking'][] = array(
                                  'building_booking_time_1' => $r_booking->building_booking_time_1,
                                  'building_booking_time_2' => $r_booking->building_booking_time_2
                                );

    }

    $data['open_time'] = array(
      'branch_hour_1' => date("H:m", $r_branch->branch_hour_1),
      'branch_hour_2' => date("H:m", $r_branch->branch_hour_2),
      'strbranch_hour_1'  => $r_branch->branch_hour_1,
      'strbranch_hour_2'  => $r_branch->branch_hour_2,
    );



    echo json_encode($data);
  }

  function save_booking()
  {

    $i_building   = $this->input->post('i_building');
    $i_branch     = $this->input->post('i_branch');

    $i_name       = $this->input->post('i_name');
    $i_nik        = $this->input->post('i_nik');
    $i_alamat     = $this->input->post('i_alamat');
    $i_phone      = $this->input->post('i_phone');
    $i_email      = $this->input->post('i_email');

    $i_tangggal   = $this->input->post('i_tangggal');
    $i_tangggal_   = date("Y-m-d", strtotime($i_tangggal));

    $i_jam_1      = $this->input->post('i_jam_1');
    $i_jam_2      = $this->input->post('i_jam_2');

    $data_customer = array(
                            'customer_name'     => $i_name,
                            'customer_nik'      => $i_nik,
                            'customer_address'  => $i_alamat,
                            'customer_phone'    => $i_phone,
                            'customer_email'    => $i_email,
                            'customer_status'   => 1
                          );

    $customer_id = $this->Global_m->create_config('customers', $data_customer);

    $data_booking = array(
                  'building_booking_building'     => $i_building,
                  'building_booking_branch'       => $i_branch,
                  'building_booking_customer'     => $customer_id,
                  'building_booking_user'         => '',
                  'building_booking_date'         => date("Y-m-d"),
                  'building_booking_date_for'     => $i_tangggal_,
                  'building_booking_time_1'       => $i_jam_1,
                  'building_booking_time_2'       => $i_jam_2,
                  'building_booking_status'       => 1,
                  'building_booking_status_desc'  => 'Belum Ada Konfirmasi'
                );

    // $this->create_config('building_booking', $data_booking);


    if ($this->create_config('building_booking', $data_booking))
    {
        $data['status'] = '204';
    } else {
        $this->send_email();
        $data['status'] = '200';
        $data['customer'] = $customer_id;
    }

    echo json_encode($data);

  }

  function send_email()
  {

    $this->load->library('email');

    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'lntngp19@gmail.co',
        'smtp_pass' => 'permanaday19',
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );
    $this->email->initialize($config);
    $this->email->to('resi.raes@gmail.com');
    $this->email->from('lntngp19@gmail.co', 'lntngp19@gmail.co');
    $this->email->subject('JUDUL EMAIL (Teks)');
    $this->email->message('Isi email ditulis disini');
    $this->email->send();
  }
}
