<title>Online PsychoTherapy | Registered patient</title>


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
            <h1>Registered patients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Registered patients</li>
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
                    <th>Image</th>
                    <th>Full name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Acc. Status</th>
                    <th>Tools</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <tr>
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM patient");
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                        <td>
                            <img src="../images-patient/<?php echo $row['image']; ?>" alt="" width="50">
                        </td>
                        <td><?php echo ' '.$row['patient_firstname'].' '.$row['patient_middlename'].' '.$row['patient_lastname'].' '.$row['patient_suffix'].' '; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td>
                          <?php if($row['patient_status'] == 'Pending'): ?>
                            <span type="button" class="badge badge-danger rounded-pill p-1" data-toggle="modal" data-target="#approve<?php echo $row['patient_Id']; ?>"><?php echo $row['patient_status']; ?></span>
                          <?php else: ?>
                            <span class="badge badge-primary rounded-pill p-1"><?php echo $row['patient_status']; ?></span>
                          <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown dropleft">
                                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"> Actions </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#view<?php echo $row['patient_Id']; ?>">View</button>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#update<?php echo $row['patient_Id']; ?>">Update</button>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#password<?php echo $row['patient_Id']; ?>">Change password</button>
                                      <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#delete<?php echo $row['patient_Id']; ?>">Delete</button>
                                </div>
                            </div>
                        </td> 
                    </tr>

                    <?php include 'patient_update_delete.php'; } ?>

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>Image</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Acc. Status</th>
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


 <?php include 'patient_add.php';  ?>
 <?php include 'footer.php'; ?>



