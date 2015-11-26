<div id="login-overlay" class="span-6">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Login to portal</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <?php if(isset($message['error'])){ ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong><?php echo $message['error']; ?>.
          </div>
         <?php } ?>
        <?php if(isset($message['logout'])){ ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $message['logout']; ?>.
          </div>
         <?php } ?>
        <div class="col-xs-6">
          <div class="well">
            <?php echo form_open('login/do'); ?>
              <div class="form-group">
                <?php echo form_label('Select role', 'role'); ?>
                <?php
                $options = array(
                '1' => 'Admin - lab operator',
                '2' => 'Patient'
              );
                echo form_dropdown('role', $options, '2', 'class="form-control user_type"');
              ?>
              </div>
              <div class="form-group">
              <div class="btn-group">
                <?php echo form_label('Username', 'username'); ?>
                <?php echo form_input(array(
                 'name' => 'username',
                 'id' => 'username',
                 'class' => 'form-control',
                 'placeholder' => 'Username',
                 'autocomplete' => 'off',
                 ),set_value('username'));
                 ?>
                <ul class="form-control dropdown-menu list-group usernameList" role="menu" aria-labelledby="dropdownMenu"  id="dropdownUsername">
                </ul>
                <span class="text-warning"><?php echo form_error('username'); ?></span>
                </div>
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
              <?php echo form_button(array(
                'class' => 'btn btn-primary',
                'type' => 'submit',
                'content' => 'Login'
                ));
              ?>

              <?php echo form_close(); ?>
          </div>
        </div>
        <div class="col-xs-6">
          <p class="lead">Welcome to pathology lab</p>
          <ul class="list-unstyled" style="line-height: 2">
            <li><span class="fa fa-check text-success"></span> View your all reports</li>
            <li><span class="fa fa-check text-success"></span> Instant report printing/export</li>
            <li><span class="fa fa-check text-success"></span> Send reports to your mail</li>
            <li><span class="fa fa-check text-success"></span> Add patients<small>(Admin - lab operator)</small></li>
            <li><span class="fa fa-check text-success"></span> Add test reports<small>(Admin - lab operator)</small></li>
            <li><span class="fa fa-check text-success"></span> Easily update patient and test data<small>(Admin - lab operator)</small></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
