<div class="container">
  <h1>Reports</h1>
  <table class="table table-bordered">
    <tr>
      <th>Created At</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($reports as $value) { ?>
      <tr>
        <td><?php echo $value->created_at; ?></td>
        <td>
          <a class="btn btn-success" href="<?php echo base_url(); ?>patient/view_home_report/<?php echo $value->id; ?>">View Details</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
