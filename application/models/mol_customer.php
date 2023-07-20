<?php

	class mol_customer extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

	    public function getRecord_all($quotation) {
	    	if(isset($quotation['user_id']) && trim($quotation['user_id'] != '')){
	    		$this->db->where('user_id', $quotation['user_id']);
	    	}
	        $this->db->select('customer_id');
	    	$this->db->from('customer');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			return $rows;
	    }

	    public function getCustomer($id = array()){
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['customer_id']) && trim($id['customer_id'] != '')){
	    		$this->db->where('customer_id', $id['customer_id']);
	    	}
	    	if(isset($id['per_page']) && trim($id['per_page'] != '')){
	    		$this->db->limit($id['per_page'], $id['page']);
	    	}
	    	$this->db->select('customer_id, customer_name, customer_address, customer_district, customer_county,  customer_road, customer_building, customer_floor, customer_email,
	    		customer_province, customer_zip, customer_tel, customer_fax, customer_tax_code, user_id');
	    	$this->db->from('customer');
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
	    
	    public function insertCustomer($data){
	    	$this->db->insert('customer', $data);
	    }

	    public function updateCustomer($data){
	    	if(isset($data['customer_id']) && trim($data['customer_id'] != '')){
	    		$this->db->where('customer_id', $data['customer_id']);
	    	}
	    	$query = $this->db->update('customer', $data);
	    }

	    public function searchCustomer($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('customer_name', $id['search']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	$this->db->select('customer_id, customer_name, customer_address, customer_district, customer_county,  customer_road, customer_building, customer_floor, customer_email,
	    		customer_province, customer_zip, customer_tel, customer_fax, customer_tax_code, user_id');
	    	$this->db->from('customer');
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