<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function check_user() {

	}

  function user_login($username, $password, $user_type) {
    if($user_type == 1)
      $password = hash('md5', $password);
    $this->db->select('id, username, email, mobile, user_type');
    $this->db->from('users');
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $this->db->where('user_type', $user_type);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  /**
   * admin model methods: start
   */
  function list_admins() {
    $this->db->select('name, username, email, mobile');
    $query = $this->db->get_where('users', array('user_type' => '1')); //type 2 is for patients
    return $query->result();
  }

	public function create_admin($user = array()) {

		$new_admin_insert_data = array(
			'name' => $user['name'],
			'email' => $user['email'],
			'username' => $user['username'],
			'password' => hash('md5', $user['password']),
      'mobile' => $user['mobile'],
      'user_type' => 1
		);

		$insert = $this->db->insert('users', $new_admin_insert_data);
		return $insert;
	}

  /**
   * admin model methods: end
   */


  /**
   * patient model methods: start
   */
  public function list_patients() {
    $query = $this->db->get_where('users', array('user_type' => '2')); //type 2 is for patients
    return $query->result();
  }

  public  function create_patient($patient) {
    $insert = $this->db->insert('users', $patient);;
    return $insert;
  }

  public function get_patient($id) {
    $query = $this->db->get_where('users', array('id' => $id));
    return $query->result();
  }

  public function update_patient($id, $patient) {
    $this->db->where('id', $id);
    $result = $this->db->update('users', $patient);
    return $result;
  }

  public function delete_patient($patient_id) {
    $query = $this->db->get_where('reports', array('patient_id' => $patient_id));
    foreach ($query->result() as $value) {
      $this->db->delete('report_details', array('report_id' => $value->id));
      $this->db->delete('reports', array('id' => $value->id));
    }
    $this->db->delete('users', array('id' => $patient_id));
  }

  public function get_user_of_report($report_id) {
    $report_query = $this->db->get_where('reports', array('id' => $report_id));
    $result = $report_query->result();
    $user_query = $this->db->get_where('users', array('id' => $result[0]->patient_id));
    return $user_query->result();

  }

  public function getUsernameList($userType, $keyword) {
    $query  = $this->db->select('id, username')
              ->from(' users')
              ->like("username", $keyword)
              ->where("user_type", $userType)
              ->get();
    return $query->result_array();

  }

  /**
   * patient model methods: end
   */

	/**
	 * returns true if username exists in db
	 * @param  [str] $username
	 * @return [bool]
	 */
	public function username_exists($username) {
		$this->db->select('*');
		$this->db-> from('users');
		$this->db->where('username', $username);
		$result = $this->db->get();

		if ($result->num_rows() == 1)
			return true;

		return false;
	}

}
