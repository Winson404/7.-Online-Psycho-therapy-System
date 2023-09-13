<title>Online PsychoTherapy | Payment</title>


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
            <h1>Payment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Payment</li>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa-solid fa-sack-dollar"></i> Click to pay</button>
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
                    <th>Consultancy fee</th>
                    <th>No. of hours</th>
                    <th>Total amount to pay</th>
                    <th>Total amount paid</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 

                        $i = 1;
                        // $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN therapist ON appointment.appointment_therapist_Id=therapist.therapist_Id JOIN patient ON appointment.appointment_patient_Id=patient.patient_Id JOIN consultancy_fee ON appointment.appointment_consultancy_fee_Id=consultancy_fee.consult_fee_Id WHERE appointment_patient_Id='$id' ORDER BY appointment_status ASC");
                        $sql = mysqli_query($conn, "SELECT * FROM new_payment JOIN therapist ON new_payment.new_payment_therapist_Id=therapist.therapist_Id JOIN patient ON new_payment.new_payment_patient_Id=patient.patient_Id JOIN consultancy_fee ON new_payment.new_payment_consultancy_fee_Id=consultancy_fee.consult_fee_Id WHERE new_payment_patient_Id='$id'");
                       
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td><?php echo $row['OR_num']; ?></td>
                        <td><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></td>
                        <td>₱ <?php echo number_format((float)$row['consult_fee'], 2, '.', ''); ?></td>
                        <td><?php echo $row['no_of_hours']; ?> hour/s</td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_payable'], 2, '.', ''); ?></td>
                        <td>₱ <?php echo number_format((float)$row['total_amount_to_paid'], 2, '.', ''); ?></td>
                        
                        <td>
                            <div class="dropdown dropleft">
                                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"> Actions </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                     <!--  <a href="appointment_update.php?appointment_Id=<?php// echo $row['appointment_Id']; ?>" class="btn btn-primary dropdown-item">Update</a> -->
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#update<?php echo $row['new_payment_Id']; ?>">Update</button>

                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#message<?php echo $row['new_payment_Id']; ?>">Send message</button>


                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#delete<?php echo $row['new_payment_Id']; ?>">Delete</button>
                                </div>
                            </div>
                        </td> 
                    </tr>

                    <?php include 'new_payment_delete.php'; include 'add_feedback.php';
                  }
                     ?>

                  </tbody>
                  <tfoot>
                      <tr>
                       <th>OR #</th>
                       <th>Therapist name</th>
                       <th>Consultancy fee</th>
                       <th>No. of hours</th>
                       <th>Total amount to pay</th>
                       <th>Total amount paid</th>
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

 <?php include 'new_payment_add.php'; //include 'appointment_add.php';  ?>
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



<!-- FOR UPDATE -->
<script>
    $(document).ready(function() {

        $("#update_therapist").change(function() {
          var therapist_Id = $(this).val();
          $.ajax( {
            url: "ajaxdata.php",
            method: "POST",
            data: {therapist_Id: therapist_Id},
            success: function(data) {
              $("#update_fee").html(data);
            }
          })
        })


        $("#update_hours").change(function() {
          var hours = $(this).val();
          var fee = $("#update_fee").val();
          $.ajax( {
            url: "ajaxdata.php",
            method: "POST",
            data: {hours: hours, fee: fee},
            success: function(data) {
              $("#update_amount").html(data);
            }
          })
        })

    });
</script>



<script>
    $(document).ready(function() {

        $("#amount_to_pay").keyup(function() {

          var amount = $("#amount").val();
          var amount_to_pay = $("#amount_to_pay").val();

          if(amount_to_pay != amount) {

            $("#payment_add").attr('disabled', 'disabled');

          } else {

             $("#payment_add").removeAttr('disabled');

          }
          
        });

    });
</script>