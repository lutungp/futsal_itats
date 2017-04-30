<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard1 extends My_controller {

		public function __construct()
		{
			parent::__construct();
			$this->is_logged_in();
		}

	public function index()
	{
			$this->load->view('template/head_admin_interface');
			$this->load->view('template/topbar');
			$this->sidebar();
			$this->load->view('dashboard1');;
			$this->load->view('template/js_admin_interface');
			$this->load->view('template/foot');
	}

	function popmodal_log_out()
	{

	}
}
