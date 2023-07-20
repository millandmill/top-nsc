<?php defined('BASEPATH') OR exit('No direct script access allowed');

class quotation extends CI_Controller {

	public function quotation_display()
	{
		$this->load->library("pagination");
		$this->load->model('mol_quotation');
		$id['user_id'] = $this->session->userdata('user_id');
		$config = array();
        $config["base_url"] = base_url() . "quotation/quotation_display";
        $config["total_rows"] = $this->mol_quotation->getRecord_all($id);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $id['per_page'] = $config["per_page"];
        $id['page'] = $page;
		$data['quotation'] = $this->mol_quotation->getQuotation($id);
		if(isset($_POST['btn_search'])){
			$id['search'] = $_POST['search_query'];
			$id['option'] = $_POST['quotationOrder_status'];
			$data['search'] = $this->mol_quotation->searchQuotation($id);
			if(!isset($data['search'])){
				$data['search'] = "Not found.";
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('sell', $data);
	}

	public function quotation_add()
	{
		$this->load->model('mol_quotation');
		$user_id = $this->session->userdata('user_id');
		if(isset($_POST['btn_submit'])){
			$insert = array(
				'quotation_paper' => $_POST['quotation_paper'],
				'quotation_text' => $_POST['company_format'],
				'quotation_number' => $_POST['invoice_no'],
				'company_name' => $_POST['organization'],
				'condition_pay' => $_POST['condition_pay'],
				'pay_day' => $_POST['pay_day'],
				'issue_date' => $_POST['is_date'],
				'condition_date' => $_POST['con_date'],
				'payment_date' => $_POST['hidden_date'],
				'quotation_date' => $_POST['due_date'],
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
				'customer_id' => $_POST['customer_option'],
				'write_text_principle' => $_POST['write_text2'],
				'write_text' => $_POST['write_text'],
				'user_id' => $user_id
				);
			$this->form_validation->set_rules('product[0]', 'Product', 'callback_check_quotation['.$_POST["customer_option"][0].','.$_POST["price"][0].','.$_POST["quantity"][0].','.$_POST["write_text"].']');
			if ($this->form_validation->run() == FALSE)
			{

			}else{
				$count_product = count($_POST['product']);
				if(isset($_POST['quotation_id']) && trim($_POST['quotation_id']) != ''){
					$id['paper'] = $_POST['quotation_paper'];
					$id['user_id'] = $user_id;
					$this->mol_quotation->updateQuotation($id);
					$insert['quotation_status'] = $_POST['quotation_status'];
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
				redirect('quotation/quotation_display');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('quotation/quotation_display');
		}

		if(isset($_GET['q_id'])){
			$id['paper'] = $_GET['q_id'];
			$id['user_id'] = $user_id;
			$data['edtQuotation'] = $this->mol_quotation->getQuotation($id);
			$data['statusOfInvoice'] = $this->mol_quotation->checkStatusInvoice($id);
			$data['statusOfReceipt'] = $this->mol_quotation->checkStatusReceipt($id);
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
		$data['customer'] = $this->mol_quotation->getCustomer($user_id);
		$data['product'] = $this->mol_quotation->getProduct($user_id);

		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('add_sell', $data);
	}

	public function check_quotation($name, $data)
	{
		$data = preg_split('/,/', $data);
		$option = $data[0];
	    $price = $data[1];
	    $quantity = $data[2];
	    $write = $data[3];

	    if($option == 0){
	    	$this->form_validation->set_message('check_quotation', 'The Customer field is required.');
			return false;
		}else if($name == ""){
			$this->form_validation->set_message('check_quotation', 'The Product name field is required.');
			return false;
		}else if($price == ""){
			$this->form_validation->set_message('check_quotation', 'The Price field is required.');
			return false;
		}else if($quantity == ""){
			$this->form_validation->set_message('check_quotation', 'The Quantity field is required.');
			return false;
		}else if($write == ""){
			$this->form_validation->set_message('check_quotation', 'The Write Text field is required.');
			return false;
		}else{
			return true;
		}
	}

	public function change_status()
	{
		$this->load->model('mol_quotation');
		if(isset($_GET['quo_id'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['quotation_id'] = $_GET['q_id'];
			$id['pri_id'] = $_GET['quo_id'];
			$this->mol_quotation->chageReceiptStatus($id);
			$this->mol_quotation->changeBeforeStatus($id);
			$this->mol_quotation->checkInvoiceStatus($id);
			$this->mol_quotation->checkReceiptStatus($id);
			redirect('quotation/quotation_display');
		}
	}
}

?>