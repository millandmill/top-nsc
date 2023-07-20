<?php defined('BASEPATH') OR exit('No direct script access allowed');

class exportTxt extends CI_Controller {

	public function exportTxt_sell()
	{
		$this->load->model('mol_exportTxt');
		$export['user_id'] = $this->session->userdata('user_id');
		$data['company'] = $this->mol_exportTxt->getCompany($export);
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('report_sell', $data);
	}

	public function export_txt_sell()
	{
		if(isset($_GET['price_all']) && isset($_GET['price_vat'])){
			$this->load->model('mol_exportTxt');
			$price_all = $_GET['price_all'];
			$price_vat = $_GET['price_vat'];
			$id['user_id'] = $_GET['user_id'];
			$dateStart = $_GET['dateStart'];
			$start = date("m", strtotime($dateStart));
			$year = date("Y", strtotime($dateStart));
			$year = $year+543;
			$value = $this->mol_exportTxt->getValueForExport($id);
			if(isset($price_vat)){
				if($price_vat == 0){
					$price_vat = '0.00';
					$vat = '0.00';
				}else{
					$vat = $price_vat*7/100;
					$price_vat = number_format((float)$price_vat, 2, '.', '');
					$vat = number_format((float)$vat, 2, '.', '');
				}
			}
			if(isset($value)){
				if(isset($value[0]['company_tax_code'])){
					$tax = $value[0]['company_tax_code'];
				}
				if(isset($value[0]['profile_before_name'])){
					if($value[0]['profile_before_name'] == "ไม่ใส่"){
						$before_name = "|";
					}else{
						$before_name = $value[0]['profile_before_name'];
					}
				}
				if(isset($value[0]['profile_fname'])){
					$fname = $value[0]['profile_fname'];
				}
				if(isset($value[0]['profile_lname'])){
					if($value[0]['profile_lname'] == ""){
						$lname = "|";
					}else{
						$lname = $value[0]['profile_lname'];
					}
				}
				if(isset($value[0]['profile_address'])){
					if($value[0]['profile_address'] == ""){
						$address = "|";
					}else{
						$address = $value[0]['profile_address'];
					}
				}
				if(isset($value[0]['profile_postcost'])){
					$postcost = $value[0]['profile_postcost'];
				}
				if(isset($value[0]['profile_man_tax'])){
					if($value[0]['profile_man_tax'] == ""){
						$man_tax = "0000000000";
					}else{
						$man_tax = $value[0]['profile_man_tax'];
					}
				}
				if(isset($value[0]['profile_branch'])){
					if($value[0]['profile_branch'] == ""){
						$branch = "0000";
					}else{
						$branch = $value[0]['profile_branch'];
					}
				}
				if(isset($value[0]['profile_iden'])){
					$iden = $value[0]['profile_iden'];
				}
				if(isset($value[0]['profile_iden_money'])){
					if($value[0]['profile_iden_money'] == ""){
						$iden_money = "0000000000";
					}else{
						$iden_money = $value[0]['profile_iden_money'];
					}
				}
				if(isset($value[0]['profile_money_id'])){
					if($value[0]['profile_money_id'] == "40(1)"){
						$money_id = "1";
					}else if($value[0]['profile_money_id'] == "40(2)ร้อยละ 3"){
						$money_id = "2";
					}else if($value[0]['profile_money_id'] == "40(1)(2) ออกจากงาน"){
						$money_id = "3";
					}else if($value[0]['profile_money_id'] == "40(2) ผู้รับอยู่ในประเทศไทย"){
						$money_id = "4";
					}else if($value[0]['profile_money_id'] == "40(2) ผู้รับไม่อยู่ในประเทศไทย"){
						$money_id = "5";
					}
				}
				if(isset($value[0]['profile_money_date'])){
					$date = $value[0]['profile_money_date'];
					$one_day = date("d", strtotime($date));
					$one_mouth = date("m", strtotime($date));
					$one_year = date("Y", strtotime($date));
					$one_year = $one_year+543;
					$date = $one_day.$one_mouth.$one_year;
				}
				if(isset($value[0]['profile_condition_id'])){
					if($value[0]['profile_condition_id'] == "หัก ณ ที่จ่าย"){
						$con_id = "1";
					}else if($value[0]['profile_condition_id'] == "ออกตลอดไป"){
						$con_id = "2";
					}else if($value[0]['profile_condition_id'] == "ออกให้ครั้งเดียว"){
						$con_id = "3";
					}
				}
				$this->load->helper('download');
				$data = '00|'.$tax.'|'.$man_tax.'|'.$branch.'|'.$iden.'|'.$iden_money.'|'.$before_name.'|'.$fname.'|'.$lname.'|'.$address.'|||'.$postcost.'|'.$start.'|'.$year.'|'
				.$money_id.'|'.$date.'|7'.'|'.$price_vat.'|'.$vat.'|'.$con_id;
				$name = 'PND1.txt';
				force_download($name, $data);
			}else{
				$chk_company = $this->mol_exportTxt->getCompany($id);
				if(!isset($chk_company)){
					redirect('company/detail');
				}else{
					redirect('exportTxt/profile_display');
				}
			}
		}
	}

