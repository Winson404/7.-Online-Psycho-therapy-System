

<!-- ****************************************************CREATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Create appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          
          <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="patient_Id">

          <div class="col-lg-12">
            <div class="form-group">
              <label>Therapist name</label>
              <select class="form-control" name="therapist" required id="therapist">
                <option selected disabled>Select therapist</option>
                <?php 
                  // $therapist = mysqli_query($conn, "SELECT * FROM new_payment JOIN new_appointment ON new_payment.new_payment_therapist_Id=new_appointment.appointment_therapist_Id JOIN therapist ON new_appointment.appointment_therapist_Id=therapist.therapist_Id WHERE new_payment.new_payment_patient_Id='$id' AND new_appointment.appointment_status='Done'");
                  $therapist = mysqli_query($conn, "SELECT * FROM new_payment JOIN therapist ON new_payment.new_payment_therapist_Id=therapist.therapist_Id WHERE new_payment.new_payment_patient_Id='$id'");
                  // $therapist = mysqli_query($conn, "SELECT * FROM new_payment JOIN therapist ON new_payment.new_payment_therapist_Id=therapist.therapist_Id WHERE new_payment.new_payment_patient_Id='$id'");
                  while ($row = mysqli_fetch_array($therapist)) {
                ?>
                <option value="<?php echo $row['therapist_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="col-lg-6">
              <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name="date" required>
              </div>
          </div>
          <div class="col-lg-6">
               <div class="form-group">
                  <label>Time</label>
                  <input type="time" class="form-control" name="time" required>
               </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="create_appointment" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************END CREATE*********************************************************************** -->







