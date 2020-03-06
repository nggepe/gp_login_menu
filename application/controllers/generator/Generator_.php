<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generator_ extends User_auth {
	function __construct(){
        parent::__construct();
        $this->load->helper('slug');
        $this->load->helper('generator');
        $this->load->model('generator/M_generator', 'M_generator');
    }

	public function index()
	{
		$this->load->view('generator/generator');
	}

	public function build()
	{

		$menu_name = $this->input->post("menu_name");
		$menu_code = strtolower(spaceToUnderscore($menu_name, $this->input->post('menu_name')));
		$model_name = "M_".$menu_code;

		$create_table = $this->M_generator->create_table($menu_code,$this->input->post());
		$create_menu = $this->M_generator->create_menu($menu_name, $menu_code, $this->input->post('modul_id'));

		controler_builder($menu_code, $this->input->post('colums_name'), $model_name);
		model_builder($menu_code, $this->input->post('colums_name'), $model_name);
		view_builder($menu_code, $this->input->post('colums_name'), $menu_name);
		echo json_encode($create_menu);
	}


	public function table_checker()
	{
		$this->M_generator->table_checker($this->input->post());
	}

    public function access_control_builder()
    {
        $this->M_generator->save_access($this->input->post());
    }

	public function select2_modul()
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
            $where .= "AND (id like '%{$term}%' OR nama like '%{$term}%') ";
        } else if( $id ) {
            $where .= "AND id = '$id'";
        }

        $SQL = "
            SELECT count(*) as total
            FROM modul
            where tipe='dropdown'
            ".$where."
        ";

        $query = $this->db->query( $SQL );
        $return['total'] = $query->row()->total;

        if( $return['total'] > 0 ) {

            $sql = "SELECT
                *
            FROM modul
            where tipe='dropdown'
            ".$where."
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