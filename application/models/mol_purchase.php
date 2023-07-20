<?php

	class mol_purchase extends CI_Model
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
	        $this->db->select('purchase_id');
	    	$this->db->group_by("purchase_paper");
	    	$this->db->from('purchase');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			return $rows;
	    }

	    public function getCustomer($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('user_id', $id);
	    	}
	    	$this->db->select('customer_id, customer_name, customer_address, customer_district, customer_county, customer_road, customer_building, customer_floor, 
	    		customer_province, customer_zip, customer_tel, customer_fax, customer_email, customer_tax_code');
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

	    public function getCompany($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('company.user_id', $id);
	    	}
	    	$this->db->select('company_id, company_name, company_address, company_district, company_county, company_province, company_zip, company_tel, company_fax, company_tax_code, 
	    		company_logo, company.user_id, user.company_email');
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

	    public function getPurchase($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('purchase.user_id', $id['user_id']);
	    	}
	    	if(isset($id['purchase_id']) && trim($id['purchase_id'] != '')){
	    		$this->db->where('purchase_id', $id['purchase_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('purchase_paper', $id['paper']);
	    	}
	    	if(isset($id['per_page']) && trim($id['per_page'] != '')){
	    		$this->db->limit($id['per_page'], $id['page']);
	    	}
	    	$this->db->select('purchase_id, purchase_paper, purchase_text, purchase_number, condition_pay, pay_day, purchase_date, purchase_note, purchase_status, quotation_number, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, write_text, purchase.customer_id, customer.customer_name, purchase.user_id');
	    	if(!isset($id['paper'])){
	    		$this->db->group_by("purchase_paper");
	    	}
	    	$this->db->join('customer', 'customer.customer_id = purchase.customer_id');
	    	$this->db->order_by('purchase_date', 'desc');
	    	$this->db->from('purchase');
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

	    public function insertPurchase($data = array())
	    {
	    	$this->db->insert('purchase', $data);
	    }

	    public function updatePurchase($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('purchase_paper', $id['paper']);
	    	}
	    	$this->db->delete('purchase');
	    }

		public function checkPurchase($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('user_id', $id);
	    	}
	    	$this->db->select('purchase_paper');
	    	$this->db->from('purchase');
	    	$this->db->order_by('purchase_paper', 'asc');
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

	    public function searchPurchase($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('customer.customer_name', $id['search']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('purchase.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('customer.user_id', $id['user_id']);
	    	}
	    	$this->db->select('purchase_id, purchase_paper, purchase_text, purchase_number, condition_pay, pay_day, purchase_date, purchase_note, purchase_status, quotation_number, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, write_text, purchase.customer_id, customer.customer_name, purchase.user_id');
	    	$this->db->from('purchase');
            $this->db->join('customer', 'customer.customer_id = purchase.customer_id');
	    	$this->db->order_by('purchase_date', 'desc');
	    	$this->db->group_by("purchase_paper");
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
            
        public function getPurchaseReport($id) {
            //get data at same user_id and purchase_paper in each purchase_id.
            if(isset($id['user_id']) && trim($id['user_id']) != '') {
                $this->db->where('purchase.user_id', $id['user_id']);
            }

            if(isset($id['purchase_paper']) && trim($id['purchase_paper']) != '') {
                $this->db->where('purchase_paper', $id['purchase_paper']);
            }

            $this->db->select('purchase_text, purchase_number, purchase_date, purchase_note, product_name, product_amount, product_price, product_vat, condition_pay, pay_day, '
                    . ' product_discount, purchase.quotation_number, product_option, product_total, product_total_real, product_grand_total, write_text, company_address_all, company.company_name, '
                    . ' company.company_tel, company.company_email, company.company_fax, company.company_tax_code, company.company_logo, customer_name, customer_address, '
                    . ' customer_building, customer_floor, customer_road, customer_district, customer_county, customer_province, customer_zip, customer_tax_code, customer_tel, customer_email ');
            $this->db->from('purchase');
            $this->db->join('company', 'purchase.user_id = company.user_id');
            $this->db->join('customer', 'purchase.customer_id = customer.customer_id');
            $query = $this->db->get();
                $rows = $query->num_rows();
                if($rows > 0) {
                    for($i=0; $i < $rows; $i++) {
                        $data[$i] = $query->row_array($i);
                    }
                }else {
                    $data = null;
                }
                return $data;
            
        }

        public function chagnePurchaseStatus($data = array())
        {
            if(isset($data['user_id']) && trim($data['user_id'] != '')){
                    $this->db->where('user_id', $data['user_id']);
            }
            if(isset($data['purchase_id']) && trim($data['purchase_id'] != '')){
                    $this->db->where('purchase_paper', $data['purchase_id']);
            }
            $this->db->update('purchase', array('purchase_status' => 'ยกเลิก'));
        }
         
    }
        
        
?>