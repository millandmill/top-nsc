<?php defined('BASEPATH') OR exit('No direct script access allowed');

class billingnote extends CI_Controller {

	public function billingnote_display()
	{
		$this->load->library("pagination");
		$this->load->model('mol_billingnote');
		$data['blank'] = "";
		$quotation['user_id'] = $this->session->userdata('user_id');
		$config = array();
        $config["base_url"] = base_url() . "billingnote/billingnote_display";
        $config["total_rows"] = $this->mol_billingnote->getRecord_all($quotation);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		//$data['billingnote'] = $this->mol_billingnote->getQuotation($quotation);

		if(isset($_GET['q_id'])){
			$quotation['quotation_paper'] = $_GET['q_id'];
			$chk_billing = $this->mol_billingnote->chkBillingnote($quotation);
			if(is_null($chk_billing)){
				$paper['billingnote_paper'] = $this->mol_billingnote->chkBillingnote_paper($quotation);
				$count = count($paper['billingnote_paper']);
				if(is_null($paper['billingnote_paper'])){
					$quotation['billingnote_paper'] = 1;
					$quotation['billingnote_number'] = 1;
				}else{
					$quotation['billingnote_paper'] = $paper['billingnote_paper'][$count-1]['billingnote_paper']+1;
					$quotation['billingnote_number'] = $quotation['billingnote_paper'];
				}
				$quotation['billingnote_text'] = "BN";
				$quotation['billingnote_status'] = "รอใบเสร็จ";
				$quotation['billingnote_date'] = date("Y-m-d");
				$this->mol_billingnote->chkQuotation($quotation);
				$this->mol_billingnote->insertQuotation($quotation);
			}/*else{
				$this->mol_billingnote->chkQuotation($quotation);
				$this->mol_billingnote->updateStatus($quotation);
			}*/
		}
		$data["billingnote"] = $this->mol_billingnote->getQuotation($quotation, $config["per_page"], $page);
		if(isset($_POST['btn_search'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['search'] = $_POST['search_query'];
			$id['option'] = $_POST['purchaseOrder_status'];
			$data['search'] = $this->mol_billingnote->searchBillingnote($id);
			if(!isset($data['search'])){
				$data['search'] = "Not found.";
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('billingnote', $data);
	}

	public function billingnote_add()
	{
		$this->load->model('mol_quotation');
		$this->load->model('mol_billingnote');
		$user_id = $this->session->userdata('user_id');
		if(isset($_POST['btn_submit'])){
			$insert = array(
				'quotation_text' => $_POST['qText'],
				'quotation_number' => $_POST['qNumber'],
				'quotation_paper' => $_POST['quotation_paper'],
				'company_name' => $_POST['organization'],
				//'condition_pay' => $_POST['condition_pay'],
				//'pay_day' => $_POST['pay_day'],
				//'condition_date' => $_POST['con_date'],
				//'quotation_date' => $_POST['due_date'],
				'company_address_all' => $_POST['address'],
				'company_email' => $_POST['email'],
				'company_tel' => $_POST['telephone'],
				'company_tax_code' => $_POST['tax_id'],
				//'receipt_number' => $_POST['reference'],
				'product_option' => $_POST['price_option'],
				'product_total_real' => $_POST['sum_amount'],
				'quotation_note' => $_POST['invoice_note'],
				'product_vat' => $_POST['sum_tax'],
				'product_grand_total' => $_POST['grand_total'],
				'write_text_principle' => $_POST['write_text2'],
				'write_text' => $_POST['write_text'],
				'customer_id' => $_POST['customer_option'],
				'user_id' => $user_id
				);
			$this->form_validation->set_rules('product[0]', 'Product', 'callback_check_billingnote['.$_POST["customer_option"][0].','.$_POST["price"][0].','.$_POST["quantity"][0].','.$_POST["write_text"].']');
			if ($this->form_validation->run() == FALSE)
			{

			}else{
				$count_product = count($_POST['product']);
				if(isset($_POST['quotation_id']) && trim($_POST['quotation_id']) != ''){
					$id['paper'] = $_POST['quotation_paper'];
					$id['user_id'] = $user_id;
					$billing['billingnote_text'] = $_POST['company_format'];
					$billing['billingnote_number'] = $_POST['invoice_no'];
					$billing['billingnote_date'] = $_POST['due_date'];
					$billing['numberOfPurchase']  = $_POST['numberOfPurchase'];
					$this->mol_billingnote->updateBillingnote($billing, $id);
					$this->mol_quotation->updateQuotation($id);
					$insert['quotation_status'] = $_POST['quotation_status'];
					$insert['quotation_date'] = $_POST['quotation_date'];
					$insert['issue_date'] = $_POST['is_date'];
					$insert['payment_date'] = $_POST['payment_date'];
					$insert['condition_pay'] = $_POST['con_pay'];
					$insert['pay_day'] = $_POST['pay_day'];
					$insert['condition_date'] = $_POST['con_date'];
					for($i=0; $i<$count_product; $i++){
						$insert['product_company_id'] = $_POST['id'][$i];
						$insert['product_name'] = $_POST['product'][$i];
						$insert['product_price'] = $_POST['price'][$i];
						$insert['product_amount'] = $_POST['quantity'][$i];
						$insert['product_discount'] = $_POST['discount'][$i];
						$insert['product_total'] = $_POST['amount'][$i];
						$this->mol_quotation->insertQuotation($insert);
					}
				}else{
					$insert['quotation_status'] = "รอใบวางบิล";
					$insert['quotation_date'] = $_POST['quotation_date'];
					for($i=0; $i<$count_product; $i++){
						$insert['product_company_id'] = $_POST['id'][$i];
						$insert['product_name'] = $_POST['product'][$i];
						$insert['product_price'] = $_POST['price'][$i];
						$insert['product_amount'] = $_POST['quantity'][$i];
						$insert['product_discount'] = $_POST['discount'][$i];
						$insert['product_total'] = $_POST['amount'][$i];
						$this->mol_quotation->insertQuotation($insert);
					}
				}
				redirect('billingnote/billingnote_display');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('billingnote/billingnote_display');
		}

		if(isset($_GET['q_id'])){
			$id['paper'] = $_GET['q_id'];
			$id['user_id'] = $user_id;
			$data['edtQuotation'] = $this->mol_quotation->getQuotation($id);
			$data['billingnote_all'] = $this->mol_billingnote->chkBillingnote_paper($id);
			$data['statusOfInvoice'] = $this->mol_billingnote->checkStatusInvoice($id);
			$data['statusOfReceipt'] = $this->mol_billingnote->checkStatusReceipt($id);
		}else{
			$data['company'] = $this->mol_quotation->getCompany($user_id);
			$quotation['quotation_paper'] = $this->mol_quotation->checkQuotation($user_id);
			$count = count($quotation['quotation_paper']);
			if(is_null($quotation['quotation_paper'])){
				$data['paper'] = 0;
			}else{
				$data['paper'] = $quotation['quotation_paper'][$count-1]['quotation_paper'];
			}
		}
		$data['customer'] = $this->mol_billingnote->getCustomer($user_id);
		$data['product'] = $this->mol_quotation->getProduct($user_id);

		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('add_billingnote', $data);
	}

	public function check_billingnote($name, $data)
	{
		$data = preg_split('/,/', $data);
	    $option = $data[0];
	    $price = $data[1];
	    $quantity = $data[2];
	    $write = $data[3];

	    if($option == 0){
	    	$this->form_validation->set_message('check_billingnote', 'The Customer field is required.');
			return false;
	    }else if($name == ""){
			$this->form_validation->set_message('check_billingnote', 'The Product name field is required.');
			return false;
		}else if($price == ""){
			$this->form_validation->set_message('check_billingnote', 'The Price field is required.');
			return false;
		}else if($quantity == ""){
			$this->form_validation->set_message('check_billingnote', 'The Quantity field is required.');
			return false;
		}else if($write == ""){
			$this->form_validation->set_message('check_billingnote', 'The Write Text field is required.');
			return false;
		}else{
			return true;
		}
	}

	public function change_status()
	{
		$this->load->model('mol_billingnote');
		if(isset($_GET['b_id'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['quotation_id'] = $_GET['q_id'];
			$id['pri_id'] = $_GET['b_id'];
			$this->mol_billingnote->chageReceiptStatus($id);
			$this->mol_billingnote->changeBeforeStatus($id);
			$this->mol_billingnote->checkInvoiceStatus($id);
			$this->mol_billingnote->checkReceiptStatus($id);
			redirect('billingnote/billingnote_display');
		}
	}
}

?>