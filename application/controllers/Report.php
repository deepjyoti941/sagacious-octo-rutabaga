<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

  function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect(base_url() . 'login', 'refresh');
    }
    $this->load->model('reports', '', TRUE);
    $this->load->model('users', '', TRUE);
  }

  private $listReports = array(
    'pageTitle' => 'List Reports',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'reports/list-reports'
    )
  );

  private $viewReport = array(
    'pageTitle' => 'View Report',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'reports/view-report'
    )
  );

  private $addReport = array(
    'pageTitle' => 'Add New Report',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'reports/add-report'
    )
  );

  private $editReport = array(
    'pageTitle' => 'Edit Existing Report',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'reports/edit-report'
    )
  );
  public function index() {
    $this->listReports['reports'] = $this->reports->all();
    $this->load->view('index', $this->listReports);
  }

  public function view($patient_id) {
    $this->listReports['reports'] = $this->reports->patient_reports($patient_id);
    $patient = $this->users->get_patient($patient_id);
    $this->listReports['patient'] = $patient[0];
    $this->load->view('index', $this->listReports);
  }

  public function view_report($report_id) {
    $this->viewReport['report_id'] = $report_id;
    $this->viewReport['report'] = $this->reports->report_details($report_id);
    $this->load->view('index', $this->viewReport);
  }

  public function add($patient_id) {
    $this->addReport['patient_id'] = $patient_id;
    $this->load->view('index', $this->addReport);
  }


  public function create($patient_id) {
    $results = $this->input->post('test');
    $report_details = array();
    try {
      $report = $this->reports->create($patient_id, date("Y-m-d h:i:sa"));
    } catch (Exception $exc) {
      echo $exc->getTraceAsString();
    }
    foreach ($results as $key => $value) {
      $report_details[] = array('report_id' => $report['id'], 'test_name' => $results[$key]['name'], 'test_value' => $results[$key]['measurement']);
    }
    $inser_report_details = $this->reports->insert_details($report_details);
    redirect(base_url() . 'report', 'refresh');
  }

  public function edit($report_id) {
    $this->editReport['report'] = $this->reports->report_details($report_id);
    $this->editReport['report_id'] = $report_id;
    $this->load->view('index', $this->editReport);
  }

  function update($report_id) {
    $data = $this->input->post('test');
    foreach ($data as $key => $value) {
        $this->reports->update($key, $value);
    }
    redirect(base_url() . 'report/view_report/'.$report_id, 'refresh');
  }

  function delete($report_id) {
    $this->reports->delete($report_id);
    redirect(base_url() . 'report', 'refresh');
  }
}
