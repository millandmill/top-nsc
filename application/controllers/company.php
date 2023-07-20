<?php defined('BASEPATH') OR exit('No direct script access allowed');

class company extends CI_Controller {

	public function detail()
	{
		$this->load->model('mol_company');
		$id['user_id'] = $this->session->userdata('user_id');
		$data['company'] = $this->mol_company->getCompany($id);

		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('company_detail', $data);//2
	}

	public function add_company()
	{
		$this->load->model('mol_company');
		//config image.
		$config['upload_path'] = './uploads/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';                        //2048KB

		$this->load->library('upload', $config);

		$data['blank'] = "";
		if(isset($_POST['btn_submit'])){
			$insert = array(
					'company_name' => $_POST['name'],
					'company_address' => $_POST['address'],
					'company_district' => $_POST['district'],
					'company_county' => $_POST['county'],
					'company_road' => $_POST['road'],
					'company_building' => $_POST['building'],
					'company_floor' => $_POST['floor'],
					'company_province' => $_POST['sltprovince'],
					'company_zip' => $_POST['zip'],
					'company_tel' => $_POST['tel'],
					'company_fax' => $_POST['fax'],
					'company_tax_code' => $_POST['tax'],
                    'company_logo' => '',
					'user_id' => $this->session->userdata('user_id')
				);

			$this->form_validation->set_rules('name', 'Company name', 'callback_check_company['.$insert["company_address"].','.$insert["company_district"].','.$insert["company_county"].','
				.$insert["company_province"].','.$insert["company_zip"].','.$insert["company_tel"].','.$insert["company_fax"].','.$insert["company_tax_code"].','.'image'.']');
			if($this->form_validation->run() == FALSE){
                            //error.
							//echo "TOP FALSE";die();
			}else{
	            //upload file image.
	            if($this->upload->do_upload('image')) {
	                $data = array('upload_data' => $this->upload->data());
	                $file_name = $data['upload_data']['file_name'];
	                $insert['company_logo'] = $file_name;
	            }
	            
	            if(isset($_POST['company_id']) && trim($_POST['company_id']) != ''){
	                    $insert['company_id'] = $_POST['company_id'];
	                    $company_id = $this->mol_company->updateCompany($insert);
	            }else{
	                    $company_id = $this->mol_company->insertCompany($insert);
	                    //$this->session->set_userdata('company_id', $company_id);
	            }
	            redirect('company/detail');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('company/detail');
		}
		if(isset($_GET['c_id'])){
			$id['company_id'] = $_GET['c_id'];
			$data['company_edit'] = $this->mol_company->getCompany($id);
		}
		$data['forProvince'] = $this->mol_company->getProvince();
		$this->load->view('template/header/header');
		$this->load->view('template/menuleft/menuleft');
		$this->load->view('company_add', $data);
	}

	public function check_company($name, $data)
	{
		$data = preg_split('/,/', $data);
	    $address = $data[0];
	    $district = $data[1];
	    $county = $data[2];
	    $province = $data[3];
	    $zip = $data[4];
	    $tel = $data[5];
	    $fax = $data[6];
	    $tax = $data[7];
	    $image = $data[8];
	    //$logo = $data[8];
            
		$this->load->model('mol_company');

		if($name == ""){
			$this->form_validation->set_message('check_company', 'The Company name field is required.');
			return false;
		}else if($address == ""){
			$this->form_validation->set_message('check_company', 'The Address field is required.');
			return false;
		}else if($district == ""){
			$this->form_validation->set_message('check_company', 'The District field is required.');
			return false;
		}else if($county == ""){
			$this->form_validation->set_message('check_company', 'The County field is required.');
			return false;
		}else if($province == ""){
			$this->form_validation->set_message('check_company', 'The Province field is required.');
			return false;
		}else if($zip == ""){
			$this->form_validation->set_message('check_company', 'The Zip field is required.');
			return false;
		}else if($tel == ""){
			$this->form_validation->set_message('check_company', 'The Telephone number field is required.');
			return false;
		}else if($tax == ""){
			$this->form_validation->set_message('check_company', 'The Tax ID field is required.');
			return false;
		}else if(!preg_match('/[0-9]{5}/', $zip)){
			$this->form_validation->set_message('check_company', 'The Zip field must be number and 5 characters only.');
			return false;
		}else if(!preg_match('/[0-9]{13}/', $tax)){
			$this->form_validation->set_message('check_company', 'The Tax ID must be number and 13 characters only.');
			return false;
		}else{
			//check upload image.
			if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
		    	if($this->upload->do_upload('image')) {
			        // set a $_POST value for 'image' that we can use later
			        $upload_data = $this->upload->data();
			        $_POST['image'] = $upload_data['file_name'];
			        return true;
		      	}else if($_FILES['image']['type'] !== "image/jpeg" || $_FILES['image']['type'] !== "image/png") {
		      		$this->form_validation->set_message('check_company', "You must upload an image only.");
		      		return false;
		      	}else{
			        // possibly do some clean up ... then throw an error
			        $this->form_validation->set_message('check_company', 'Size of image more than 2 MB.');
			        return false;
		      	}
		    }else if(!isset($_FILES['image'])){
			    // throw an error because nothing was uploaded
			    $this->form_validation->set_message('check_company', "Image file error.");
			    return false;
		    }

			if(isset($_POST['company_id']) && trim($_POST['company_id']) != ''){
				return true;
			}
			$check = $this->mol_company->checkCompany($this->session->userdata('user_id'));
			if($check != null){
				$this->form_validation->set_message('check_company', 'Your company is already.');
				return false;
			}else{
				return true;
			}
		}
	}
}

?>