	public function exportTxt_buy()
	{
		$this->load->model('mol_exportTxt');
		$export['user_id'] = $this->session->userdata('user_id');
		$data['company'] = $this->mol_exportTxt->getCompany($export);
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('report_buy', $data);
	}

	public function calculate_sell()
	{
		if (array_key_exists('ds', $_POST) && array_key_exists('de', $_POST)) {
			$this->load->model('mol_exportTxt');
			$data['blank'] = '';
			$data['user_id'] = $this->session->userdata('user_id');
		    $data['dateStart'] = $_POST['ds'];
		    $data['dateEnd'] = $_POST['de'];
		    if($data['dateStart'] != "" && $data['dateEnd'] != ""){
		    	$data['export_sell'] = $this->mol_exportTxt->check_report($data);
		    }
			$this->load->view('showData', $data);
		}
	}

	public function calculate_buy()
	{
		if (array_key_exists('ds', $_POST) && array_key_exists('de', $_POST)) {
			$this->load->model('mol_exportTxt');
			$data['blank'] = '';
			$data['user_id'] = $this->session->userdata('user_id');
		    $data['dateStart'] = $_POST['ds'];
		    $data['dateEnd'] = $_POST['de'];
		    if($data['dateStart'] != "" && $data['dateEnd'] != ""){
		    	$data['export_buy'] = $this->mol_exportTxt->check_reportBuy($data);
		    }
			$this->load->view('showData_buy', $data);
		}
	}

	public function profile_display()
	{
		$this->load->model('mol_profile');
		$id['user_id'] = $this->session->userdata('user_id');
		$data['profile'] = $this->mol_profile->getProfile($id);
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('profile_detail', $data);
	}

	public function profile_add()
	{
		$this->load->model('mol_profile');
		$data['blank'] = '';
		$id['user_id'] = $this->session->userdata('user_id');
		if(isset($_POST['btn_submit'])){
			$insert = array(
					'profile_before_name' => $_POST['before_name'],
					'profile_fname' => $_POST['fname'],
					'profile_lname' => $_POST['lname'],
					'profile_address' => $_POST['address'],
					'profile_postcost' => $_POST['postcost'],
					'profile_man_tax' => $_POST['id_man_tax'],
					'profile_branch' => $_POST['number_branch'],
					'profile_iden' => $_POST['id_iden'],
					'profile_iden_money' => $_POST['id_iden_money'],
					'profile_money_id' => $_POST['money_id'],
					'profile_money_date' => $_POST['money_date'],
					'profile_condition_id' => $_POST['condition_id'],
					'user_id' => $id['user_id']
				);
			$this->form_validation->set_rules('fname', 'First name', 'callback_check_profile['.$insert["profile_postcost"].','.$insert["profile_iden"].','.$insert["profile_money_id"].','
				.$insert["profile_money_date"].','.$insert["profile_condition_id"].']');
			if($this->form_validation->run() == FALSE){

			}else{
				if(isset($_POST['profile_id']) && trim($_POST['profile_id']) != ''){
	                    $insert['profile_id'] = $_POST['profile_id'];
	                    $this->mol_profile->updateProfile($insert);
	            }else{
	                    $this->mol_profile->insertProfile($insert);
	            }
	            redirect('exportTxt/profile_display');
			}
		}

		if(isset($_GET['p_id'])){
			$id['profile_id'] = $_GET['p_id'];
			$data['profile_edit'] = $this->mol_profile->getProfile($id);
		}
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('add_profile', $data);
	}

	public function check_profile($name, $data)
	{
		$data = preg_split('/,/', $data);
	    $postcost = $data[0];
	    $iden = $data[1];
	    $money_id = $data[2];
	    $money_date = $data[3];
	    $con_id = $data[4];

		if($name == ""){
			$this->form_validation->set_message('check_profile', 'The First name field is required.');
			return false;
		}else if($postcost == ""){
			$this->form_validation->set_message('check_profile', 'The Zip Code field is required.');
			return false;
		}else if($iden == ""){
			$this->form_validation->set_message('check_profile', 'The Identity field is required.');
			return false;
		}else if($money_id == "ไม่ใส่"){
			$this->form_validation->set_message('check_profile', 'The Money ID field is required.');
			return false;
		}else if($money_date == ""){
			$this->form_validation->set_message('check_profile', 'The Money Date field is required.');
			return false;
		}else if($con_id == "ไม่ใส่"){
			$this->form_validation->set_message('check_profile', 'The Condition field is required.');
			return false;
		}else{
			return true;
		}
	}

}

?>