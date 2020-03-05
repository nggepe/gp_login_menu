<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_auth {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->load->library('user_agent');

		if ($this->agent->is_browser())
		{
		        $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		        $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		        $agent = $this->agent->mobile();
		}
		else
		{
		        $agent = 'Unidentified User Agent';
		}

		$data['platform'] =  $this->agent->platform();
		$data['agent'] = $agent;
		$data['alamat_ip'] = $this->input->ip_address();
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
