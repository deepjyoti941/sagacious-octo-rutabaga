<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed'); ?>

<?php echo doctype('html5'); ?>

<html lang="en">

<?php

/**
 * load the head tag
 */
$this->load->view('templates/header');
$this->load->view('includes/navigation');
?>

<div class="container">
  <?php if(isset($error)){ ?>
    <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
  <?php } ?>

  <?php if(isset($success)){ ?>
    <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
  <?php } ?>
</div>

<?php
/**
 * load the document footer
 */
$this->load->view('templates/footer');


?>

</html>
