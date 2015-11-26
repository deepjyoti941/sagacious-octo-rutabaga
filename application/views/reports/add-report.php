<div class="container">
  <h1>Create Report</h1>
  <form action="<?php echo base_url(); ?>report/create/<?php echo $patient_id; ?>" method="post">
    <table class="table table-bordered" id="reportTable">
      <tr>
        <th>Test Name</th>
        <th>Value</th>
        <th></th>
      </tr>
      <tr>
        <td><input type="text" name="test[0][name]"  value="" required class="form-control"/></td>
        <td><input type="number" name="test[0][measurement]" step="any" value="" required class="form-control"/></td>
        <td><a class="deleteLink btn btn-default"><i class="fa fa-times"></i> Remove</a></td>
      </tr>
    </table>
    <div style="margin-top: 5px;" ><input type="button" id="addReportsRow" class="btn btn-xs" value="add test field"/></div>

    <div style="margin-top: 42px;"><input type="submit" value="submit Report" class="btn btn-primary"/></div>
  </form>
</div>
