<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_auth {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('dashboard/home');
	}

	public function search()
	{
		$this->db->select("IFNULL(modul.url, menu.url) as url, 
		IF(modul.url IS NULL, CONCAT(modul.nama,': ',menu.menu_nama), modul.nama) as nama, modul.icon as icon");
		$this->db->from("modul");
		$this->db->join("menu", "modul.id = menu.id_modul", "left");
		$this->db->order_by("nama");
		$this->db->or_like("modul.nama", $this->input->post('key'));
		$this->db->or_like("menu.menu_nama", $this->input->post('key'));
		$this->db->limit(8);
		$data = $this->db->get()->result();
		die(json_encode($data));
	}
}
