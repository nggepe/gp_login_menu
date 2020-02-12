<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_password extends User_auth {

	public function index()
	{
		$this->load->view('setting/ubah_password');
	}

	public function submit()
	{
		$loginsession = $this->session->userdata('loginsession');
		$validation = $this->form_validation($this->input->post());
		if ($validation['status']=="true") {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password_baru'))
			);
			$this->db->where('id', $loginsession['id']);
			$this->db->update('user', $data);
			// $this->session->sess_destroy();
		}
		echo json_encode($validation);
	}

	private function form_validation($param)
	{
		$loginsession = $this->session->userdata('loginsession');
		$status = "true";
		$validate = array();
		$result = array();
		$i = -1;

		$data = $this->db->get_where('user', array('username' => $param['username']))->row();
		if (!empty($data)) {
			if ($data->id != $loginsession['id']) {
				$status = "false";
				$i += 1;
				$validate[$i]['element'] = '#username';
				$validate[$i]['validate'] = 'Username sudah digunakan';
			}
		}

		$data = $this->db->get_where('user', array('password' => md5($param['password_lama'])))->row();
		if (!empty($data)) {
			if ($data->id != $loginsession['id']) {
				$status = "false";
				$i += 1;
				$validate[$i]['element'] = '#password_lama';
				$validate[$i]['validate'] = 'Password salah!';
			}
		}
		else
		{
			$status = "false";
			$i += 1;
			$validate[$i]['element'] = '#password_lama';
			$validate[$i]['validate'] = 'Password salah!';
		}

		$result['status'] = $status;
		$result['data'] = $validate;
		return $result;
	}

}