<?php

class Dashclient extends CI_Controller {

	/**
	 * Dashboard elements for HatariCloud clients
	 */

	public function __constructor()
	{
		
	}
	public function index()
	{
		if(!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}else{
			//get current logged in user details
			$user = $this->ion_auth->user()->row();
			$user_id = $user->id;
			$first_name = $user->first_name;
			$last_name = $user->last_name;
			$this->data['full_names'] = $first_name. " ". $last_name;
			$this->data['phone'] = $user->phone;
			$this->data['email'] = $user->email;

			//get client account details 
			$this->load->model('clients_model');
			$client = $this->clients_model->get_user_client($user_id);

			$client_id = $client->id;
			$this->data['client_id'] = $client_id;
			$this->data['company'] = $client->company;
			$this->data['domain'] = $client->domain;
			$this->data['plan'] = $client->plan;
			$this->data['acc_status'] = ($client->acc_status)? "Active": "Inactive";

			//get client invoices
			$this->load->model('clients_model');
			$table = 'invoices'; 
			$field = 'client_id';
			$val = $client_id;
			$invoices = $this->clients_model->get_records($table, $field, $val);
			$this->data['invoices'] = $invoices;

			//display the details in view
			$this->client_details($this->data);
		}
		
	} 

	public function client_details($d)
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_client');
		$this->load->view('client/client_details', $d);
		$this->load->view('includes/footer');
	}

	public function support()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_client');
		$this->load->view('client/support');
		$this->load->view('includes/footer');
	}

	public function login()
	{
		if($this->ion_auth->logged_in()){
			//logout first 
			$this->logout();
		}
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('client/dash_login');
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

	public function forgot_password_view($d){
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('client/forgot_password', $d);
		$this->load->view('includes/footer');
	}

	public function forgot_password_success($d)
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_site');
		$this->load->view('client/forgot_pw_success', $d);
		$this->load->view('includes/footer');
	}

	
	
}//close class
