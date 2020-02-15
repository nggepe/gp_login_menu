<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct(){
		parent::__construct();
	}



	public function search()
	{
		$loginsession = $this->session->userdata('loginsession');
		$this->db->select("
			IF(ugp.id_menu IS NULL, modul.url, menu.url) as url,
			IF(modul.url IS NULL, CONCAT(modul.nama, ': ', menu.menu_nama), modul.nama) as nama,
			modul.icon as icon"
		);

		$this->db->from('user_group_privilege ugp');
		$this->db->join("modul", "modul.id = ugp.id_modul", "left");
		$this->db->join("menu", "modul.id = menu.id_modul", "left");
		$this->db->where("ugp.id_user_privilege", $loginsession['id_user_privilege']);
		$this->db->group_start();
		$this->db->like("modul.nama", $this->input->post('key'));
		$this->db->or_like("menu.menu_nama", $this->input->post('key'));
		$this->db->group_end();
		$this->db->group_by("menu.id");
		$this->db->order_by("nama");
		$this->db->limit(8);
		$data = $this->db->get()->result();
		
		die(json_encode($data));
	}

}