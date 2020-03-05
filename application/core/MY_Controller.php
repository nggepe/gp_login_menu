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
		
		else
		{
			
			$url = "";
			for ($i = 1; $i<=2; $i++){
				$url = $url."".$this->uri->segment($i)."/";
			}
			$url = strtolower(substr($url, 0,-1));
			if (!in_array($url, $loginsession['access_control']['url'])) {
				if ($this->uri->segment(1)!='') {
					redirect('Error404/error_401');
				}
			}
		}

	}


	
}
