<div class="container">
  <h1>Report Detail</h1>
  <table class="table table-bordered">
    <tr>
      <th>Test Name</th>
      <th>Test Result</th>
    </tr>
    <?php foreach ($report as $value) { ?>
      <tr>
        <td><?php echo $value->test_name; ?></td>
        <td><?php echo $value->test_value; ?></td>
      </tr>
    <?php } ?>
  </table>
  <a class="btn btn-success" href="<?php echo base_url(); ?>report/edit/<?php echo $report_id; ?>">Edit</a>

</div>
