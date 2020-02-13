<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_privilege extends User_auth {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setting/M_user_privilege','privilege');
	}


	public function index()
	{
		$this->load->view('setting/user_privilege');
	}

	public function access_control()
	{
		$data = $this->input->post();
		$this->privilege->access_control($data);
		echo json_encode("success");
	}

	public function show_privilege()
	{
		$this->privilege->show_privilege($this->input->post('user_privilege'));
	}


}