<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class M_generator extends CI_Model {



	function table_checker($data)
	{
		$schemas = $this->load->database('db2', TRUE);

		$schemas->select();
		$schemas->from('TABLES');
		$schemas->where('TABLE_SCHEMA', $this->db->database);
		$schemas->where('TABLE_NAME', spaceToUnderscore($data['menu_name']));
		$result = $schemas->get()->row();
		if (!empty($result)) {
			echo json_encode("false");
		}
		else {
			echo json_encode("true");
		}
	}

	function create_menu($menu_name, $menu_code, $id_modul)
	{
		$data = array(
			'menu_nama' => $menu_name,
			'url' => "generated/".$menu_code,
			'id_modul' => $id_modul
		);
		$this->db->insert('menu', $data);

		$data['id_menu'] = $this->db->insert_id();

		return $data;
	}

	function save_access($data)
	{
		$loginsession = $this->session->userdata('loginsession');
		$toSave = array(
			'id_user_privilege' => $loginsession['id_user_privilege'],
			'id_menu' => $data['id_menu'],
			'id_modul' => $data['id_modul']
		);

		$this->db->insert('user_group_privilege', $toSave);
		$loginsession['access_control']['modul'][] = $data['id_modul'];
		$loginsession['access_control']['menu'][] = $data['id_menu'];
		$loginsession['access_control']['url'][] = $data['url'];
		$this->session->set_userdata('loginsession', $loginsession);
		echo json_encode($data);
	}


	function create_table($tablename, $data){
		$no_length_type = $this->no_length_type();
		$myQuery = "CREATE TABLE `".$tablename."` (\n";
		$primary_key = "";
		foreach ($data['colums_name'] as $key => $value) {
			$null = "";
			if ($data['isnull_'][$key]=="Y") {
				$null = "NULL";
			}
			else
			{
				$null = "NOT NULL";
			}

			$datatype = "";
			if ( in_array($data['datatype'][$key], $no_length_type)) {
				$datatype = $data['datatype'][$key];
			}
			else{
				$datatype = $data['datatype'][$key]."(".$data['length_set'][$key].")";
			}
			$default = "";

			if ($data['is_auto'][$key]=="Y") {
				$default = "AUTO_INCREMENT";
			}
			else{
				if ($data['isnull_'][$key]=="Y") {
					$default = "DEFAULT NULL";
				}
			}

			if ($data['isprimary'][$key]=="Y") {
				$primary_key.="PRIMARY KEY (`".$data['colums_name'][$key]."`),";
			}


			$myQuery .= " `".$value."` ".$datatype." ".$null." ".$default.", \n";
		}

		if ($primary_key!="") {
			$primary_key=rtrim($primary_key, ",");
			$myQuery .= $primary_key."\n";
		}
		$myQuery.=");";

		$this->db->query($myQuery);

	}

	function no_length_type()
	{
		$result = array(
			"FLOAT",
		    "DOUBLE",
		    "DECIMAL",

		    "TEXT",

		    "DATE",
		    "TIME",
		    "YEAR",
		    "DATETIME",
		    "TIMESTAMP",
		);
		return $result;
	}

}