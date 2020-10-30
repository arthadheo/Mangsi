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

	public function checkUser($data = array()){ 

		$this->tableName = 'pelanggan'; 
 
        $this->db->select('id_pelanggan'); 
        $this->db->from($this->tableName); 
         
        $con = array( 
            'oauth_provider' => $data['oauth_provider'], 
            'oauth_uid' => $data['oauth_uid'] 
        ); 
        $this->db->where($con); 
        $query = $this->db->get(); 
         
        $check = $query->num_rows(); 
        if($check > 0){ 
            // Get prev user data 
            $result = $query->row_array(); 
             
            // Update user data 
            //$data['modified'] = date("Y-m-d H:i:s"); 
            $update = $this->db->update($this->tableName, $data, array('id_pelanggan' => $result['id_pelanggan'])); 
             
            // Get user ID 
            $userID = $result['id_pelanggan']; 
        }else{ 
            // Insert user data 
            //$data['created'] = date("Y-m-d H:i:s"); 
            //$data['modified'] = date("Y-m-d H:i:s"); 
            $insert = $this->db->insert($this->tableName, $data); 
             
            // Get user ID 
            $userID = $this->db->insert_id(); 
        } 
         
        // Return user ID 
        return $userID?$userID:false; 
    } 

}

}

//end of file