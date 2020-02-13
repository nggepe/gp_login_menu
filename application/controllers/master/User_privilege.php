<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_privilege extends User_auth {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_user_privilege','user_privilege');
	}


	public function index()
	{
		$this->load->view('master/user_privilege');
	}

	public function ajaxTable()
	{
		$list = $this->user_privilege->tampil();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->nama;
			

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$key->id."'".')"><i class="fa fa-edit"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$key->id."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user_privilege->count_all(),
						"recordsFiltered" => $this->user_privilege->count_filtered(),
						"data" => $data,
						"query"=> $this->db->last_query()
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_save()
	{
		$this->user_privilege->save($this->input->post());
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->user_privilege->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->user_privilege->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$this->user_privilege->update($id, $this->input->post());
	}
}
