<title>Online PsychoTherapy | Transaction History </title>


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
            <h1>Transaction History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Transaction History</li>
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
                    <th>Therapist</th>
                    <th>Therapist commission</th>
                    <th>Patient</th>
                    <th>Total amt. payable</th>
                    <th>Paid amount</th>
                    <th>Commission earned</th>
                    <th>Date paid</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $i = 1;
                        $sql = mysqli_query($conn, "SELECT * FROM new_payment JOIN patient ON new_payment.new_payment_patient_Id=patient.patient_Id JOIN therapist ON new_payment.new_payment_therapist_Id=therapist.therapist_Id");
                       
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td>₱ <?php echo number_format((float)$row['therapist_commission'], 2, '.', ''); ?></td>
                        <td><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_payable'], 2, '.', ''); ?></td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_to_paid'], 2, '.', ''); ?></td>
                        <td>₱ <?php echo number_format((float)$row['admin_commission'], 2, '.', ''); ?></td>
                        <td><?php echo $row['date_paid']; ?></td>
                    </tr>

                    <?php } ?>

                  </tbody>
                  <tfoot>
                      <tr>
                       <th colspan="5" class="text-center">Total</th>
                       <?php
                          $sum = mysqli_query($conn, "SELECT SUM(admin_commission) AS admin_earned FROM new_payment WHERE new_payment_admin_Id='$id'");
                          $row_earned = mysqli_fetch_array($sum);
                       ?>
                       <th>₱ <?php echo number_format((float)$row_earned['admin_earned'], 2, '.', ''); ?></th>
                       <th></th>
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
