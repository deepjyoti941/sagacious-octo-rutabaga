<div class="container">
  <h1>Update Report</h1>
  <form action="<?php echo base_url(); ?>report/update/<?php echo $report_id ?>" method="post">
      <table class="table table-bordered" id="reportTable">
        <tr>
          <th>Test Name</th>
          <th>Value</th>
        </tr>
        <?php foreach ($report as $value) { ?>
        <tr>
          <td><input type="text" name="test[<?php echo $value->id; ?>][name]"  value="<?php echo $value->test_name; ?>" required class="form-control"/></td>
          <td><input type="number" name="test[<?php echo $value->id; ?>][measurement]" step="any" value="<?php echo $value->test_value; ?>" required class="form-control"/></td>
        </tr>
        <?php } ?>
      </table>
      <input type="submit" value="Update Report" class="btn btn-primary"/>
  </form>
</div>
