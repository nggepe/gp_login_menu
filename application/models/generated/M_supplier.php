<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class M_supplier extends CI_Model {
	var $table = 'supplier';
	var $column = array('id', 'nama', );
	var $order = array('id' => 'desc');


	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) // disini ngelooping kolom
		{
			if($_POST['search']['value']) // jika kolom search di datatable terisi
			{
				
				if($i===0) // looping awal digunakan untuk open bracket atau query '('
				{
					$this->db->group_start(); // open bracket
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) // looping terakhir untuk close bracket atau query ')'
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set variable kolom
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		
		return $this->db->count_all_results();
	}

	public function tampil()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function save($data)
	{
		$this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		echo json_encode($data);
	}

	function ajax_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
		echo json_encode("success!");
	}

	function edit($id)
	{
		$this->db->where('id', $id);
		echo json_encode($this->db->get($this->table)->row());
	}
}
	