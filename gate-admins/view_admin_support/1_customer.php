
<div class="row">
  <div class="col-lg-12">
    <h4>
      <?php echo $_POST['cmd']; ?>
    </h4>
  </div>
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <table class="table table-bordered table-xs" id="tbCustomer">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col" width="24%">Option</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
              $result = showCustomer();
              while ($row = mysqli_fetch_array($result)) {
               
                if ($row[0] != 'C0000') {
                	echo '
									<tr>
										<td>'.$no.'</td>
										<td>'.$row[1].'</td>
										<td>'.$row[3].'</td>
                    <td align="left">
                    <a href="?pg=customer_detail&CC='.$row[0].'" class="btn btn-xs btn-info" style="padding-right: 10px;padding-left: 9px;"> <i class="fa fa-info-circle"></i> Detail</a>&nbsp&nbsp
                    <a href="?pg=customer_program&CC='.$row[0].'" class="btn btn-xs btn-success"> <i class="fa fa-ticket"></i> Program</a>';
										echo'
										</td>
									</tr>';
                  ++$no;
                }
              }?>
              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script>
  $(document).ready(function() {
    $('#tbCustomer').DataTable();
  });
</script>
