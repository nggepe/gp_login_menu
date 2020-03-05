
<?php
// file ini dibuat di generator Gilang Pratama
defined('BASEPATH') OR exit('No direct script access allowed');

class supplier extends User_auth {
	function __construct(){
        parent::__construct();
        $this->load->model('generated/M_supplier','M_supplier');
    }

    public function index()
    {
    	$this->load->view('generated/V_supplier');
    }

    public function ajaxTable()
    {
    	$list = $this->M_supplier->tampil();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = $no++;
			$row[] = $key->nama;
			
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$key->id."'".')"><i class="fa fa-edit"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$key->id."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_supplier->count_all(),
						"recordsFiltered" => $this->M_supplier->count_filtered(),
						"data" => $data
				);
		
		echo json_encode($output);
    }

    public function ajax_save()
	{
		$this->M_supplier->save($this->input->post());
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->M_supplier->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->M_supplier->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$this->M_supplier->update($id, $this->input->post());
	}
}
