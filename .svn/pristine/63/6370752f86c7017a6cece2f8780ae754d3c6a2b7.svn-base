<?php

	class mol_billingnote extends CI_Model
	{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
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

	    public function getRecord_all($quotation) {
	    	if(isset($quotation['user_id']) && trim($quotation['user_id'] != '')){
	    		$this->db->where('user_id', $quotation['user_id']);
	    	}
	        $this->db->select('billingnote_id');
	    	$this->db->group_by("billingnote_paper");
	    	$this->db->from('billingnote');
	    	$query = $this->db->get();
			$rows = $query->num_rows();
			return $rows;
	    }

	    public function getQuotation($id, $end, $start)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('billingnote.user_id', $id['user_id']);
	    	}
	    	if(isset($end) && trim($end != '')){
	    		$this->db->limit($end, $start);
	    	}
	    	$this->db->select('quotation_id, quotation.quotation_paper, quotation_text, quotation_number, quotation_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, quotation.user_id, billingnote.billingnote_id, billingnote.billingnote_paper, 
	    		billingnote.billingnote_text, billingnote.billingnote_number, billingnote.billingnote_date, billingnote.billingnote_status, quotation.customer_id, customer.customer_name');
	    	$this->db->join('billingnote', 'quotation.quotation_paper = billingnote.quotation_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('billingnote_date', 'desc');
	    	$this->db->group_by("quotation_paper");
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

	    public function chkBillingnote($id){
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['quotation_paper']) && trim($id['quotation_paper'] != '')){
	    		$this->db->where('quotation_paper', $id['quotation_paper']);
	    	}
	    	$this->db->select('billingnote_id');
	    	$this->db->from('billingnote');
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

	    public function chkQuotation($arr)
	    {
	    	if(isset($arr['user_id']) && trim($arr['user_id'] != '')){
	    		$this->db->where('user_id', $arr['user_id']);
	    	}
	    	if(isset($arr['quotation_paper']) && trim($arr['quotation_paper'] != '')){
	    		$this->db->where('quotation_paper', $arr['quotation_paper']);
	    	}
	    	$this->db->update('quotation', array('quotation_status' => 'ออกใบวางบิลแล้ว'));
	    }

	    public function insertQuotation($data = array())
	    {
	    	$this->db->insert('billingnote', $data);
	    }

	    public function chkBillingnote_paper($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->select('billingnote_paper, billingnote_text, billingnote_number, billingnote_date, numberOfPurchase');
	    	$this->db->from('billingnote');
	    	$this->db->order_by('billingnote_paper', 'asc');
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

	    public function searchBillingnote($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('customer.customer_name', $id['search']);
	    	}
	    	if(isset($id['option']) && trim($id['option'] != '')){
	    		$this->db->like('billingnote_status', $id['option']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	$this->db->select('quotation_id, quotation.quotation_paper, quotation_text, quotation_number, quotation_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, quotation.user_id, billingnote.billingnote_id, billingnote.billingnote_paper, 
	    		billingnote.billingnote_text, billingnote.billingnote_number, billingnote.billingnote_date, billingnote.billingnote_status, quotation.customer_id, customer.customer_name');
	    	$this->db->join('billingnote', 'quotation.quotation_paper = billingnote.quotation_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('billingnote_date', 'desc');
	    	$this->db->group_by("quotation_paper");
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

	    public function updateBillingnote($data = array(), $id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->update('billingnote', $data);
	    }

	    public function chageReceiptStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['pri_id']) && trim($data['pri_id'] != '')){
	    		$this->db->where('billingnote_id', $data['pri_id']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'ยกเลิก'));
	    }

	    public function changeBeforeStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['quotation_id']) && trim($data['quotation_id'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_id']);
	    	}
	    	$this->db->update('quotation', array('quotation_status' => 'รอใบวางบิล')	);
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
	    	if(isset($data['quotation_paper']) && trim($data['quotation_paper'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_paper']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'รอใบเสร็จ'));
	    }
            
            public function getBillingnoteReport($id) {
                //get data at same user_id and purchase_paper in each purchase_id.
                if(isset($id['user_id']) && trim($id['user_id']) != '') {
                    $this->db->where('billingnote.user_id', $id['user_id']);
                    $this->db->where('quotation.user_id', $id['user_id']);
                }

                if(isset($id['billingnote_paper']) && trim($id['billingnote_paper']) != '') {
                    $this->db->where('billingnote_paper', $id['billingnote_paper']);
                }
                
                $this->db->select('billingnote_text, billingnote_number, billingnote_date, numberOfPurchase, quotation.quotation_text, quotation.quotation_number, quotation.issue_date, quotation.condition_date, quotation.product_total_real, '
                        . ' quotation.condition_pay, quotation.payment_date, '
                        . ' write_text_principle, write_text, company_address_all, company.company_name, '
                        . ' company.company_tel, company.company_email, company.company_fax, company.company_tax_code, company.company_logo, customer_name, customer_address, '
                        . ' customer_building, customer_floor, customer_road, customer_district, customer_county, customer_province, customer_zip, customer_tax_code, customer_tel, customer_email ');
                $this->db->from('billingnote');
                $this->db->join('quotation', 'quotation.quotation_paper = billingnote.quotation_paper');
                $this->db->join('company', 'company.user_id = billingnote.user_id');
                $this->db->join('customer', 'quotation.customer_id = customer.customer_id');
                $this->db->group_by('quotation.quotation_paper');
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