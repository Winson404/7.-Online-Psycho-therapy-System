<!--****************************************************VIEW*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="view<?php echo $row['msg_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> View Message</h5>
        <button type="button" class="close">
          <span aria-hidden="true"><a href="process_update.php?mark_as_read=<?php echo $row['msg_Id']; ?>"  class="text-dark"><i class="fa-solid fa-circle-xmark"></i></a></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST">
          <p><b><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></b> - <?php echo $row['msg_date_added']; ?></p>
          <textarea name="comment" id="" cols="30" rows="5" class="form-control" placeholder="Enter your message here!"><?php echo $row['msg_comment']; ?></textarea>
      </div>
      <div class="modal-footer alert-light">
        <a href="process_update.php?mark_as_read=<?php echo $row['msg_Id']; ?>" class="btn btn-secondary">Back</a>
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END VIEW*********************************************************************** -->



<!-- ****************************************************DELETE*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="delete<?php echo $row['msg_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Delete message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['msg_Id']; ?>" name="msg_Id">
          <h6 class="text-center">Delete message?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn btn-danger" name="delete_message"><i class="fa-solid fa-trash-can"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END DELETE*********************************************************************** -->




<!-- ****************************************************REPLY*********************************************************************** -->
<!-- Modal -->
<div class="modal fade" id="reply<?php echo $row['msg_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header alert-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Send message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['msg_Id']; ?>" name="msg_Id">
          <input type="hidden" class="form-control" value="<?php echo $row['therapist_reply']; ?>" name="therapist_reply">
          <input type="hidden" class="form-control" value="<?php echo $row['msg_therapist_Id']; ?>" name="therapist_Id">
          <input type="hidden" class="form-control" value="<?php echo $row['msg_patient_Id']; ?>" name="patient_Id">
          <textarea id="" cols="30" rows="5" class="form-control" placeholder="Enter your message here!" name="comment"></textarea>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="reply">Send</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- ****************************************************END REPLY***********************************************************************-->