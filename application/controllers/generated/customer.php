
<?php
// file ini dibuat di generator Gilang Pratama
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends User_auth {
	function __construct(){
        parent::__construct();
        $this->load->model('generated/M_customer','M_customer');
    }

    public function index()
    {
    	$this->load->view('generated/V_customer');
    }

    public function ajaxTable()
    {
    	$list = $this->M_customer->tampil();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama;
			$row[] = $key->alamat;
			
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$key->id."'".')"><i class="fa fa-edit"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$key->id."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_customer->count_all(),
						"recordsFiltered" => $this->M_customer->count_filtered(),
						"data" => $data
				);
		
		echo json_encode($output);
    }

    public function ajax_save()
	{
		$this->M_customer->save($this->input->post());
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->M_customer->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->M_customer->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$this->M_customer->update($id, $this->input->post());
	}
}
