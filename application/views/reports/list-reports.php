<div class="container">
  <h1>Reports</h1>
  <?php if(isset($patient)){ ?>
  <div><b>Patient Name:</b> <?php echo $patient->username; ?> </div>
  <?php } ?>

  <table class="table table-bordered">
    <tr>
      <th>Patient Id</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($reports as $value) { ?>
      <tr>
        <td><a href="<?php echo base_url(); ?>report/view/<?php echo $value->patient_id; ?>"> <?php echo $value->patient_id;?></td>
        <td><?php echo $value->created_at;?></td>
        <td>
          <a class="btn btn-success" href="<?php echo base_url(); ?>report/view_report/<?php echo $value->id; ?>">View Detail</a>
          <a class="btn btn-success" href="<?php echo base_url(); ?>report/edit/<?php echo $value->id; ?>">Edit</a>
          <a class="btn btn-danger" href="<?php echo base_url(); ?>report/delete/<?php echo $value->id; ?>">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
