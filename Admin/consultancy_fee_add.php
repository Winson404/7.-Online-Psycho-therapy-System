<!-- ****************************************************CREATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="add_fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Create consultancy fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
          
            <div class="form-group">
              <label>Therapist name</label>
              <select class="form-control" name="therapist_Id" required>
                <option selected disabled>Select therapist</option>
                <?php

                  $fetch = mysqli_query($conn, "SELECT * FROM therapist WHERE therapist_Id NOT IN (SELECT consult_fee_therapist_Id FROM consultancy_fee)");
                  while ($row = mysqli_fetch_array($fetch)) {

                ?>
                <option value="<?php echo $row['therapist_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
                <label>Consultancy Fee</label>
                <input type="number" class="form-control"  placeholder="Consultancy Fee" name="Consultancy" required>
            </div>
         
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="create_fee" id="create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>