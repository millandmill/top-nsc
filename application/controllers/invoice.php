<?php defined('BASEPATH') OR exit('No direct script access allowed');

class invoice extends CI_Controller {

	public function invoice_display()
	{
		$this->load->library("pagination");
		$this->load->model('mol_invoice');
		$data['blank'] = "";
		$quotation['user_id'] = $this->session->userdata('user_id');
		$config = array();
        $config["base_url"] = base_url() . "invoice/invoice_display";
        $config["total_rows"] = $this->mol_invoice->getRecord_all($quotation);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();

		if(isset($_GET['b_id'])){
			$quotation['billingnote_paper'] = $_GET['b_id'];
			$quotation['quotation_paper'] = $_GET['q_id'];
			$chk_billing = $this->mol_invoice->chkInvoice($quotation);
			if(is_null($chk_billing)){
				$paper['invoice_paper'] = $this->mol_invoice->chkInvoice_paper($quotation);
				$checkProduct = $this->mol_invoice->checkReceipt($quotation);
				if(is_null($checkProduct)){
					$dataProduct = $this->mol_invoice->checkProduct($quotation);
					$cntProduct = count($dataProduct);
					for($j=0; $j<$cntProduct; $j++){
						$quantity = $dataProduct[$j]['product_amount'];
						$product['product_company_id'] = $dataProduct[$j]['product_company_id'];
						$checkStock = $this->mol_invoice->countStock($quotation, $product);
						$countStock = count($checkStock);
						if($checkStock[0]['product_type'] == "มีวันหมด"){
							if($quantity > $countStock){
								echo "<script>alert('สินค้าเกินจำนวนในสต็อก');</script>";
								redirect('billingnote/billingnote_display');
							}else{
								for($k=0; $k<$quantity; $k++){
									$product['product_id'] = $checkStock[$k]['product_id'];
									$this->mol_invoice->updateProduct($quotation, $product);
								}
							}
						}else{
							for($k=0; $k<$quantity; $k++){
								$product['product_company_id'] = $checkStock[0]['product_company_id'];
								$product['product_name'] = $checkStock[0]['product_name'];
								$product['product_type'] = $checkStock[0]['product_type'];
								$product['status_id'] = '2';
								$product['product_gen'] = $checkStock[0]['product_gen'];
								$product['product_exp'] = $checkStock[0]['product_exp'];
								$product['product_price'] = $checkStock[0]['product_price'];
								$product['user_id'] = $this->session->userdata('user_id');
								$this->mol_invoice->insertProduct($product);
							}
						}
					}
				}
				$count = count($paper['invoice_paper']);
				if(is_null($paper['invoice_paper'])){
					$quotation['invoice_paper'] = 1;
					$quotation['invoice_number'] = 1;
				}else{
					$quotation['invoice_paper'] = $paper['invoice_paper'][$count-1]['invoice_paper']+1;
					$quotation['invoice_number'] = $quotation['invoice_paper'];
				}
				$quotation['invoice_text'] = "IN";
				$quotation['invoice_status'] = "เสร็จสิ้น";
				$quotation['invoice_date'] = date("Y-m-d");
				if(is_null($checkProduct)){
					$this->mol_invoice->chkQuotation($quotation);
				}else{
					$this->mol_invoice->chkQuotation2($quotation);
				}
				$this->mol_invoice->insertInvoice($quotation);
			}/*else{
				$this->mol_invoice->chkQuotation($quotation);
				$this->mol_invoice->updateStatus($quotation);
			}*/
		}
		$data["invoice"] = $this->mol_invoice->getQuotation($quotation, $config["per_page"], $page);
		if(isset($_POST['btn_search'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['search'] = $_POST['search_query'];
			$data['search'] = $this->mol_invoice->searchInvoice($id);
			if(!isset($data['search'])){
				$data['search'] = "Not found.";
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('invoice', $data);
	}

	public function invoice_add()
	{
		$this->load->model('mol_quotation');
		$this->load->model('mol_invoice');
		$user_id = $this->session->userdata('user_id');
		if(isset($_POST['btn_submit'])){
			$insert = array(
				'quotation_text' => $_POST['qText'],
				'quotation_number' => $_POST['qNumber'],
				'quotation_paper' => $_POST['quotation_paper'],
				'company_name' => $_POST['organization'],
				// 'condition_pay' => $_POST['condition_pay'],
				// 'pay_day' => $_POST['pay_day'],
				// 'condition_date' => $_POST['con_date'],
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
				'customer_id' => $_POST['customer_option'],
				'write_text_principle' => $_POST['write_text2'],
				'write_text' => $_POST['write_text'],
				'user_id' => $user_id
				);
			$this->form_validation->set_rules('product[0]', 'Product', 'callback_check_invoice['.$_POST["customer_option"][0].','.$_POST["price"][0].','.$_POST["quantity"][0].','.$_POST["write_text"].']');
			if ($this->form_validation->run() == FALSE)
			{

			}else{
				$count_product = count($_POST['product']);
				if(isset($_POST['quotation_id']) && trim($_POST['quotation_id']) != ''){
					$id['paper'] = $_POST['quotation_paper'];
					$id['user_id'] = $user_id;
					$billing['invoice_text'] = $_POST['company_format'];
					$billing['invoice_number'] = $_POST['invoice_no'];
					$billing['invoice_date'] = $_POST['due_date'];
					$this->mol_invoice->updateInvoice($billing, $id);
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
				redirect('invoice/invoice_display');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('invoice/invoice_display');
		}

		if(isset($_GET['i_id'])){
			$id['id'] = $_GET['i_id'];
			$id['q_id'] = $_GET['q_id'];
			$id['user_id'] = $user_id;
			$data['edtQuotation'] = $this->mol_invoice->getQuotation2($id);
			$data['invoice_all'] = $this->mol_invoice->chkInvoice_paper($id);
			$data['statusOfInvoice'] = $this->mol_invoice->checkStatusInvoice($id);
			$data['statusOfReceipt'] = $this->mol_invoice->checkStatusReceipt($id);
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
		$data['customer'] = $this->mol_invoice->getCustomer($user_id);
		$data['product'] = $this->mol_quotation->getProduct($user_id);

		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('add_invoice', $data);
	}

	public function check_invoice($name, $data)
	{
		$data = preg_split('/,/', $data);
		$option = $data[0];
	    $price = $data[1];
	    $quantity = $data[2];
	    $write = $data[3];

	    if($option == 0){
	    	$this->form_validation->set_message('check_purchase', 'The Customer field is required.');
			return false;
		}else if($name == ""){
			$this->form_validation->set_message('check_invoice', 'The Product name field is required.');
			return false;
		}else if($price == ""){
			$this->form_validation->set_message('check_invoice', 'The Price field is required.');
			return false;
		}else if($quantity == ""){
			$this->form_validation->set_message('check_invoice', 'The Quantity field is required.');
			return false;
		}else if($write == ""){
			$this->form_validation->set_message('check_invoice', 'The Write Text field is required.');
			return false;
		}else{
			return true;
		}
	}

	public function change_status()
	{
		$this->load->model('mol_invoice');
		if(isset($_GET['i_id'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['quotation_id'] = $_GET['q_id'];
			$id['pri_id'] = $_GET['i_id'];
			$this->mol_invoice->chageReceiptStatus($id);
			$this->mol_invoice->changeBeforeStatus($id);
			redirect('invoice/invoice_display');
		}
	}

}

?>