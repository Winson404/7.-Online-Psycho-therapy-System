<?php 

    $query = mysqli_query($conn, "SELECT OR_num FROM new_payment ORDER BY OR_num DESC");
    $row_querys= mysqli_fetch_array($query);
    $lastrollnumber = $row_querys['OR_num'];

    if(empty($lastrollnumber))
    {
        $number = "2022-0000001";
    }
    else
    {
        $iddd = str_replace("2022-","",$lastrollnumber);
        $idd  = str_pad($iddd + 1, 7, 0, STR_PAD_LEFT);
        $number = "2022-".$idd;
    }

?>

<!-- ****************************************************CREATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <h5><b>OR #:</b> <span class="text-primary"><?php echo $number; ?></span></h5>
          <br><br>
          <!-- SAVE OFFICIAL RECEIPT NUMBER -->
          <input type="hidden" class="form-control" value="<?php echo $number; ?>" name="or_number">
          <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="patient_Id">

          <?php 
            $a = mysqli_query($conn, "SELECT * FROM admin");
            $b = mysqli_fetch_array($a);
          ?>
          <div class="col-lg-12 mb-2">
              <label for="adviser"><b>Payment to Admin</b></label>
              <input type="text" class="form-control" value="<?php echo ' '.$b['firstname'].' '.$b['middlename'].' '.$b['lastname'].' '.$b['suffix'].' '; ?>" readonly>
          </div>

          <div class="col-lg-12">
            <div class="form-group">
              <label>Therapist name</label>
              <select class="form-control" name="therapist" required id="therapist">
                <option selected disabled>Select therapist</option>
                <?php 
                  $therapist = mysqli_query($conn, "SELECT * FROM therapist WHERE availability='Available'");
                  while ($row = mysqli_fetch_array($therapist)) {
                ?>
                <option value="<?php echo $row['therapist_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12 mb-2">
                  <label for="adviser"><b>Consultancy fee/hour</b></label>
                  <select class="form-control" name="fee" id="fee" required style="background-color: #f2f2f2;">
                      <option value="">Select therapist first</option>
                  </select>
          </div>
          <div class="col-lg-12 mb-2">
              <div class="row">
                <div class="col-lg-6">
                   <label for="adviser"><b>No. of hours</b></label>
                  <select class="form-control form-select" name="no_of_hours" id="hours" required >
                      <option value="" selected disabled>Select no. of hours</option>
                      <option value="1">1 hour</option>
                      <option value="2">2 hours</option>
                      <option value="3">3 hours</option>
                      <option value="4">4 hours</option>
                      <option value="5">5 hours</option>
                      <option value="6">6 hours</option>
                      <option value="7">7 hours</option>
                      <option value="8">8 hours</option>
                      <option value="9">9 hours</option>
                      <option value="10">10 hours</option>

                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="adviser"><b>Total amount to pay</b></label>
                  <select class="form-control form-select" name="total_amount" id="amount" required style="background-color: #f2f2f2;">
                      <option value="">Select no. of hours first</option>
                  </select>
               </div>
               <div class="col-lg-12 mt-2">
                  <label for="adviser"><b>Amount to pay</b></label>
                  <input type="text" class="form-control" name="amount_to_pay" required id="amount_to_pay">
               </div>
              </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="new_payment" id="payment_add"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************END CREATE*********************************************************************** -->







