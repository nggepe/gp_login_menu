<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class M_user_privilege extends CI_Model {

	function access_control($data)
	{
		$this->db->where('id_user_privilege', $data['user_privilege']);
		$this->db->delete('user_group_privilege');

		foreach ($data['akses'] as $key => $value) {
			$a = explode("|", $value);

			$insert['id_modul'] = $a[0];
			$insert['id_menu'] = $a[1];
			if ($insert['id_menu']==" ") {
				unset($insert['id_menu']);
			}
			$insert['id_user_privilege'] = $data['user_privilege'];

			$this->db->insert('user_group_privilege', $insert);
		}

	}

	function show_privilege($id_user_privilege)
	{
		$this->db->where('id_user_privilege', $id_user_privilege);
		$data = $this->db->get('user_group_privilege')->result();
		echo json_encode($data);

	}

}