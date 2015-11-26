<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
  <div class="full-container">
    <?php

    if ( is_array($content) ) {

    	foreach ($content as $key => $value) {
    		$this->load->view($value);
    	}
    }
    else
    	$this->load->view($content);

    ?>
  </div>
</body>
