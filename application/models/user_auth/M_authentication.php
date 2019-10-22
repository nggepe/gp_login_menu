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
			$data['status']=true;
			return $data;
		}

	}


}