<div class="container">
  <h1>Update Patients</h1>

  <form action="<?php echo base_url(); ?>patient/update/<?php echo $patient->id ?>" method="post" class="form-signin">
    <fieldset>
      <legend>Personal Information</legend>
      <div class="form-group">
        <?php echo form_label('Patient full name', 'name') ?>
        <input type="text" class="form-control" id="username" name="patient[name]" value="<?php echo $patient->name; ?>" required/>
        <span class="text-warning"><?php echo form_error('name')?></span>
      </div>
      <div class="form-group">
        <?php echo form_label('Email Address', 'inputEmailAddress') ?>
        <input type="email" class="form-control" id="passowrd" name="patient[email]" value="<?php echo $patient->email; ?>"/>
        <span class="text-warning"><?php echo form_error('email_address')?></span>
      </div>
    </fieldset>

    <fieldset>
      <legend>Login Info</legend>
      <div class="form-group">
         <?php echo form_label('Username', 'inputUsername') ?>
        <input type="text" class="form-control" id="username" name="patient[username]" value="<?php echo $patient->username; ?>" required/>
         <span class="text-warning"><?php echo form_error('username')?></span>
      </div>
      <div class="form-group">
        <?php echo form_label('Mobile', 'mobile') ?>
        <input type="tel" class="form-control" id="phone" name="patient[mobile]" value="<?php echo $patient->mobile; ?>"/>
         <span class="text-warning"><?php echo form_error('mobile')?></span>
      </div>
      <button class="btn btn-primary" type="submit">Update</button>
    </fieldset>
  </form>

</div>
