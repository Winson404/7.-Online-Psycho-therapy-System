<title>Online PsychoTherapy | Appointments</title>


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
            <h1>Appointments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Appointments</li>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user" style="opacity: 0;"><i class="bi bi-plus-circle"></i> Add</button>

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
                    <th>ID Number</th>
                    <th>Patient name</th>
                    <th>Appointment date</th>
                    <th>Appointment time</th>
                    <th>Status</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM new_appointment JOIN therapist ON new_appointment.appointment_therapist_Id=therapist.therapist_Id JOIN patient ON new_appointment.appointment_patient_Id=patient.patient_Id WHERE appointment_therapist_Id='$id' ORDER BY appointment_status ASC");
                       
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></td>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td><?php echo $row['appointment_time']; ?></td>
                        <td>
                          <?php if($row['appointment_status']== 'Pending'): ?>
                            <span class="badge badge-danger rounded-pill p-1"><?php echo $row['appointment_status']; ?></span>
                          <?php elseif($row['appointment_status']== 'Done'): ?>
                            <span class="badge badge-success rounded-pill p-1"><?php echo $row['appointment_status']; ?></span>
                          <?php else: ?>
                            <span class="badge badge-primary rounded-pill p-1"><?php echo $row['appointment_status']; ?></span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"> Actions </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#view<?php echo $row['patient_Id']; ?>">View patient info</button>
                                      <?php if($row['admin_confirmation'] == 'Pending'): ?>
                                      <button type="button" class="btn btn-primary dropdown-item">Requires admin approval to approve appointment</button>
                                      <?php else: ?>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#approve<?php echo $row['appointment_Id']; ?>">Approve</button>
                                      <?php endif; ?>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#deny<?php echo $row['appointment_Id']; ?>">Deny</button>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#done<?php echo $row['appointment_Id']; ?>">Done</button>
                                      
                                </div>
                            </div>
                        </td> 
                    </tr>

                    <?php include 'appointment_approve.php'; } ?>

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>ID Number</th>
                        <th>Patient name</th>
                        <th>Appointment date</th>
                        <th>Appointment time</th>
                        <th>Status</th>
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



