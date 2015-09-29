<?php

class Dashadmin extends CI_Controller {

	/**
	 * Dashboard elements for HatariCloud clients
	 */

	public function __constructor()
	{

	}

	public function home()
	{	
		//check if user is logged in
		if(!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}else{
			$this->load->model('clients_model');
			$clients = $this->clients_model->get_all_clients();
			
			$this->data['clients'] = $clients;

			$this->view_all_accs($this->data);
		}
	}//close home

	public function view_all_accs($d)
	{	
		$this->load->view('includes/header');
		$this->load->view('includes/nav_admin');
		$this->load->view('admin/all_client_accs', $d);
		$this->load->view('includes/footer');
	
	} 

	public function view_acc()
	{
		$client_id = $this->uri->segment(3);
		$this->load->model('clients_model');
		$client_details = $this->clients_model->get_client($client_id);
		//#fix getting one user for now
		$client_admin_user = $this->clients_model->get_client_users($client_id); 
		$client_invoices = $this->clients_model->get_client_invoices($client_id);

		$this->data['client'] = $client_details;
		$this->data['client_admin_user'] = $client_admin_user[0];
		$this->data['client_invoices'] = $client_invoices;

		//for html
		$gui_acc_options = array();
		if ($client_details->acc_status) {
			$gui_acc_options = array('status' => 'active', 
									'actions' => array(
											'act1' =>'renew', 
											'act2' => 'deactivate'));
		}else{
			$gui_acc_options = array('status' => 'inactive', 
									'actions' => array(
														'act1' =>'activate', 
														'act2' => 'delete'));
		}
		$this->data['gui_acc_options'] = $gui_acc_options;

		$this->view_acc_show($this->data);

	}//close view_acc

	public function view_acc_show($d)
	{

		$this->load->view('includes/header');
		$this->load->view('includes/nav_admin', $d);
		$this->load->view('admin/client_acc');
		$this->load->view('includes/footer');
	}//close view_acc_show

	public function add_acc()
	{
		$this->data['title'] = 'Add client account';
		if (isset($_POST) && !empty($_POST)){
			//process the form
			//Don't print anything bse we're return json data
			$full_names = $this->input->post('full_names');
			$company = $this->input->post('company');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$password = $this->input->post('password');

			$domain = $this->input->post('domain');
			$plan = $this->input->post('plan');
			$acc_status = $this->input->post('acc_status');
			$amount = $this->input->post('amount');
			$date = $this->input->post('date');

			//register this user
			$email    = strtolower($email);
            $identity = $email;
            $password = $this->input->post('password');

            $names = explode(' ', $full_names);
            $first_name = $names[0];
            $last_name = $names[1];
            $additional_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'company'    => $company,
                'phone'      => $phone,
            );
			
			$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data);

			//register this client 
			$created_on = "2015-09-19 12:59:44";
			$this->load->model('clients_model');
			$client_id = $this->clients_model->add_client($company, $domain, 
				$plan, $acc_status, $created_on);

			//add an invoice
			$paid_by = 1; //#fix get id of logged user
			$date_paid  = "2015-09-19 12:59:44";
			$this->add_invoice($client_id, $domain, $plan, $amount, $paid_by, $date_paid);
			//redirect can't work with ajax call

			//insert client id and user id to the clients_users table 
			$table = "client_users";
			$data = array('user_id' => $user_id,
			 				'client_id' => $client_id);
			$this->clients_model->insert_record($table, $data);

