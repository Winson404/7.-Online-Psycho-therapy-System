<title>Online PsychoTherapy | Appointment</title>


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
            <h1>Appointment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Appointment</li>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="bi bi-plus-circle"></i> Add</button>
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
                    <th>Therapist name</th>
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
                        // $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN therapist ON appointment.appointment_therapist_Id=therapist.therapist_Id JOIN patient ON appointment.appointment_patient_Id=patient.patient_Id JOIN consultancy_fee ON appointment.appointment_consultancy_fee_Id=consultancy_fee.consult_fee_Id WHERE appointment_patient_Id='$id' ORDER BY appointment_status ASC");
                        $sql = mysqli_query($conn, "SELECT * FROM new_appointment JOIN therapist ON new_appointment.appointment_therapist_Id=therapist.therapist_Id JOIN patient ON new_appointment.appointment_patient_Id=patient.patient_Id WHERE appointment_patient_Id='$id'");
                       
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td><?php echo $row['appointment_time']; ?></td>
                        <td>
                          <?php if($row['appointment_status']== 'Pending'): ?>
                            <span class="badge badge-danger rounded-pill">Pending</span>
                          <?php elseif($row['appointment_status']== 'Approved'): ?>
                            <span class="badge badge-primary rounded-pill">Confirmed</span>
                          <?php else: ?>
                            <span class="badge badge-success rounded-pill">Done</span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"> Actions </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#update<?php echo $row['appointment_Id']; ?>">Update</button>

                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#delete<?php echo $row['appointment_Id']; ?>">Delete</button>
                                </div>
                            </div>
                        </td> 
                    </tr>

                    <?php include 'appointment_delete.php'; include 'appointment_update.php'; include 'add_feedback.php';
                  }
                     ?>

                  </tbody>
                  <tfoot>
                      <tr>
                       <th>ID Number</th>
                       <th>Therapist name</th>
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

 <?php include 'appointment_add.php'; //include 'appointment_add.php';  ?>
 <?php include 'footer.php'; ?>



<script>
    $(document).ready(function() {

        $("#therapist").change(function() {
          var therapist_Id = $(this).val();
          $.ajax( {
            url: "ajaxdata.php",
            method: "POST",
            data: {therapist_Id: therapist_Id},
            success: function(data) {
              $("#fee").html(data);
            }
          })
        })


        $("#hours").change(function() {
          var hours = $(this).val();
          var fee = $("#fee").val();
          $.ajax( {
            url: "ajaxdata.php",
            method: "POST",
            data: {hours: hours, fee: fee},
            success: function(data) {
              $("#amount").html(data);
            }
          })
        })

    });
</script>