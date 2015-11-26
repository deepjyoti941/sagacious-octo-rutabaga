<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('users', '', TRUE);
  }

	private $data = array(
		'pageTitle' => 'Login Page',
		'content' => array(
			'top_navbar' => 'includes/navigation',
			'loginForm' => 'forms/login'
      )
  );

	public function index($data = NULL) {
    $this->data['message'] = $data;
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation'));
    $this->load->view('index', $this->data);
  }

  public function getUsernameList() {
    $userType = $this->input->post('user_type');
    $keyword = $this->input->post('keyword');
    $result = $this->users->getUsernameList($userType, $keyword);
    echo json_encode($result);
  }

  public function do_login() {
    $this->load->library(array('form_validation'));
    $form_rules = array(
      array(

        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required'

        ),array(

        'field' => 'role',
        'label' => 'Role',
        'rules' => 'required'

        ),array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'trim|required'

        )
      );
    $this->form_validation->set_rules($form_rules);
    if ($this->form_validation->run() == FALSE)
      $this->index();
    else {
      //print_r($this->input->post());

      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $userType = $this->input->post('role');
      $result = $this->users->user_login($username, $password, $userType);
      if ($result) {
        $sess_array = array();
        foreach ($result as $row) {
          $sess_array = array(
            'id' => $row->id,
            'username' => $row->username,
            'user_type' => $row->user_type,
            'mobile' => $row->mobile,
            'email' => $row->email
          );
        }
        $this->session->set_userdata('logged_in', $sess_array);

        if ($result[0]->user_type == 1)
          redirect(base_url() . 'report', 'refresh');
        else
          redirect(base_url(), 'refresh');

      } else {
          $data['error'] = 'Invalid username or password';
          $this->index($data);
      }
    }
  }

  public function do_logout() {
    $this->session->unset_userdata('logged_in');
    $data['logout'] = 'You are successfully logout';
    $this->index($data);
  }

}
