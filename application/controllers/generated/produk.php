
<?php
// file ini dibuat di generator Gilang Pratama
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends User_auth {
	function __construct(){
        parent::__construct();
        $this->load->model('generated/M_produk','M_produk');
    }

    public function index()
    {
    	$this->load->view('generated/V_produk');
    }

    public function ajaxTable()
    {
    	$list = $this->M_produk->tampil();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = $no++;
			$row[] = $key->harga;
			$row[] = $key->nama;
			
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$key->id."'".')"><i class="fa fa-edit"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$key->id."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_produk->count_all(),
						"recordsFiltered" => $this->M_produk->count_filtered(),
						"data" => $data
				);
		
		echo json_encode($output);
    }

    public function ajax_save()
	{
		$this->M_produk->save($this->input->post());
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->M_produk->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->M_produk->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$this->M_produk->update($id, $this->input->post());
	}
}
