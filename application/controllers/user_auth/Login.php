<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('user_auth/M_authentication', 'M_authentication');
    }


	public function index()
	{
		$this->load->view('user_auth/login_view');
	}

	function submit() {

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->M_authentication->authentication($username,$password);

		if ($data['status']==false) {
			 $this->session->set_flashdata('flash_msg', '<div style="margin: 15px 15px 10px; border: 1px solid red; padding: 10px;"><b>Error, </b>silahkan masukkan username dan password<br>dengan benar</div>');
            	redirect('user_auth/Login');
		}
		else
		{
			if (count($data['access_control'])<1) {
				redirect(base_url());
			}
			else
			{
				$access_control = array();
				foreach ($data['access_control'] as $key => $value) {
					$access_control['modul'][] = $value->id_modul;
					$access_control['menu'][] = $value->id_menu;
					$access_control['url'][] = strtolower($value->url);
				}
				$loginsession = array(
					'id' => $data['data']->id,
		            'nama' => $data['data']->nama,
		            'username'=> $data['data']->username,
		            'alamat'=> $data['data']->alamat,
		            'no_telp'=> $data['data']->no_telp,
		            'id_user_privilege' => $data['data']->id_user_privilege,
		            'access_control' => $access_control,
				);
				$this->session->set_userdata('loginsession',$loginsession);

				redirect(base_url()."#".$access_control['url'][0]);
			}

			
		}

	}
	public function logout(){
        $this->session->unset_userdata('loginsession');
        $this->session->sess_destroy();
        redirect('user_auth/Login');
    }

    public function no_access()
    {
    	$this->load->view('errors/no_access_control');
    }
}
