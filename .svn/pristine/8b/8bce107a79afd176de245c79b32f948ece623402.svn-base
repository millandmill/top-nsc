<?php

	class mol_quotation extends CI_Model
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
	        $this->db->select('quotation_id');
	    	$this->db->group_by("quotation_paper");
	    	$this->db->from('quotation');
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

	   	public function getProduct($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('user_id', $id);
	    	}
	    	$this->db->select('product_id, product_company_id, product_name, product_type, product_gen, product_exp, product_price');
	    	$this->db->where('status_id', '1');
	    	$this->db->order_by('product_name', 'asc');
	    	$this->db->from('product');
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

	    public function getQuotation($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['quotation_id']) && trim($id['quotation_id'] != '')){
	    		$this->db->where('quotation_id', $id['quotation_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	if(isset($id['per_page']) && trim($id['per_page'] != '')){
	    		$this->db->limit($id['per_page'], $id['page']);
	    	}
	    	$this->db->select('quotation_id, quotation_paper, ,quotation_text, quotation_number, quotation_date, issue_date, payment_date, condition_pay, pay_day, condition_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, write_text_principle, write_text, quotation.customer_id, quotation.user_id, customer.customer_name');
	    	if(!isset($id['paper'])){
	    		$this->db->group_by("quotation_paper");
	    	}
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('quotation_date', 'desc');
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

	    public function insertQuotation($data = array())
	    {
	    	$this->db->insert('quotation', $data);
	    }

	    public function updateQuotation($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->delete('quotation');
	    }

	    public function checkStatusInvoice($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->select('invoice_id');
	    	$this->db->from('invoice');
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

	    public function checkStatusReceipt($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->select('receipt_id');
	    	$this->db->from('receipt');
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

		public function checkQuotation($id)
	    {
	    	if(isset($id) && trim($id != '')){
	    		$this->db->where('user_id', $id);
	    	}
	    	$this->db->select('quotation_paper');
	    	$this->db->from('quotation');
	    	$this->db->order_by('quotation_paper', 'asc');
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

	    public function searchQuotation($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('customer.customer_name', $id['search']);
	    	}
	    	if(isset($id['option']) && trim($id['option'] != '')){
	    		$this->db->like('quotation_status', $id['option']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	$this->db->select('quotation_id, quotation_paper, ,quotation_text, quotation_number, quotation_date, issue_date, payment_date, condition_pay, pay_day, condition_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, write_text_principle, write_text, quotation.customer_id, quotation.user_id, customer.customer_name');
	    	if(!isset($id['paper'])){
	    		$this->db->group_by("quotation_paper");
	    	}
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('quotation_date', 'desc');
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

	    public function chageReceiptStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['pri_id']) && trim($data['pri_id'] != '')){
	    		$this->db->where('quotation_id', $data['pri_id']);
	    	}
	    	$this->db->update('quotation', array('quotation_status' => 'ยกเลิก'));
	    }

	    public function changeBeforeStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['quotation_id']) && trim($data['quotation_id'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_id']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'ยกเลิก'));
	    }

	    public function checkInvoiceStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['quotation_id']) && trim($data['quotation_id'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_id']);
	    	}
	    	$this->db->update('invoice', array('invoice_status' => 'ยกเลิก'));
	    }

	    public function checkReceiptStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['quotation_id']) && trim($data['quotation_id'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_id']);
	    	}
	    	$this->db->update('receipt', array('receipt_status' => 'ยกเลิก'));
	    }

	    public function updateStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['billingnote_paper']) && trim($data['billingnote_paper'] != '')){
	    		$this->db->where('billingnote_paper', $data['billingnote_paper']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'เสร็จสิ้น'));
	    }
            
            public function getQuotationReport($id) {
            //get data at same user_id and quotation_paper in each quotation_id.
            if(isset($id['user_id']) && trim($id['user_id']) != '') {
                $this->db->where('quotation.user_id', $id['user_id']);
            }

            if(isset($id['quotation_paper']) && trim($id['quotation_paper']) != '') {
                $this->db->where('quotation_paper', $id['quotation_paper']);
            }

            $this->db->select('quotation_text, quotation_number, quotation_date, quotation_note, product_name, product_amount, product_price, product_vat, condition_pay, pay_day, condition_date, '
                    . ' issue_date, product_discount, product_option, write_text, product_total, product_total_real, product_grand_total, company_address_all, company.company_name, '
                    . ' company.company_tel, company.company_email, company.company_fax, company.company_tax_code, company.company_logo, customer_name, customer_address, '
                    . ' customer_building, customer_floor, customer_road, customer_district, customer_county, customer_province, customer_zip, customer_tax_code, customer_tel, customer_email ');
            $this->db->from('quotation');
            $this->db->join('company', 'quotation.user_id = company.user_id');
            $this->db->join('customer', 'quotation.customer_id = customer.customer_id');
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
	}
?>