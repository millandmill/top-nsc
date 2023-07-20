<?php defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {
	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		if(isset($_POST['btn_submit']))
		{
			$pass= hash('sha512',$_POST['password']);
			$this->form_validation->set_rules('username', 'Username', 'callback_check_login['.$pass.']');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->sess_destroy();
			}else{
				redirect('company/detail');
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('login');
	}

	public function check_login($user, $pass)
	{
		$this->load->model('mol_welcome');
		if(isset($user) && trim($user != '')){
			$result = $this->mol_welcome->checkLogin($user);
			if($user == $result[0]['username'] && $pass == $result[0]['password']){
				$this->session->set_userdata('user_id', $result[0]['user_id']);
				$this->session->set_userdata('username', $result[0]['username']);
				return true;
			}else{
				$this->form_validation->set_message('check_login', 'Wrong password,Please try again.');
				return false;
			}
		}else{
			$this->form_validation->set_message('check_login', 'The Username field is required.');
			return false;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome/login');
	}

	public function register()
	{
		$this->load->model('mol_welcome');

		if(isset($_POST['btn_submit'])){

			$insert = array(
					'username' => $_POST['username'],
					'password'  => hash('sha512',$_POST['password']),
					'company_email' => $_POST['email']
				);
			$this->form_validation->set_rules('username', 'Username', 'callback_check_register['.$insert["company_email"].']');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == FALSE){

			}else{
				$this->mol_welcome->insertUser($insert);
				redirect('welcome/login');
			}
		}else if(isset($_POST['btn_back'])){
			redirect('welcome/login');
		}

		$this->load->view('template/header/header');
		$this->load->view('register');
	}

	public function check_register($user, $data)
	{
		$data = preg_split('/,/', $data);
	    $email = $data[0];
		$this->load->model('mol_welcome');
		if($user == ""){
			$this->form_validation->set_message('check_register', 'The Username field is required.');
			return false;
		}else if(!preg_match('/[a-zA-Z0-9-]{5,10}/', $user)){
			$this->form_validation->set_message('check_register', 'The Username field must be a-z, A-Z, 0-9, - and 5-10 charactors only.');
			return false;
		}else if($email == ""){
			$this->form_validation->set_message('check_register', 'The Email field is required.');
			return false;
		}else if(!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email)){
			$this->form_validation->set_message('check_register', 'The Email field is mistake.');
			return false;
		}else{
			$result = $this->mol_welcome->checkRegister($user, $email);
			if($result != null){
				$this->form_validation->set_message('check_register', 'The Username or Email field is already.');
				return false;
			}else{
				return true;
			}
		}
	}

	public function changePassword()
	{
		$this->load->model('mol_welcome');
		if(isset($_POST['btn_submit'])){
			$change['password'] = $_POST['newPassword'];
			$this->form_validation->set_rules('username', 'Username', 'callback_check_changePassword['.$change['password'].','.$_POST["password"].']');
			if ($this->form_validation->run() == FALSE){

			}else{
				$change['password'] = hash('sha512', $change['password']);
				$oldPass = hash('sha512', $_POST['password']);
				$user = $_POST['username'];
				$this->mol_welcome->updateNewPass($user, $change, $oldPass);
				redirect('welcome/login');
			}
		}
		$this->load->view('template/header/header');
		$this->load->view('change_user');
	}

	public function check_changePassword($user, $data)
	{
		$data = preg_split('/,/', $data);
	    $nPass = $data[0];
	    $bPass = $data[1];
	    $pass = hash('sha512', $bPass);
		$this->load->model('mol_welcome');
		if($user == ""){
			$this->form_validation->set_message('check_changePassword', 'The Username field is required.');
			return false;
		}else if($pass == ""){
			$this->form_validation->set_message('check_changePassword', 'The Password field is required.');
			return false;
		}else if($nPass == ""){
			$this->form_validation->set_message('check_changePassword', 'The New Password field is required.');
			return false;
		}else{
			$result = $this->mol_welcome->checkChangePassword($user, $pass);
			if($result != null){
				if($user == $result[0]['username'] && $pass == $result[0]['password']){
					return true;
				}else{
					$this->form_validation->set_message('check_changePassword', 'The Username or Password field is wrong.');
					return false;
				}
			}else{
				$this->form_validation->set_message('check_changePassword', 'The Username and Password is wrong.');
				return false;
			}
		}
	}
}

?>