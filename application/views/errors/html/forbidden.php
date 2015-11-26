<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed'); ?>

<?php echo doctype('html5'); ?>

<html lang="en">

<?php

/**
 * load the head tag
 */
$this->load->view('templates/header');
?>

<div class="container">
  <div class="alert alert-danger" role="alert">Sorry! This page is forbidden</div>
</div>

<?php
/**
 * load the document footer
 */
$this->load->view('templates/footer');


?>

</html>
