<div class="container">
  <h1>Report Details</h1>
  <table class="table table-bordered">
    <tr>
      <th>Test Name</th>
      <th>Value</th>
    </tr>
    <?php foreach ($report as $value) { ?>
      <tr>
        <td><?php echo $value->test_name;?></td>
        <td><?php echo $value->test_value;?></td>
      </tr>
    <?php } ?>
  </table>
  <div class="pull-right">
    <a class="btn btn-success" href="<?php echo base_url(); ?>patient/print_report/<?php echo $report_id; ?>" target="_blank">Export PDF </a>
    <a class="btn btn-success" href="<?php echo base_url(); ?>patient/email_report/<?php echo $report_id; ?>"> Email Report</a>
  </div>
</div>
