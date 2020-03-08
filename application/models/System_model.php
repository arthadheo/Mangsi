<?php

class System_model extends CI_Model {

	function select_all($table)
	{	
		return $this->db->get($table)->result_array();
	}

	function get_by_atr($table, $where)
	{
		return $this->db->get_where($table,$where);
	}

	function get_sum($table, $atr)
	{
		$temp = $this->db->query("select sum($atr) as sum from $table");
		return $temp->result();
	}

	function get_sum_where($table, $atr, $where)
	{
		$temp = $this->db->query("select sum($atr) as sum where $where from $table");
		return $temp->result();
	}

	function get_count($table, $atr)
	{
		$temp = $this->db->query("SELECT COUNT($atr) AS $atr FROM $table");
		return $temp->result();
	}

	function get_count_where($table, $atr, $where)
	{
		$temp = $this->db->query("select count($atr) as $atr from $table where $where");
		return $temp->result();
	}

	function add($data, $table)
	{
		$this->db->insert($table, $data);	
	}

	function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function delete($table, $where)
	{
		//menghapus suatu baris dari suatu tabel
		$this->db->delete($table, $where);
	}

	function fetch_data()
	{
		$query = $this->db->get("pelanggan");
		return $query;
	}
}

//fk
//end of file