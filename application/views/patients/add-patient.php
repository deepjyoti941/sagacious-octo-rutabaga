<div class="container">
  <h1>Add Patients</h1>
  <?php if(isset($error)){ ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Error!</strong><?php echo $error; ?>.
    </div>
   <?php } ?>

  <?php echo form_open('patient/create'); ?>

  <fieldset>
    <legend>Personal Information</legend>
    <div class="form-group">
       <?php echo form_label('Patient full name', 'name') ?>

       <?php
       echo form_input(array(
          'id' => 'name',
          'name' => 'name',
          'class' => 'form-control',
          'placeholder' => 'Full Name'
       ),set_value('name'));
       ?>
       <span class="text-warning"><?php echo form_error('name')?></span>
    </div>
    <div class="form-group">
      <?php echo form_label('Email Address', 'inputEmailAddress') ?>

      <?php
        echo form_input(array(
          'id' => 'inputEmailAddress',
          'name' => 'email',
          'class' => 'form-control',
          'placeholder' => 'Email Address'
        ),set_value('email_address'));
      ?>
      <span class="text-warning"><?php echo form_error('email_address')?></span>
    </div>

  </fieldset>


  <fieldset>
    <legend>Login Info</legend>
    <div class="form-group">
       <?php echo form_label('Username', 'inputUsername') ?>

       <?php
       echo form_input(array(
          'id' => 'inputUsername',
          'name' => 'username',
          'class' => 'form-control',
          'placeholder' => 'username'
       ),set_value('username'));
       ?>
       <span class="text-warning"><?php echo form_error('username')?></span>
    </div>
    <div class="form-group">
       <?php echo form_label('Mobile', 'mobile') ?>

       <?php
       echo form_input(array(
          'id' => 'mobileNo',
          'name' => 'mobile',
          'class' => 'form-control',
          'placeholder' => 'patient mobile number'
       ),set_value('mobile'));
       ?>
       <span class="text-warning"><?php echo form_error('mobile')?></span>
    </div>
    <?php
      echo form_button(array(
        'class' => 'btn btn-primary',
        'type' => 'submit',
        'content' => 'Add Patient'
      ));
    ?>

  </fieldset>

  <?php echo form_close(); ?>
</div>
