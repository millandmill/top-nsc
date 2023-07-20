<?php

	class mol_receipt extends CI_Model
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
	        $this->db->select('receipt_id');
	    	$this->db->group_by("receipt_paper");
	    	$this->db->from('receipt');
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
	    		$this->db->where('receipt.user_id', $id['user_id']);
	    	}
	    	if(isset($end) && trim($end != '')){
	    		$this->db->limit($end, $start);
	    	}
	    	$this->db->select('quotation_id, quotation.quotation_paper, ,quotation_text, quotation_number, quotation_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, quotation.user_id, receipt.receipt_paper, receipt.receipt_id, receipt.receipt_text, receipt.receipt_number, 
	    		receipt.receipt_date, receipt.receipt_status, quotation.customer_id, customer.customer_name');
	    	$this->db->join('receipt', 'quotation.quotation_paper = receipt.quotation_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('receipt_date', 'desc');
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

	    public function getQuotation2($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('receipt.user_id', $id['user_id']);
	    	}
	    	if(isset($id['id']) && trim($id['id'] != '')){
	    		$this->db->where('receipt.receipt_id', $id['id']);
	    	}
	    	if(isset($end) && trim($end != '')){
	    		$this->db->limit($end, $start);
	    	}
	    	$this->db->select('quotation_id, quotation.quotation_paper, ,quotation_text, quotation_number, quotation_date, quotation_note, quotation_status, write_text_principle, write_text, 
	    	 	issue_date, payment_date, condition_pay, pay_day, condition_date, company_name, company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, 
	    	 	product_company_id, product_name, product_price, product_amount, product_discount, product_total, product_total_real, product_grand_total, product_vat, quotation.user_id, 
	    	 	receipt.receipt_id, receipt.receipt_text, receipt.receipt_number, receipt.receipt_date, receipt.receipt_status, quotation.customer_id, customer.customer_name');
	    	$this->db->join('receipt', 'quotation.quotation_paper = receipt.quotation_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
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
	    	if(isset($id['q_id']) && trim($id['q_id'] != '')){
	    		$this->db->where('quotation_paper', $id['q_id']);
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
	    	if(isset($id['q_id']) && trim($id['q_id'] != '')){
	    		$this->db->where('quotation_paper', $id['q_id']);
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

	    public function searchReceipt($id)
	    {
	    	if(isset($id['search']) && trim($id['search'] != '')){
	    		$this->db->like('customer.customer_name', $id['search']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('receipt.user_id', $id['user_id']);
	    	}
	    	$this->db->select('quotation_id, quotation.quotation_paper, ,quotation_text, quotation_number, quotation_date, quotation_note, quotation_status, company_name,
	    		company_address_all, company_email, company_tel, company_fax, company_tax_code, product_option, product_company_id, product_name, product_price, product_amount,
	    		product_discount, product_total, product_total_real, product_grand_total, product_vat, quotation.user_id, receipt.receipt_paper, receipt.receipt_id, receipt.receipt_text, receipt.receipt_number, 
	    		receipt.receipt_date, receipt.receipt_status, quotation.customer_id, customer.customer_name');
	    	$this->db->join('receipt', 'quotation.quotation_paper = receipt.quotation_paper');
	    	$this->db->join('customer', 'customer.customer_id = quotation.customer_id');
	    	$this->db->order_by('receipt_date', 'desc');
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
	    
	    public function updateProduct($id, $product)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($product['product_company_id']) && trim($product['product_company_id'] != '')){
	    		$this->db->where('product_company_id', $product['product_company_id']);
	    	}
	    	if(isset($product['product_id']) && trim($product['product_id'] != '')){
	    		$this->db->where('product_id', $product['product_id']);
	    	}
	    	$this->db->update('product', array('status_id' => '2'));
	    }
	    public function insertProduct($data)
	    {
	    	$this->db->insert('product', $data);
	    }
	    public function checkProduct($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('quotation.user_id', $id['user_id']);
	    	}
	    	if(isset($id['quotation_paper']) && trim($id['quotation_paper'] != '')){
	    		$this->db->where('quotation_paper', $id['quotation_paper']);
	    	}
	    	$this->db->select('quotation.product_company_id, quotation.product_name, quotation.product_price, quotation.product_amount');
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
	    public function countStock($id, $product)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($product['product_company_id']) && trim($product['product_company_id'] != '')){
	    		$this->db->where('product_company_id', $product['product_company_id']);
	    	}
	    	$this->db->select('product_id, product_company_id, product_name, product_type, product_gen, product_exp, product_price');
	    	$this->db->where('status_id', "1");
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
	    public function checkInvoice($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['quotation_paper']) && trim($id['quotation_paper'] != '')){
	    		$this->db->where('quotation_paper', $id['quotation_paper']);
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

	    public function chkInvoice($id){
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['billingnote_paper']) && trim($id['billingnote_paper'] != '')){
	    		$this->db->where('billingnote_paper', $id['billingnote_paper']);
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

	    public function chkQuotation($arr)
	    {
	    	if(isset($arr['user_id']) && trim($arr['user_id'] != '')){
	    		$this->db->where('user_id', $arr['user_id']);
	    	}
	    	if(isset($arr['billingnote_paper']) && trim($arr['billingnote_paper'] != '')){
	    		$this->db->where('billingnote_paper', $arr['billingnote_paper']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'ออกใบเสร็จรับเงินแล้ว'));
	    }

	    public function chkQuotation2($arr)
	    {
	    	if(isset($arr['user_id']) && trim($arr['user_id'] != '')){
	    		$this->db->where('user_id', $arr['user_id']);
	    	}
	    	if(isset($arr['billingnote_paper']) && trim($arr['billingnote_paper'] != '')){
	    		$this->db->where('billingnote_paper', $arr['billingnote_paper']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'ออกใบเสร็จทั้ง 2 ใบแล้ว'));
	    }

	    public function insertInvoice($data = array())
	    {
	    	$this->db->insert('receipt', $data);
	    }

	    public function chkInvoice_paper($id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('receipt.user_id', $id['user_id']);
	    	}
	    	if(isset($id['id']) && trim($id['id'] != '')){
	    		$this->db->where('receipt.receipt_id', $id['id']);
	    	}
	    	$this->db->select('receipt_id, receipt_paper, receipt_text, receipt_number, receipt_date, billingnote.billingnote_paper, billingnote.billingnote_text, billingnote.billingnote_number, billingnote.user_id');
	    	$this->db->join('billingnote', 'billingnote.billingnote_paper = receipt.billingnote_paper');
	    	$this->db->from('receipt');
	    	$this->db->order_by('receipt_paper', 'asc');
	    	$this->db->group_by('billingnote.billingnote_paper');
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

	    public function updateInvoice($data = array(), $id)
	    {
	    	if(isset($id['user_id']) && trim($id['user_id'] != '')){
	    		$this->db->where('user_id', $id['user_id']);
	    	}
	    	if(isset($id['paper']) && trim($id['paper'] != '')){
	    		$this->db->where('quotation_paper', $id['paper']);
	    	}
	    	$this->db->update('receipt', $data);
	    }

	    public function chageReceiptStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['pri_id']) && trim($data['pri_id'] != '')){
	    		$this->db->where('receipt_id', $data['pri_id']);
	    	}
	    	$this->db->update('receipt', array('receipt_status' => 'ยกเลิก'));
	    }

	    public function changeBeforeStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['quotation_id']) && trim($data['quotation_id'] != '')){
	    		$this->db->where('quotation_paper', $data['quotation_id']);
	    	}
	    	$this->db->update('billingnote', array('billingnote_status' => 'รอใบเสร็จ'));
	    }

	    public function updateStatus($data = array())
	    {
	    	if(isset($data['user_id']) && trim($data['user_id'] != '')){
	    		$this->db->where('user_id', $data['user_id']);
	    	}
	    	if(isset($data['billingnote_paper']) && trim($data['billingnote_paper'] != '')){
	    		$this->db->where('billingnote_paper', $data['billingnote_paper']);
	    	}
	    	$this->db->update('receipt', array('receipt_status' => 'เสร็จสิ้น'));
	    }
            
            public function getReceiptReport($id) {
                //get data at same user_id and each receipt_paper
                if(isset($id['user_id']) && trim($id['user_id']) != '') {
                    $this->db->where('receipt.user_id', $id['user_id']);
                    $this->db->where('quotation.user_id', $id['user_id']);
                    $this->db->where('billingnote.user_id', $id['user_id']);
                }

                if(isset($id['receipt_paper']) && trim($id['receipt_paper']) != '') {
                    $this->db->where('receipt_paper', $id['receipt_paper']);
                }

                $this->db->select('receipt_text, receipt_number, receipt_date, billingnote_text, billingnote_number, product_name, product_amount, product_price, product_discount, '
                        . ' payment_date, product_total, write_text, product_total_real, product_vat, condition_pay, pay_day, '
                        . ' product_option, product_grand_total, company_address_all, company.company_name, '
                        . ' company.company_tel, company.company_email, company.company_fax, company.company_tax_code, company.company_logo, customer_name, customer_address, '
                        . ' customer_building, customer_floor, customer_road, customer_district, customer_county, customer_province, customer_zip, customer_tax_code, customer_tel, customer_email ');
                $this->db->from('receipt');
                $this->db->join('company', 'receipt.user_id = company.user_id');
                $this->db->join('quotation', 'receipt.quotation_paper = quotation.quotation_paper');
                $this->db->join('billingnote', 'receipt.billingnote_paper = billingnote.billingnote_paper');
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