<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class M_authentication extends CI_Model {


	function authentication($username,$password) {

		$this->db->from('user');
		$this->db->where('password',md5($password));
		$this->db->where('username',$username);
		$table = $this->db->get()->row();

		if (empty($table)) {
			$data['status']=false;
			return $data;
		}
		else
		{
			$data['data']=$table;
			$data['access_control'] = $this->access_control($table->id_user_privilege);
			$data['status']=true;
			return $data;
		}

	}

	function access_control($id)
	{
		$this->db->select("ugp.id_modul, ugp.id_menu, IF(ugp.id_menu IS NULL, md.url, mn.url) as url");
		$this->db->from('user_group_privilege ugp');
		$this->db->join('modul md', 'md.id = ugp.id_modul', 'left');
		$this->db->join('menu mn', 'mn.id = ugp.id_menu', 'left');
		$this->db->where('id_user_privilege', $id);
		return $this->db->get()->result();

	}


}