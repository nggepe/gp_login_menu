<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends User_auth {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/M_user','user');
	}


	public function index()
	{
		$this->load->view('master/user');
	}

	public function ajaxTable()
	{
		$list = $this->user->tampil();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->nama;
			$row[] = $key->alamat;
			$row[] = $key->no_telpon;
			$row[] = $key->username;
			

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$key->id."'".')"><i class="fa fa-edit"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$key->id."'".')"><i class="fa fa-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
						"query"=> $this->db->last_query()
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_save()
	{
		$data = $this->input->post();
		unset($data['password2']);
		$data['password'] = md5($data['password']);
		$this->user->save($data);
		
		echo json_encode("success");
	}

	public function ajax_edit($id)
	{
		$this->user->edit($id);
	}

	public function ajax_delete($id)
	{
		$this->user->ajax_delete($id);
	}

	public function ajax_update($id)
	{
		$data = $this->input->post();
		unset($data['password2']);
		$data['password'] = md5($data['password']);
		$this->user->update($id, $data);
	}

	public function select2_user_privilege()
    {
        $return = array( 'total' => 0, 'rows' => array() );

        $term = $this->input->get_post('query');
        $page = $this->input->get_post('page');
        $id = $this->input->get_post('id');
        $limit = $this->input->get_post('limit');

        $where = "";
        if( !$page ) $page = 1;
        if( !$limit ) $limit = 10;
        $start = ($page - 1) * $limit;

        if( $term ) {
            // $term = mysqli_real_escape_string( $this->link, $term );
            $where .= "where id like '%{$term}%' OR nama like '%{$term}%'";
        } else if( $id ) {
            $where .= "where id = '$id'";
        }

        $SQL = "
            SELECT count(*) as total
            FROM user_privilege
            {$where}
        ";

        $query = $this->db->query( $SQL );
        $return['total'] = $query->row()->total;

        if( $return['total'] > 0 ) {

            $sql = "SELECT
                *
            FROM user_privilege
            {$where}
            ORDER BY nama ASC
            LIMIT $start, $limit";
            $query = $this->db->query( $sql );
            if( $query->num_rows() ) {
                $return['rows'] = $query->result_array();
            }

        }

        header('Content-type:application/json');
        echo json_encode($return);
        exit;
    }

	
}
