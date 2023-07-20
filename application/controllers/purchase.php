<?php defined('BASEPATH') OR exit('No direct script access allowed');

class purchase extends CI_Controller {

	public function purchase_display()
	{
		$this->load->library("pagination");
		$this->load->model('mol_purchase');
		$id['user_id'] = $this->session->userdata('user_id');
		$config = array();
        $config["base_url"] = base_url() . "purchase/purchase_display";
        $config["total_rows"] = $this->mol_purchase->getRecord_all($id);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
    	$config["num_links"] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $id['per_page'] = $config["per_page"];
        $id['page'] = $page;
		$data['purchase'] = $this->mol_purchase->getPurchase($id);
		if(isset($_POST['btn_search'])){
			$id['search'] = $_POST['search_seller'];
			$data['search'] = $this->mol_purchase->searchPurchase($id);
			if(!isset($data['search'])){
				$data['search'] = "Not found.";
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('purchase', $data);
	}

	public function add_purchase()
	{
		$this->load->model('mol_purchase');
		$user_id = $this->session->userdata('user_id');
		if(isset($_POST['btn_submit'])){
			$insert = array(
				'purchase_paper' => $_POST['purchase_paper'],
				'purchase_text' => $_POST['company_format'],
				'purchase_number' => $_POST['invoice_no'],
				'company_name' => $_POST['organization'],
				'condition_pay' => $_POST['condition_pay'],
				'pay_day' => $_POST['pay_day'],
				'purchase_date' => $_POST['due_date'],
				'company_address_all' => $_POST['address'],
				'company_email' => $_POST['email'],
				'company_tel' => $_POST['telephone'],
				'company_tax_code' => $_POST['tax_id'],
				'quotation_number' => $_POST['reference'],
				'product_option' => $_POST['price_option'],
				'product_total_real' => $_POST['sum_amount'],
				'purchase_note' => $_POST['invoice_note'],
				'product_vat' => $_POST['sum_tax'],
				'product_grand_total' => $_POST['grand_total'],
				'customer_id' => $_POST['customer_option'],
				'write_text' => $_POST['write_text'],
				'user_id' => $user_id
				);
			$this->form_validation->set_rules('product[0]', 'Product', 'callback_check_purchase['.$_POST["customer_option"][0].','.$_POST["price"][0].','.$_POST["quantity"][0].','.$_POST["write_text"].']');
			if ($this->form_validation->run() == FALSE)
			{

			}else{
				$count_product = count($_POST['product']);
				if(isset($_POST['purchase_id']) && trim($_POST['purchase_id']) != ''){
					$id['paper'] = $_POST['purchase_paper'];
					$id['user_id'] = $user_id;
					$this->mol_purchase->updatePurchase($id);
					$insert['purchase_status'] = $_POST['purchase_status'];
					for($i=0; $i<$count_product; $i++){
						$insert['product_company_id'] = $_POST['id'][$i];
						$insert['product_name'] = $_POST['product'][$i];
						$insert['product_price'] = $_POST['price'][$i];
						$insert['product_amount'] = $_POST['quantity'][$i];
						$insert['product_discount'] = $_POST['discount'][$i];
						$insert['product_total'] = $_POST['amount'][$i];
						$this->mol_purchase->insertPurchase($insert);
					}
				}else{
					$insert['purchase_status'] = "เสร็จสิ้น";
					for($i=0; $i<$count_product; $i++){
						$insert['product_company_id'] = $_POST['id'][$i];
						$insert['product_name'] = $_POST['product'][$i];
						$insert['product_price'] = $_POST['price'][$i];
						$insert['product_amount'] = $_POST['quantity'][$i];
						$insert['product_discount'] = $_POST['discount'][$i];
						$insert['product_total'] = $_POST['amount'][$i];
						$this->mol_purchase->insertPurchase($insert);
					}
				}
				redirect('purchase/purchase_display');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('purchase/purchase_display');
		}

		if(isset($_GET['p_id'])){
			$this->load->model('mol_purchase');
			$id['paper'] = $_GET['p_id'];
			$id['user_id'] = $user_id;
			$data['edtPurchase'] = $this->mol_purchase->getPurchase($id);
		}else{
			$data['company'] = $this->mol_purchase->getCompany($user_id);
			$purchase['purchase_paper'] = $this->mol_purchase->checkPurchase($user_id);
			$count = count($purchase['purchase_paper']);
			if(is_null($purchase['purchase_paper'])){
				$data['paper'] = 0;
			}else{
				$data['paper'] = $purchase['purchase_paper'][$count-1]['purchase_paper'];
			}
		}
		$data['customer'] = $this->mol_purchase->getCustomer($user_id);

		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('purchase_add', $data);
	}

	public function check_purchase($name, $data)
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
			$this->form_validation->set_message('check_purchase', 'The Product name field is required.');
			return false;
		}else if($price == ""){
			$this->form_validation->set_message('check_purchase', 'The Price field is required.');
			return false;
		}else if($quantity == ""){
			$this->form_validation->set_message('check_purchase', 'The Quantity field is required.');
			return false;
		}else if($write == ""){
			$this->form_validation->set_message('check_purchase', 'The Write Text field is required.');
			return false;
		}else{
			return true;
		}
	}

	public function change_status()
	{
		$this->load->model('mol_purchase');
		if(isset($_GET['p_id'])){
			$id['user_id'] = $this->session->userdata('user_id');
			$id['purchase_id'] = $_GET['p_id'];
			$this->mol_purchase->chagnePurchaseStatus($id);
			redirect('purchase/purchase_display');
		}
	}
}

?>
