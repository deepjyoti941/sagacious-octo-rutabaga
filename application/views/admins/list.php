<div class="container">
  <h1>Admin list</h1>
  <table class="table table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($admins as $value): ?>
      <tr>
        <td>
          <?php echo $value->name;?>
        </td>
        <td>
          <?php echo $value->username;?>
        </td>
        <td>
          <?php echo $value->email;?>
        </td>
        <td>
          <?php echo $value->mobile;?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a class="btn btn-success" href="<?php echo base_url(); ?>admin/add">Add Admin</a>
</div>
