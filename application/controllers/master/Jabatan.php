<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends User_auth {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_jabatan','jabatan');
	}


	public function index()
	{
		$this->load->view('master/jabatan');
	}

	public function ajaxTable()
	{
		$list = $this->jabatan->tampil();
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
						"recordsTotal" => $this->jabatan->count_all(),
						"recordsFiltered" => $this->jabatan->count_filtered(),
						"data" => $data,
						"query"=> $this->db->last_query()
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_save()
	{
		$this->jabatan->save($this->input->post());
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->jabatan->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->jabatan->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$this->jabatan->update($id, $this->input->post());
	}
}
