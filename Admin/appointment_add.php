
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
          
          <div class="col-lg-12">
            <div class="form-group">
              <label>Patient name</label>
              <select class="form-control" name="patient_Id" required id="patient">
                <option selected disabled>Select patient</option>
                <?php 
                  $patient = mysqli_query($conn, "SELECT * FROM patient");
                  while ($row = mysqli_fetch_array($patient)) {
                ?>
                <option value="<?php echo $row['patient_Id']; ?>"><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <label>Therapist name</label>
              <select class="form-control" name="therapist" required id="therapist">
                <option selected disabled>Select therapist</option>
                <?php 
                  $therapist = mysqli_query($conn, "SELECT * FROM therapist");
                  while ($row = mysqli_fetch_array($therapist)) {
                ?>
                <option value="<?php echo $row['therapist_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12 mb-2">
                  <label for="adviser"><b>Consultancy fee/hour</b></label>
                  <select class="form-control" name="fee" id="fee" required >
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
                  <select class="form-control form-select" name="total_amount" id="amount" required >
                      <option value="">Select no. of hours first</option>
                  </select>
                </div>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name="date" required>
              </div>
          </div>
          <div class="col-lg-12">
               <div class="form-group">
                  <label>Time</label>
                  <input type="time" class="form-control" name="time" required>
               </div>
          </div>
         
      </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="create_appointment"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************END CREATE*********************************************************************** -->








