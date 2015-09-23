<?php

class Login extends CI_Controller {

	/**
	 * Login  for HatariCloud clients and Hataricloud users
	 */

	public function index()
	{
		$this->user_login();
	}

	public function user_login()
	{
		if (isset($_POST) && !empty($_POST)){
			//login user
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');
			print $remember;

			if ($this->login_success($email, $password, $remember)) {
				$user = $this->ion_auth->user()->row();
				$user_id = $user->id;
				if ($this->is_hataricloud_user($user_id)) {
					//user belongs to Hataricloud users, get them into the Hataricloud admin dashboard
					redirect('/admin', 'refresh');
				} else {
					//user is simply a client
					redirect('/client', 'refresh');
				}
				
			} else {
				//login unsuccessful, redirect to login page
				$this->view_login();
			}
		} else{
			//show login form 
			$this->view_login();
		}
		
	}//close login 

	public function login_success($email, $password, $remember)
	{
		return $this->ion_auth->login($email, $password, $remember);
	}

	public function is_admin()
	{
		return $this->ion_auth->is_admin();
	}

	public function is_hataricloud_user($user_id)
	{
		$this->load->model('clients_model');
		$client = $this->clients_model->get_user_client($user_id);
		$client_id = $client->id;
		$client_company = strtolower($client->company);
		if ($client_company == "hataricloud") {
			return true;
		} else {
			return false;
		}

	}//close is_hataricloud_user

	public function view_login()
	{
		if($this->ion_auth->logged_in()){
			//logout first 
			$this->logout();
		}
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('login/dash_login');
		$this->load->view('includes/footer');
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('login', 'refresh');
	}

	public function forgot_password()
	{
		if (isset($_POST) && !empty($_POST)){
			//run the forgotten password method to email an activation code to the user
			$email = $this->input->post('email');
			$forgotten = $this->ion_auth->forgotten_password($email);
			if ($forgotten) { //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->data['email'] = $email;
				$this->forgot_password_success($this->data);
			}else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->data['message'] = $this->ion_auth->errors();
				$this->forgot_password_view($this->data);
			}
		}else{
			$this->data['message'] = false;
			$this->forgot_password_view($this->data);
		}
	}

	public function forgot_password_view($d)
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('login/forgot_password', $d);
		$this->load->view('includes/footer');
	}

	public function forgot_password_success($d)
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('login/forgot_pw_success', $d);
		$this->load->view('includes/footer');
	}

}//close login class

?>