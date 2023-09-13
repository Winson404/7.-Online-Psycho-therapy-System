<title>Online PsychoTherapy | Therapist credential</title>
<?php include 'navbar.php'; ?>

<?php
  if(isset($_GET['therapist_Id']))
    $id = $_GET['therapist_Id'];
  $fetch = mysqli_query($conn, "SELECT * FROM therapist WHERE therapist_Id='$id'");
  $row = mysqli_fetch_array($fetch);

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Therapist credential</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Therapist credential</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Credentials</h3>
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
              <form action="process_save.php" method="POST" enctype="multipart/form-data">
                     <input type="hidden" class="form-control" value="<?php echo $row['therapist_Id']; ?>" name="therapist_Id">
                     <div class="card-body">
                        <div class="row  d-flex justify-content-center">
                            <div class="col-lg-8">
                                <img src="../images-therapist-credentials/<?php echo $row['credential_image']; ?>" alt="" class="img-fluid">
                            </div>
                            
                        </div>
                        <hr>
                        <div class="col-lg-12 mt-5">
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" class="form-control-file form-control-sm" name="fileToUpload" onchange="newgetImagePreview(event)">
                            </div>
                        </div>
                         <div class="col-lg-12 mb-2">
                                <div class="form-group" id="user_preview">
                                </div>
                            </div>
                   </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button class="btn btn-primary" name="credential_update" type="submit"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>
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

<script>
   function newgetImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('user_preview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="455px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
    imagediv.appendChild(text);
  }


  function lettersOnly(input) {
      var regex = /[^a-z ]/gi;
      input.value = input.value.replace(regex, "");
    }

</script>

  <?php include 'footer.php'; ?>
 
</body>
</html>
