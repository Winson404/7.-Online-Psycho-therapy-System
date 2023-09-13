
<!-- ****************************************************CONFIRM*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="confirm<?php echo $row['appointment_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar"></i> Payment confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="admin_Id">
          <input type="hidden" class="form-control" value="<?php echo $row['new_payment_Id']; ?>" name="new_payment_Id">
          <input type="hidden" class="form-control" value="<?php echo $row['appointment_Id']; ?>" name="appointment_Id">
          <input type="hidden" class="form-control" value="<?php echo $row['therapist_email']; ?>" name="email">
          <input type="hidden" class="form-control" value="<?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?>" name="patient_name">
          <input type="hidden" class="form-control" value="<?php echo $row['total_amount_payable']; ?>" name="total_payable">
          <h6>Confirm patient as fully paid?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-primary" name="confirm_patient_appointment"><i class="fa-solid fa-floppy-disk"></i> Confirm</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END CONFIRM*********************************************************************** -->





