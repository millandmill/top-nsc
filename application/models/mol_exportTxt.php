<?php

	class mol_exportTxt extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

	    public function getCompany($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	$this->db->select('company_id, company_name, company_address, company_district, company_county,  company_road, company_building, company_floor, company_province, 
	    		company_zip, company_tel, company_fax, company_tax_code, company_logo, user_id');
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

	    public function getValueForExport($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('profile.user_id', $id['user_id']);
	    	}
	    	$this->db->select('company_tax_code, profile_id, profile_before_name, profile_fname, profile_lname, profile_address, profile_postcost, profile_man_tax, profile_branch, profile_iden,
	    		profile_iden_money, profile_money_id, profile_money_date, profile_condition_id, profile.user_id');
	    	$this->db->join('company', 'company.user_id = profile.user_id');
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

	    public function check_report($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('invoice.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('customer.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('billingnote.user_id', $id['user_id']);
	    	}
	    	if(isset($id['dateStart']) && trim($id['dateStart'] != '')){
	    		$this->db->where('invoice.invoice_date >=', $id['dateStart']);
	    	}
	    	if(isset($id['dateEnd']) && trim($id['dateEnd'] != '')){
	    		$this->db->where('invoice.invoice_date <=', $id['dateEnd']);
	    	}
	    	$this->db->select('billingnote.billingnote_text, billingnote.billingnote_number, invoice.invoice_text, invoice.invoice_number, invoice_date, quotation.condition_date, 
	    		quotation.product_total_real, quotation.product_grand_total, customer.customer_name, quotation.user_id');
	    	$this->db->join('invoice', 'quotation.quotation_paper = invoice.quotation_paper');
	    	$this->db->join('billingnote', 'invoice.billingnote_paper = billingnote.billingnote_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->group_by("quotation.quotation_paper");
	    	$this->db->from('quotation');
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

	    public function check_reportBuy($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('purchase.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('customer.user_id', $id['user_id']);
	    	}
	    	if(isset($id['dateStart']) && trim($id['dateStart'] != '')){
	    		$this->db->where('purchase.purchase_date >=', $id['dateStart']);
	    	}
	    	if(isset($id['dateEnd']) && trim($id['dateEnd'] != '')){
	    		$this->db->where('purchase.purchase_date <=', $id['dateEnd']);
	    	}
	    	$this->db->where('purchase.purchase_status', 'เสร็จสิ้น');
	    	$this->db->select('purchase_text, purchase_number, purchase_date, quotation_number, customer.customer_name, product_total_real, product_grand_total, purchase.user_id');
	    	$this->db->join('customer', 'customer.customer_id = purchase.customer_id');
	    	$this->db->group_by("purchase.purchase_paper");
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
	}
?>