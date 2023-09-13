
<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['new_payment_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Delete appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['new_payment_Id']; ?>" name="new_payment_Id">
          <h6>Delete payment record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_payment"><i class="fa-solid fa-circle-check"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->






<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['new_payment_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Update payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <h5><b>OR #:</b> <span class="text-primary"><?php echo $row['OR_num']; ?></span></h5>
          <input type="hidden" class="form-control" value="<?php echo $row['OR_num']; ?>" name="OR_num">
          <br><br>
          <input type="hidden" class="form-control" value="<?php echo $row['new_payment_Id']; ?>" name="new_payment_Id">

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
              <select class="form-control" name="therapist" required id="update_therapist">
                <option selected disabled>Select therapist</option>
                <?php 
                  $therapist = mysqli_query($conn, "SELECT * FROM therapist WHERE availability='Available'");
                  while ($row2 = mysqli_fetch_array($therapist)) {
                ?>
                <option value="<?php echo $row2['therapist_Id']; ?>"><?php echo ' '.$row2['firstname'].' '.$row2['middlename'].' '.$row2['lastname'].' '.$row2['suffix'].' '; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12 mb-2">
                  <label for="adviser"><b>Consultancy fee/hour</b></label>
                  <select class="form-control" name="fee" id="update_fee" required style="background-color: #f2f2f2;">
                      <option value="">Select therapist first</option>
                  </select>
          </div>
          <div class="col-lg-12 mb-2">
              <div class="row">
                <div class="col-lg-6">
                   <label for="adviser"><b>No. of hours</b></label>
                  <select class="form-control form-select" name="no_of_hours" id="update_hours" required >
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
                  <select class="form-control form-select" name="total_amount" id="update_amount" required style="background-color: #f2f2f2;">
                      <option value="">Select no. of hours first</option>
                  </select>
               </div>
               <div class="col-lg-12 mt-2">
                  <label for="adviser"><b>Amount to pay</b></label>
                  <input type="text" class="form-control" name="amount_to_pay" required>
               </div>
              </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="update_new_payment" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************END UPDATE*********************************************************************** -->








