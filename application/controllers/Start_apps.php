<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start_apps extends User_auth {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{

		$this->load->view('admin_design/header');
	}

	public function get_data()
	{
		$this->db->from("modul");
		return $this->db->get()->result();
	}

	
}
