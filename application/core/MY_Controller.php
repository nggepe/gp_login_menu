<?php
class User_auth extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$loginsession = $this->session->userdata('loginsession');

		if (!$loginsession) 
		{
			redirect('user_auth/Login');
		}

	}


	
}
