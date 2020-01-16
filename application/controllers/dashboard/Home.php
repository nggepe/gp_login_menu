<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_auth {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{

		$data['modul'] = $this->get_data();	
		$data['style'] = array('primary', 'secondary', 'danger', 'warning', 'info', 'success', 'light');
		$this->load->view('dashboard/home', $data);
	}

	public function get_data()
	{
		$this->db->from("modul");
		return $this->db->get()->result();
	}

	
}
