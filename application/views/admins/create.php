<div class="container">
  <h1>Add new admin</h1>
  <?php echo form_open('admin/create'); ?>
    <div class="form-group">
      <?php echo form_label('Full Name', 'name'); ?>
      <?php echo form_input(array(
       'name' => 'name',
       'id' => 'name',
       'class' => 'form-control',
       'placeholder' => 'Enter full name'
       ),set_value('name'));
       ?>
      <span class="text-warning"><?php echo form_error('name'); ?></span>
    </div>
    <div class="form-group">
      <?php echo form_label('Username', 'username'); ?>
      <?php echo form_input(array(
       'name' => 'username',
       'id' => 'username',
       'class' => 'form-control',
       'placeholder' => 'Username'
       ),set_value('username'));
       ?>
      <span class="text-warning"><?php echo form_error('username'); ?></span>
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
       <span class="text-warning"><?php echo form_error('email')?></span>
    </div>
    <div class="form-group">
      <?php echo form_label('Password', 'password'); ?>
      <?php echo form_password(array(
       'name' => 'password',
       'id' => 'password',
       'class' => 'form-control',
       'placeholder' => 'Password'
       ));
       ?>
      <span class="text-warning"><?php echo form_error('password'); ?></span>
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
    <?php echo form_button(array(
      'class' => 'btn btn-primary',
      'type' => 'submit',
      'content' => 'Submit'
      ));
      ?>
     <?php echo form_close(); ?>
</div>
