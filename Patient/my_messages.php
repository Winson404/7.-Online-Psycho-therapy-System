<title>Messages</title>


<?php 

  include 'navbar.php'; 
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Messages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Messages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex">
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_admin"><i class="bi bi-plus-circle"></i> Add</button> -->
                  <span class="text-white">g</span>
                  <?php if(isset($_SESSION['success'])) { ?> 
                      <h3 class="alert card-title position-absolute py-2 alert-success rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['success']; ?></h3>
                  <?php unset($_SESSION['success']); } ?>


                  <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></h3>
                  <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                  <?php  if(isset($_SESSION['exists'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['exists']; ?></h3>
                  <?php unset($_SESSION['exists']); } ?>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>My messages</th>
                    <th>Therapist's name(Receiver)</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 

                        $sql = mysqli_query($conn, "SELECT * FROM message JOIN patient ON message.msg_patient_Id=patient.patient_Id JOIN therapist ON message.msg_therapist_Id=therapist.therapist_Id WHERE msg_patient_Id='$id' ORDER BY msg_read   ASC");

                        while ($row = mysqli_fetch_array($sql) ) {

                      ?>
                       
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td>
                            <?php if($row['msg_read'] ==1): ?>
                                <span class="text-muted"><?php echo $row['msg_comment']; ?></span>
                            <?php else: ?>
                                <span><b><?php echo $row['msg_comment']; ?></b></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"> Actions </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#reply<?php echo $row['reply_Id']; ?>"> Send message</button>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#view<?php echo $row['reply_Id']; ?>">View</button>
                                      
                                      <!-- <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#password<?php// echo $row['admin_Id']; ?>">Change password</button> -->
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#delete<?php echo $row['reply_Id']; ?>">Delete</button>
                                </div>
                            </div>
                        </td> 
                    </tr>
                    <?php include 'view_message.php'; ?>

                    <?php //include 'admin_update_delete.php'; 
                  } ?>

                  </tbody>
                  <tfoot>
                      <tr>
                         <th>My messages</th>
                         <th>Therapist's name(Receiver)</th>
                         <th>Tools</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


 <?php include 'footer.php'; ?>

 <script>
   //-----------------------------ALERT TIMEOUT-------------------------//
  $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,5000);
  }
  );
//-----------------------------END ALERT TIMEOUT---------------------//
 </script>


