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
			$this->get_header();
			// $this->sidebar();
			$this->load->view('dashboard1');
			$this->get_footer($this->plugin_foot);
	}

	function popmodal_log_out()
	{

	}
}