			//return a json object of the the newly created client id
			header('Content-Type: application/json');
			echo json_encode(
				array('client_id' => $client_id));
		}else{
			//display the form
			$this->load->view('includes/header');
			$this->load->view('includes/nav_admin');
			$this->load->view('admin/add_acc');
			$this->load->view('includes/footer'); 
		}
		
	} //close add_client()

	public function add_invoice($client_id, $domain, $plan, 
		$amount, $paid_by, $date_paid)
	{
		
		$this->load->model('clients_model');
		$this->clients_model->add_invoice($client_id, $domain, $plan,
			$amount, $paid_by, $date_paid);

	}//close add_invoice()

	public function client_mgt()
	{
		$action = $this->uri->segment(3);
		$client_id = $this->uri->segment(4);
		switch ($action) {
			case 'act_acc':
				$do = "activate";
				$this->change_status($client_id, $do);
				$redirect_url = "/admin/view_acc/". $client_id;
				redirect($redirect_url, 'refresh');
				break;

			case 'de_act_acc':
				$do = "de_activate";
				$this->change_status($client_id, $do);
				$redirect_url = "/admin/view_acc/". $client_id;
				redirect($redirect_url, 'refresh');
				break;
			case 'del_acc':
				$this->del_acc($client_id);
				$redirect_url = "/admin/";
				redirect($redirect_url, 'refresh');
				break;
			case 'renew_acc':
				$this->renew_acc($client_id);
				break;
			
			default:
				# code...
				break;
		}


	}//close client_mgt

	public function renew_acc($client_id)
	{
		if (isset($_POST) && !empty($_POST)){
			//process the form
			$client = $this->session->userdata('client');

			//add an invoice
			$client_id = $client->id;
			$domain = $client->domain;
			$plan = $this->input->post('plan');
			$amount = $this->input->post('amount');
			$date_paid  = $this->input->post('date');
			$paid_by = 1; //#fix add id of current user
			
			
			$this->add_invoice($client_id, $domain, $plan, $amount, $paid_by, $date_paid);
			//unset session data
			$this->session->unset_userdata('client');
			$redirect_url = "/admin/view_acc/". $client_id;
			redirect($redirect_url, 'refresh');
		}else{
			//show the form, but first get details of this client and autofill form
			$this->load->model('clients_model');
			$client = $this->clients_model->get_client($client_id);
			$this->session->set_userdata('client', $client);

			$this->data['client_id'] = $client->id;
			$this->data['company'] = $client->company;
			$this->data['domain'] = $client->domain;
			$this->data['plan'] = $client->plan;

			$this->load->view('includes/header');
			$this->load->view('includes/nav_admin');
			$this->load->view('admin/renew_acc', $this->data);
			$this->load->view('includes/footer');
		}
		
	}
	public function invoice()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_admin');
		$this->load->view('admin/invoice');
		$this->load->view('includes/footer');
	}

	public function change_status($client_id, $action)
	{
		$this->load->model('clients_model');
		if ($action == "activate") {
			if ($this->is_active_acc($client_id)) {
				return false;
			}
			#make this account status active
			$table = "clients";
			$where_id = $client_id;
			$d = array('acc_status' => true);

			$this->clients_model->update_record($table, $where_id, $d);
			return true;

		} else if ($action == "de_activate") {
			if ($this->is_active_acc($client_id)) {
				# deactivate this client account
				$table = "clients";
				$where_id = $client_id;
				$d = array('acc_status' => false);
				$this->clients_model->update_record($table, $where_id, $d);
				return true;
			}

			return false;
		}
		
	}//close change_status

	public function is_active_acc($client_id)
	{
		$this->load->model('clients_model');
		$client = $this->clients_model->get_client($client_id);
		$acc_status = $client->acc_status;
		if ($acc_status) {
			echo $acc_status;
			return true;
		}
		return false;
	}//close is_active_acc

	public function del_acc($client_id)
	{
		//#fix when you delete an account, delete associated users too 
		//like $this->ion_auth->delete_user($id)
		$id= $client_id;
		$table = 'clients';
		$this->load->model('clients_model');
		$client = $this->clients_model->delete_record($id, $table);
	}

	public function support()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/nav_admin');
		$this->load->view('admin/support_admin');
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
		$this->load->view('admin/dash_login_admin');
		$this->load->view('includes/footer');
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('login', 'refresh');
	}

	
	
}//close class
