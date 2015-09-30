<?php
class Clients_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	//=============================
	//insert client records 
	//=============================
	public function add_client($company, $domain, $plan, $acc_status, $created_on){
		$data = array(
			'company' => $company,
			'domain' => $domain,
			'plan' => $plan, 
			'acc_status' => $acc_status,
			'created_on' => $created_on
			);
		$this->db->insert('clients', $data);
		return $this->db->insert_id();
	} //close add_cient

	public function add_invoice($client_id, $domain, $plan, $amount, $paid_by, $date_paid)
	{
		$data = array(
			'client_id' => $client_id,
			'domain' => $domain,
			'plan' => $plan, 
			'amount' => $amount,
			'paid_by' => $paid_by,
			'date_paid' => $date_paid
			);
		$this->db->insert('invoices', $data);
		return $this->db->insert_id();
	}//close add_invoice

	//=============================
	//get client records 
	//=============================
	public function get_all_clients()
	{
		$q = $this->db->get('clients');
		return $q->result();
	}

	public function get_client($client_id)
	{
		$q = $this->db->get_where('clients', array('id'=>$client_id));
		$res = $q->result();
		return $res[0];
	}

	public function get_user_client($user_id)
	{
		$s = "
			select clients.id, clients.company, clients.domain, clients.plan, clients.acc_status 
			from clients inner join client_users 
			on clients.id=client_users.client_id
			where user_id=". $user_id;
		$q = $this->db->query($s);
		$res = $q->result();
		return $res[0]; //#fix user can only belong to one company or client for now
	}

	public function get_client_invoices($client_id)
	{
		$q = $this->db->get_where('invoices', array('client_id'=>$client_id));
		return $q->result();
	}

	public function get_client_users($client_id)
	{
		$s = "
		select * from users
		inner join client_users
		on users.id=client_users.user_id
		where client_users.client_id=$client_id
		";
		$q = $this->db->query($s);
		return $q->result();
	}

	public function insert_record($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function get_records($table, $field, $val)
	{
		$q = $this->db->get_where($table, array($field=>$val));
		return $q->result();
	}


	public function update_record($table, $field, $val, $data)
	{
		$this->db->where($field, $val);
		$this->db->update($table, $data);
	}//close update_record

	public function delete_record($table, $field, $val)
	{
		$this->db->where($field, $val); 
		$this->db->delete($table);

	}//close delete_record


}//close class
?>