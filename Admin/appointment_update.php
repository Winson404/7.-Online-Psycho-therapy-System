<title>Online PsychoTherapy | Update appointment</title>
<?php include 'navbar.php'; ?>


<?php 
  
  if(isset($_GET['appointment_Id']))
    $app_Id = $_GET['appointment_Id'];

    $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN therapist ON appointment.appointment_therapist_Id=therapist.therapist_Id JOIN patient ON appointment.appointment_patient_Id=patient.patient_Id JOIN consultancy_fee ON appointment.appointment_consultancy_fee_Id=consultancy_fee.consult_fee_Id WHERE appointment.appointment_Id ='$app_Id'");
    $row = mysqli_fetch_array($sql);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update appointment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Update appointment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center d-flex">
          <!-- left column -->
          <div class="col-lg-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update appointment</h3>
              </div>
                <?php if(isset($_SESSION['success'])) { ?> 
                    <p class="alert alert-success position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['success']; ?></p> 
                <?php unset($_SESSION['success']); } ?>

                <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


                <?php  if(isset($_SESSION['exists'])) { ?>
                    <p class="alert alert-danger position-absolute" role="alert" style="right: 0px; height: 46px;"><?php echo $_SESSION['exists']; ?></p>
                <?php unset($_SESSION['exists']); } ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="process_update.php" method="POST" enctype="multipart/form-data">
                 <input type="hidden" class="form-control" value="<?php echo $app_Id; ?>" name="appointment_Id">
                 <div class="card-body">
                    <div class="row d-flex justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <?php                           
                              $patient_Id  = mysqli_query($conn, "SELECT *, appointment_patient_Id FROM appointment RIGHT JOIN patient ON appointment.appointment_patient_Id=patient.patient_Id");
                              $id = $row['appointment_patient_Id'];
                              $all_patient_Id = mysqli_query($conn, "SELECT * FROM patient  where patient_Id = '$id' ");
                              $row_all_patient_Id = mysqli_fetch_array($all_patient_Id);
                              ?>
                              <label>Patient name</label>
                              <select class="form-control form-control-sm" name="patient_Id" required>
                                  <?php foreach($patient_Id as $row_patient_Id):?>
                                        <option value="<?php echo $row_patient_Id['patient_Id']; ?>"  
                                            <?php if($row_all_patient_Id['patient_Id'] == $row_patient_Id['appointment_patient_Id']) echo 'selected="selected"'; ?> 
                                             > <!--/////   CLOSING OPTION TAG  -->
                                            <?php echo ' '.$row_patient_Id['patient_firstname'].' '.$row_patient_Id['patient_middlename'].' '.$row_patient_Id['patient_lastname'].' '.$row_patient_Id['patient_suffix'].' '; ?>                                          
                                        </option>

                                 <?php endforeach;?>
                               </select> 
                          </div>
                          
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label>Therapist name</label>
                              <select class="form-control" name="therapist_Id" required id="update_therapist">
                                <option selected disabled>Select therapist</option>
                                <?php 
                                  $therapist = mysqli_query($conn, "SELECT * FROM therapist");
                                  while ($row = mysqli_fetch_array($therapist)) {
                                ?>
                                <option value="<?php echo $row['therapist_Id']; ?>"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></option>
                                <?php } ?>
                              </select>
                          </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>Consultancy fee/hour</b></label>
                              <select class="form-control form-control-sm" name="fee_Id" id="update_fee" required >
                                  <option value="">Select therapist first</option>
                              </select>
                          </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10 mb-2">
                        <div class="row">
                          <div class="col-lg-6">
                             <label for="adviser"><b>No. of hours</b></label>
                            <select class="form-control form-control-sm" name="no_of_hours" id="hours" required >
                                <option value="" selected disabled>Select no. of hours</option>
                                <option value="1">1 hour</option>
                                <option value="2">2 hours</option>
                                <option value="3">3 hours</option>
                                <option value="4">4 hours</option>
                                <option value="5">5 hours</option>
                                <option value="6">6 hours</option>
                                <option value="7">7 hours</option>
                                <option value="8">8 hours</option>
                                <option value="9">9 hours</option>
                                <option value="10">10 hours</option>

                            </select>
                          </div>
                           <div class="col-lg-6">
                            <label for="adviser"><b>Total amount to pay</b></label>
                            <select class="form-control form-control-sm" name="total_amount" id="amount" required >
                                <option value="">Select no. of hours first</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    </div>    
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>Date</b></label>
                              <input type="date" class="form-control form-control-sm" value="<?php echo $row['appointment_date']; ?>" name="date">
                          </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-10">
                          <div class="form-group">
                              <label for=""><b>Time</b></label>
                              <input type="time" class="form-control form-control-sm" value="<?php echo $row['appointment_time']; ?>" name="time">
                          </div>
                      </div>
                    </div>
                    <div class="row  d-flex justify-content-center">
                      <div class="col-lg-10 d-flex justify-content-center">
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary" name="update_appointment" id="new_create"><i class="fa-solid fa-floppy-disk"></i> Update appointment</button>
                        </div>
                      </div>
                    </div>  
               </div>
                <!-- /.card-body -->
                
              </form>
            </div>
            <!-- /.card -->
         </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <?php include 'footer.php'; ?>


  <script>
    $(document).ready(function() {

        // LOAD CONSULTANCY FEE DURING UPDATING NEW RECORD
        $("#update_therapist").change(function() {
          var update_therapist_Id = $(this).val();
          $.ajax( {
            url: "ajaxdata.php",
            method: "POST",
            data: {update_therapist_Id: update_therapist_Id},
            success: function(data) {
              $("#update_fee").html(data);
            }
          })
        })


        $("#hours").change(function() {
          var hours = $(this).val();
          var fee = $("#update_fee").val();
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
 
</body>
</html>
