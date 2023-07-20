<?php

	class mol_product extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

	    public function getProduct($arr)
	    {
	    	if(isset($arr['product_id']) && trim($arr['product_id'] != '')){
	    		$this->db->where('product.product_id', $arr['product_id']);
	    	}
	    	if(isset($arr['user_id']) && trim($arr['user_id'] != '')){
	    		$this->db->where('product.user_id', $arr['user_id']);
	    	}
	    	$this->db->select('product_id, product_company_id, product_name, product_type, status_product.status_name, product_gen, product_exp, product_price, user_id');
	    	$this->db->join('status_product', 'status_product.status_id = product.status_id');
	    	$this->db->from('product');
	    	$this->db->order_by("product_name", "asc");
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

	    public function insertProduct($data = array())
	    {
	    	$this->db->insert('product', $data);
	    }

	    public function updateProduct($data = array(), $id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('product_company_id', $id);
	    	}
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	$this->db->update('product', $data);
	    }

	    public function deleteProduct($data = array(), $id){
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('product_company_id', $id);
	    	}
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	$this->db->where('status_id', '1');
	    	$this->db->delete('product');
	    }
	    public function checkProduct($id, $company_id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('product_company_id', $id);
	    	}
	    	if(isset($company_id) && trim($company_id != '')){
	    		$this->db->where('user_id', $company_id);
	    	}
	    	$this->db->select('product_company_id, user_id');
	    	$this->db->from('product');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			if($rows > 0){
				for ($i=0; $i < $rows; $i++) { 
					$data[$i] = $query->row_array($i);
				}
			}else{
				$data = null;
			}
			return $data;
	    }

	    public function countProduct($arr)
	    {
	    	if(isset($arr['user_id']) && trim($arr['user_id'] != '')){
	    		$this->db->where('user_id', $arr['user_id']);
	    	}
	    	if(isset($arr['product_id']) && trim($arr['product_id'] != '')){
	    		$this->db->where('product_id', $arr['product_id']);
	    	}
	    	$this->db->select('product_id, product_company_id, product_name, product_type, product.status_id, status_product.status_name,
	    	product_gen, product_exp, product_price, user_id');
	    	$this->db->join('status_product', 'status_product.status_id = product.status_id');
	    	$this->db->from('product');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			if($rows > 0){
				for ($i=0; $i < $rows; $i++) { 
					$data[$i] = $query->row_array($i);
				}
			}else{
				$data = null;
			}
			return $data;
	    }

	    public function searchProduct($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('product.product_name', $id['search']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('product.user_id', $id['user_id']);
	    	}
	    	$this->db->select('product_id, product_company_id, product_name, product_type, status_product.status_name, product_gen, product_exp, product_price, user_id');
	    	$this->db->join('status_product', 'status_product.status_id = product.status_id');
	    	$this->db->from('product');
	    	$this->db->order_by("product_name", "asc");
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