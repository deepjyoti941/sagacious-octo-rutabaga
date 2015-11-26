<div class="container">
  <h1>Patients List</h1>
  <?php if(isset($success)){ ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?php echo $success; ?>.
    </div>
  <?php } ?>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Passcode</th>
        <th>Report</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($patients as $value): ?>
      <tr>
        <td>
          <?php echo $value->name;?>
        </td>
        <td>
          <?php echo $value->email;?>
        </td>
        <td>
          <?php echo $value->mobile;?>
        </td>
        <td>
          <?php echo $value->password;?>
        </td>
        <td>
          <a href="<?php echo base_url(); ?>report/view/<?php echo $value->id; ?>" class="btn btn-success">view</a>
          <a href="<?php echo base_url(); ?>report/add/<?php echo $value->id; ?>" class="btn btn-success">Add</a>
        </td>
        <td>
          <a href="<?php echo base_url(); ?>patient/edit/<?php echo $value->id; ?>" class="btn btn-success">Edit</a>
          <a href="<?php echo base_url(); ?>patient/delete/<?php echo $value->id; ?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
