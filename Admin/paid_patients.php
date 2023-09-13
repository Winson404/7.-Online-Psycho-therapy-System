<title>Online PsychoTherapy | Appointment transactions </title>


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
            <h1>Appointment transactions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Appointment transactions</li>
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
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="bi bi-plus-circle"></i> Add</button> -->

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
                    <th>OR #</th>
                    <th>Therapist name</th>
                    <th>Patient name</th>
                    <th>Total payable</th>
                    <th>Paid amount</th>
                    <th>Balance</th>
                    <th>Appointment date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM new_payment JOIN patient ON new_payment.new_payment_patient_Id=patient.patient_Id JOIN therapist ON new_payment.new_payment_therapist_Id=therapist.therapist_Id JOIN new_appointment ON new_payment.new_payment_patient_Id=new_appointment.appointment_patient_Id ");
                       
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><b><?php echo $row['OR_num']; ?></b></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_payable'], 2, '.', ''); ?></td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_to_paid'], 2, '.', ''); ?></td>
                        <td>
                          <?php if($row['balance'] == 0): ?>
                            <span class="badge badge-success rounded-pill">Fully paid</span>
                          <?php else: ?>
                            ₱ <?php echo number_format((float)$row['balance'], 2, '.', ''); ?>
                          <?php endif; ?>
                        </td>
                        <td><?php echo $row['appointment_date']; ?> - <?php echo $row['appointment_time']; ?></td>
                        <td>
                          <?php if($row['admin_confirmation'] !='Confirmed'): ?>
                          <span type="button" class="badge badge-warning rounded-pill p-1" data-toggle="modal" data-target="#confirm<?php echo $row['appointment_Id']; ?>">Confirm fully paid patient</span>
                          <?php else: ?>
                            <span type="button" class="badge badge-info rounded-pill p-1">Confirmation done</span>
                          <?php endif; ?>
                        </td>
                    </tr>

                    <?php include 'paid_patients_confirmation.php'; } ?>

                  </tbody>
                  
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
