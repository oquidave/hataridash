<?php

class Dashclient extends CI_Controller {

	/**
	 * Dashboard elements for HatariCloud clients
	 */

	public function __constructor()
	{
		
	}
	public function home()
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

			//store the user_id and client_id in a session
			$user_details = array(
                   'user_id'  =>  $user_id,
                   'client_id' => $client_id);
			$this->session->set_userdata($user_details);

			//display the details in view
			$this->client_details($this->data);
		}
		
	} //close home

	public function client_details($d)
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_client');
		$this->load->view('client/client_details', $d);
		$this->load->view('includes/footer');
	}

	public function edit_profile()
	{
		$user_id = $this->session->userdata('user_id');
		$client_id = $this->session->userdata('client_id');

		$full_names = $this->input->post('full_names');
		$names = explode(' ', $full_names);
        $first_name = $names[0];
        $last_name = $names[1];
		$company = $this->input->post('company');
		$email = strtolower($this->input->post('email'));
		$phone = $this->input->post('phone');

		$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email,
					'phone' => $phone, 
					'company' => $company
					 );
		$this->ion_auth->update($user_id, $data);
		//change company name in the clients table 
		$client_id = $this->session->userdata('client_id');
		$this->load->model('clients_model');
		$table = "clients";
		$where_id = $client_id;
		$d = array('company' => $company);

		$this->clients_model->update_record($table, $where_id, $d);
		/*header('Content-Type: application/json');
			echo json_encode(
				array('user_id' => $user_id));*/
	}//close edit_profile

	public function chg_pw()
	{
		$old_pw = $this->input->post('old_pw'); #todo check if  current password is correct
		$new_pw = $this->input->post('new_pw');
		$data = array('password' => $new_pw);
		$user_id = $this->session->userdata('user_id');
		$this->ion_auth->update($user_id, $data);
		
	}

	public function support()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_client');
		$this->load->view('client/support');
		$this->load->view('includes/footer');
	}
	
	
}//close class
