<?php

	class mol_company extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

	    public function getCompany($data)
	    {
	    	if(isset($data['company_id']) && trim($data['company_id'] != '')){
	    		$this->db->where('company.company_id', $data['company_id']);
	    	}
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('company.user_id', $data['user_id']);
	    	}
	    	$this->db->select('company_id, company_name, company_address, company_district, company_county,  company_road, company_building, company_floor, company_province, 
	    		company_zip, company_tel, company_fax, company_tax_code, company_logo, company.user_id, user.company_email');
	    	$this->db->join('user', 'user.user_id = company.user_id');
	    	$this->db->from('company');
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

	    public function getProvince()
	    {
	    	$this->db->select('province_name');
	    	$this->db->from('province');
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
	    public function insertCompany($data = array())
	    {
	    	$query = $this->db->insert('company', $data);
	    	if($query) {
	            $insert_id = $this->db->insert_id();
	            return $insert_id;
	        }
	    }

	    public function updateCompany($data = array())
	    {
	    	if(isset($data['company_id']) && trim($data['company_id'] != '')){
	    		$this->db->where('company_id', $data['company_id']);
	    	}
	    	$query = $this->db->update('company', $data);
	    }

	    public function checkCompany($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('company_id', $id);
	    	}
	    	$this->db->select('company_id');
	    	$this->db->from('company');
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
	}
?>