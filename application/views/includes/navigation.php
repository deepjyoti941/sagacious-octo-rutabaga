<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $session_data = $this->session->userdata('logged_in');
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>">Pathology Lab</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php if($this->session->userdata('logged_in') && $session_data['user_type'] == 1):?>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Patients <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li <?php if ( '/'.$this->uri->uri_string() == '/patient'): ?> class="active"<?php endif; ?>><a href="<?php echo base_url() ?>patient">Patient List</a></li>
            <li <?php if ( '/'.$this->uri->uri_string() == '/patient/add'): ?> class="active"<?php endif; ?>><a href="<?php echo base_url() ?>patient/add">Add Patient</a></li>
          </ul>
        </li>
        <li <?php if ( '/'.$this->uri->uri_string() == '/report'): ?> class="active"<?php endif; ?>><a href="<?php echo base_url() ?>report">Reports</a></li>
        <li <?php if ( '/'.$this->uri->uri_string() == '/admin'): ?> class="active"<?php endif; ?>><a href="<?php echo base_url() ?>admin">Admins</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="">Welcome! <strong><?php echo $session_data['username']; ?></strong></a></li>
        <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
      </ul>
      <?php endif;?>
      <?php if($this->session->userdata('logged_in') && $session_data['user_type'] == 2):?>
        <ul class="nav navbar-nav">
          <li <?php if ( '/'.$this->uri->uri_string() == '/patient/home'): ?> class="active"<?php endif; ?>><a href="<?php echo base_url(); ?>patient/home">My Reports</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="">Welcome! <strong><?php echo $session_data['username']; ?></strong></a></li>
          <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
        </ul>
      <?php endif;?>
    </div>
  </div>
</nav>

