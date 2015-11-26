<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

  function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
      redirect(base_url() . 'login', 'refresh');
    }
    $this->load->helper(array('form', 'url'));
    $this->load->model('users', '', TRUE);
    $this->load->model('reports', '', TRUE);
    $this->load->library('pdf/fpdf');
    $this->CI = get_instance();
    $this->CI->load->config('mail');
    try {
        require_once APPPATH . "/third_party/PHPMailer/PHPMailerAutoload.php";
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
  }

  private $patientHome = array(
    'pageTitle' => 'Patient Home Page',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/home'
    )
  );

  private $patientReportDetails = array(
    'pageTitle' => 'Patient Report Details',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/report-details'
    )
  );

  private $listPatients = array(
    'pageTitle' => 'Patient List',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/list-patients'
    )
  );

  private $addPatient = array(
    'pageTitle' => 'Add New Patient Details',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/add-patient'
    )
  );

  private $updatePatient = array(
    'pageTitle' => 'Update Patient',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/update-patient'
    )
  );

  private $patientEmailSent = array(
    'pageTitle' => 'Send Report',
    'content' => array(
      'top_navbar' => 'includes/navigation',
      'loginForm' => 'patients/email-sent'
    )
  );

  private function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function index() {
    $this->check_auth();
    $this->listPatients['patients'] = $this->users->list_patients();
    $this->load->view('index', $this->listPatients);
  }

  public function home() {

    // $this->check_patient_auth();
    if ($this->session->userdata('logged_in')) {
        $session_data = $this->session->userdata('logged_in');
        $this->patientHome['reports'] = $this->reports->patient_reports($session_data['id']);
        $data['username'] = $session_data['username'];
        $this->load->view('index', $this->patientHome);
    } else {
        redirect(base_url() . 'login', 'refresh');
    }
  }

  public function add() {
        // $this->check_auth();
    $this->load->view('index', $this->addPatient);
  }

  public function create() {
    $this->load->library(array('form_validation'));
    $form_rules = array(
      array(

        'field' => 'name',
        'label' => 'name',
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

      )
    );
    $this->form_validation->set_rules($form_rules);

    if ($this->form_validation->run() == FALSE)
      $this->add();

    else {
      $patient = array();
      $patient['name'] = $this->input->post('name');
      $patient['username'] = $this->input->post('username');
      $patient['password'] = $this->generateRandomString(8);
      $patient['email'] = $this->input->post('email');
      $patient['mobile'] = $this->input->post('mobile');
      $patient['user_type'] = '2';
      if ($this->users->create_patient($patient)) {
        $this->listPatients['success'] = 'patient added successfully';
        redirect(base_url() . 'patient', 'refresh');
      } else {
        $this->addPatient['error'] = 'user already exist,try with different username and passowrd';
        $this->load->view('index',$this->addPatient );
      }
    }
  }

  public function edit($id) {
    $patient = $this->users->get_patient($id);
    foreach ($patient as $value) {
        $this->updatePatient['patient'] = $value;
    }
    $this->load->view('index', $this->updatePatient);
  }

  public function update($id) {
    $patient = $this->input->post('patient');
    if ($this->users->update_patient($id, $patient))
      redirect(base_url() . 'patient', 'refresh');
    else
      $this->edit();
  }

  public function delete($patient_id) {
    if($this->users->delete_patient($patient_id))
      redirect(base_url() . 'patient', 'refresh');
    else
      $this->index();
  }

  public function view_home_report($report_id) {
    $session_data = $this->session->userdata('logged_in');
    $this->patientReportDetails['report'] = $this->reports->report_details($report_id);
    $this->patientReportDetails['report_id'] = $report_id;
    $this->patientReportDetails['username'] = $session_data['username'];
    $this->load->view('index', $this->patientReportDetails);
  }

  public function print_report($report_id) {
    $header = array('Test Name', 'Value');
    $report = $this->reports->get_report($report_id);
    $date = $report[0]->created_at;
    $data = $this->reports->report_details($report_id);
    $user = $this->users->get_user_of_report($report_id);
    $report_name_and_value = array();
    foreach ($data as $value) {
      $report_name_and_value[] = array('test_name' => $value->test_name, 'test_value' => $value->test_value);
    }
    $name = $user[0]->username;
    $phone = $user[0]->mobile;
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(60, 10, 'Patient Name: ' . $name, 0, 1);
    $pdf->Cell(60, 10, 'Phone: ' . $phone, 0, 1);
    $pdf->Cell(60, 10, 'Date: ' . $date, 0, 1);
    $pdf->Cell(60, 10, 'Report Detail:', 0, 1);
    foreach ($header as $col) {
      $pdf->Cell(40, 7, $col, 1);
    }
    $pdf->Ln();
    // Data
    foreach ($report_name_and_value as $row) {
      foreach ($row as $col)
        $pdf->Cell(40, 6, $col, 1);
        $pdf->Ln();
    }

    $pdf->Output();
  }

  function email_report($report_id) {
    $session_data = $this->session->userdata('logged_in');
    $data['username'] = $session_data['username'];
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $this->config->item('username');
    $mail->Password = $this->config->item('password');
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->From = $this->config->item('from_email');
    $mail->FromName = $this->config->item('from_name');
    $mail->addAddress($session_data['email'], $session_data['username']);
    $mail->isHTML(true);

    $mail->Subject = 'Lab Report';
    $mail->Body = $this->mail_body($report_id);

    if (!$mail->send()) {
      $this->patientEmailSent['email_message'] = $mail->ErrorInfo;
      $this->patientEmailSent['report_id'] = $report_id;
      $this->load->view('index', $this->patientEmailSent);
    } else {
      $this->patientEmailSent['email_message'] = 'Report Sent to your email account.';
      $this->patientEmailSent['report_id'] = $report_id;
      $this->load->view('index', $this->patientEmailSent);
    }
  }

  function mail_body($report_id) {
    $session_data = $this->session->userdata('logged_in');
    $report = $this->reports->get_report($report_id);
    $report_detail = $this->reports->report_details($report_id);
    $mail_body = '<div>Patient Name: ' . $session_data['username'] . '</div><br/><div>Phone:' . $session_data['mobile'] . '</div><br/>';
    $mail_body .= '<div>Date:' . $report[0]->created_at . '</div><br/>';
    $mail_body .= '<table style="width:100%; border: 1px solid black; text-align: center;"><tr style="width:100%; border: 1px solid black; text-align: center;"><th style="border: 1px solid black; text-align: center;">Test Name</th><th style=" border: 1px solid black; text-align: center;">Value</th></tr>';
    foreach ($report_detail as $value) {
        $mail_body .= '<tr style="border: 1px solid black; text-align: center;"><td style="border: 1px solid black; text-align: center;">' . $value->test_name . '</td><td style="border: 1px solid black; text-align: center;">' . $value->test_value . '</td></tr>';
    }
    $mail_body .= '</table> <br/>';
    $mail_body .= '<div><a href="' . base_url() . 'patient/print_report/' . $report_id . '">Download Report</a></div>';
    return $mail_body;
  }

  function forbidden() {
    $this->load->view('errors/html/forbidden');
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
}
