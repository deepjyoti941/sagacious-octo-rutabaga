<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect(base_url() . 'login', 'refresh');
    }
  }

	private $data = array(
		'pageTitle' => 'Pathology lab reporting system',
		'content' => array(
			'top_navbar' => 'includes/navigation',
			'main' => 'includes/main'
		)
	);

	public function index() {
    $this->load->view('index', $this->data);
	}

}
