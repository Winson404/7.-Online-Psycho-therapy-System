<title>Online PsychoTherapy | Payment Details</title>


<?php include 'navbar.php'; 

	if(isset($_GET['appointment_Id'])) 
		$appointment_Id = $_GET['appointment_Id'];


	$admin = mysqli_query($conn, "SELECT * FROM admin");
	$row_admin = mysqli_fetch_array($admin);

	$fetch = mysqli_query($conn, "SELECT * FROM appointment JOIN therapist ON appointment.appointment_therapist_Id=therapist.therapist_Id WHERE appointment.appointment_Id='$id'");
	$row = mysqli_fetch_array($fetch);



  $query = "SELECT OR_num FROM payment";
  $result = mysqli_query($conn,$query);
  $row_query= mysqli_fetch_array($result);
  $lastrollnumber = $row_query['OR_num'];
  if(empty($lastrollnumber))
  {
      $number = "2022-0000001";
  }
  else
  {
      $idd = str_replace("2022-", "", $lastrollnumber);
      $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
      $number = '2022-'.$id;
  }
  

	

?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Payment Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payment Details</li>
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
               

                  <?php if(isset($_SESSION['success'])) { ?> 
                      <h3 class="alert card-title position-absolute py-2 alert-success rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; top: 30px;"><?php echo $_SESSION['success']; ?></h3>
                  <?php unset($_SESSION['success']); } ?>


                  <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></h3>
                  <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                  <?php  if(isset($_SESSION['exists'])) { ?>
                      <h3 class="alert card-title position-absolute py-2 alert-danger rounded p-1" role="alert" style="right: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;"><?php echo $_SESSION['exists']; ?></h3>
                  <?php unset($_SESSION['exists']); } ?>
                  
               
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3 rounded" style="display: block;margin-left: auto;margin-right: auto;">
               		
              <div class="card p-3" style="width: 25rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              <div class="">
						  <!-- <div class="d-flex "> -->
						  	<h4>Payment Details:</h4>
						  	<!-- <img src="../images/gcash.png" class="img-fluid position-absolute" alt="gcash" width="100" style="right: 5px;top: 40px;">
						  	<img src="../images/paypal.png" class="img-fluid position-absolute" alt="gcash" width="100" style="right: 110px;top: 52px;"> -->
						  	
						  </div>

						  <div class="card-body">
						  	<h5><b>Official Receipt #:</b> <?php echo $number; ?></h5>
						  	<hr>
						  <form action="process_save.php" method="POST">
						    <div class="form-group">
						    	<h5 class="card-title">Payment to:</h5>
						    	<!-- SAVE OFFICIAL RECEIPT NUMBER -->
						    	<input type="hidden" class="form-control" value="<?php echo $number; ?>" name="or_number">

						    	<!-- APPOINTMENT ID USED TO GO BACK ON THIS PAGE WITHOUT ERROR-->
						    	<input type="hidden" class="form-control" value="<?php echo $appointment_Id; ?>" name="appointment_Id">

						    	<!-- ADMIN ID -->
						    	<input type="hidden" class="form-control" value="<?php echo $row_admin['admin_Id']; ?>" name="admin_Id">

						    	<!-- PATIENT ID -->
						    	<input type="hidden" class="form-control" value="<?php echo $id; ?>" name="patient_Id">

						    	<!-- THERAPIST ID -->
						    	<input type="hidden" class="form-control" value="<?php echo $row['appointment_therapist_Id']; ?>" name="therapist_Id">
						    	<input type="text" class="form-control" value="<?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?>" readonly>
						    </div>
						    <div class="form-group">
						    	<h5 class="card-title">Total payable amount:</h5>
						    	<input type="hidden" class="form-control" value="<?php echo $row['total_amount']; ?>" readonly name="total_payable">
						    	<input type="text" class="form-control" value="₱ <?php echo $row['total_amount']; ?>.00" readonly>
						    </div>
						    <div class="form-group mb-3">
						    	<h5 class="card-title">Amount to pay:</h5>
						    	<input type="number" class="form-control" name="amount_to_pay">
						    </div>
						    <div class="form-group">
						    	<button class="btn btn-primary mt-3" style="width: 100%;" type="submit" name="payment">Submit</button>
						    </div>
						  </form>
						  </div>
					</div>

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
