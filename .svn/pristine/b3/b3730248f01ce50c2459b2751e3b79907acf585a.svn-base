<?php

	class mol_profile extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

	    public function getProfile($data)
	    {
	    	if(isset($data['profile_id']) && trim($data['profile_id'] != '')){
	    		$this->db->where('profile_id', $data['profile_id']);
	    	}
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	$this->db->select('profile_id, profile_before_name, profile_fname, profile_lname, profile_address, profile_postcost, profile_man_tax, profile_branch, profile_iden,
	    		profile_iden_money, profile_money_id, profile_money_date, profile_condition_id, user_id');
	    	$this->db->from('profile');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			if($rows > 0){
				for($i=0; $i < $rows; $i++){
					$data[$i] = $query->row_array($i);
				}
			}else{
				$data = null;
			}
			return $data;
	    }

	    public function insertProfile($data)
	    {
	    	$this->db->insert('profile', $data);
	    }

	    public function updateProfile($data)
	    {
	    	if(isset($data['profile_id']) && trim($data['profile_id'] != '')){
	    		$this->db->where('profile_id', $data['profile_id']);
	    	}
	    	$this->db->update('profile', $data);
	    }
	}
?>