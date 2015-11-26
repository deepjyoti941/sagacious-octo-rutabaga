<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

  function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect(base_url() . 'login', 'refresh');
    }
    $this->check_auth();
    $this->load->model('users', '', TRUE);
  }
  private $listView = array(
    'pageTitle' => 'Admin listing and create',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'admins/list'
      )
   );
  private $createView = array(
    'pageTitle' => 'Add New Admin',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'admins/create'
      )
   );

  public function index() {
    $this->load->helper(array('form', 'url'));
    $this->listView['admins'] = $this->users->list_admins();
    $this->load->view('index', $this->listView);
  }

  public function add() {
    $this->load->helper(array('form', 'url'));
    $this->load->view('index', $this->createView);
  }

  public function create() {
    $this->load->library(array('form_validation'));
    $form_rules = array(
      array(

        'field' => 'name',
        'label' => 'Full Name',
        'rules' => 'trim|required'

      ),array(
        'field' => 'email',
        'label' => 'Email Address',
        'rules' => 'trim|required|valid_email'

      ),array(

        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required|min_length[4]|callback_check_username'

      ),array(

        'field' => 'mobile',
        'label' => 'Mobile',
        'rules' => 'trim|required|min_length[10]'

      ),array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'trim|required'

      )
    );
    $this->form_validation->set_rules($form_rules);

    if ($this->form_validation->run() == FALSE)
      $this->add();

    else {
      $admin = array();
      $admin['name'] = $this->input->post('name');
      $admin['username'] = $this->input->post('username');
      $admin['password'] = $this->input->post('password');
      $admin['email'] = $this->input->post('email');
      $admin['mobile'] = $this->input->post('mobile');
      if ($this->users->create_admin($admin)) {
        $data['success'] = 'admin created successfully';
        $this->load->view('errors/html/status_message',$data );
      } else {
          $data['error'] = 'user already exist,try with different username and passowrd';
          $this->load->view('errors/html/status_message',$data );
      }

    }
  }

  public function check_username($username) {
    $this->load->model('users');

    /**
     * when user does not exist
     */
    if ( ! $this->users->username_exists($username) )
      return true;

    $this->form_validation->set_message('check_username', "Username exists");
    return false;
  }

  function check_auth() {
    if ($this->session->userdata('logged_in')) {
      $session_data = $this->session->userdata('logged_in');
      if ($session_data['user_type'] == '2') {
        redirect(base_url() . 'patient/forbidden', 'refresh');
      }
    } else {
      redirect(base_url() . 'login', 'refresh');
    }
  }
}
