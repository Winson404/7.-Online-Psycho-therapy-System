<!-- ****************************************************UPDATE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="update<?php echo $row['consult_fee_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Update consultancy fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
      <form action="process_update.php" method="POST" enctype="multipart/form-data">
           <input type="hidden" class="form-control" name="consult_fee_Id" value="<?php echo $row['consult_fee_Id']; ?>">   
           <div class="form-group">
              <label>Therapist name</label>
              <input type="text" class="form-control" name="contact" required value="<?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?>" readonly>
           </div>
            <div class="form-group">
              <label>Consultancy Fee</label>
              <input type="number" class="form-control" name="Consultancy" required value="<?php echo $row['consult_fee']; ?>">
           </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-success" name="update_Consultancy_fee" id="create"><i class="fa-solid fa-floppy-disk"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['consult_fee_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Delete consultancy fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['consult_fee_Id']; ?>" name="consult_fee_Id">
          <h6>Delete consultancy fee record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_consultancy_fee"><i class="fa-solid fa-circle-check"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->





