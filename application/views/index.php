<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed'); ?>

<?php echo doctype('html5'); ?>

<html lang="en">

<?php

/**
 * load the head tag
 */
$this->load->view('templates/header');


/**
 * load the documnent body
 */
$this->load->view('templates/body');
//$this->load->view('templates/body', $content);


/**
 * load the document footer
 */
$this->load->view('templates/footer');


?>
	
</html>