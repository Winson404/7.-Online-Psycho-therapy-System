<?php 
	session_start();
	include '../config.php';

	// SAVE USER
	if(isset($_POST['create_patient'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$contact         = $_POST['contact'];
		$email           = $_POST['email'];
		$address         = $_POST['address'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);
		$Nationality     = $_POST['Nationality'];


		$check_email = mysqli_query($conn, "SELECT * FROM patient WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
			$_SESSION['exists']  = "Email is already taken.";
            header("Location: patient.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['exists']  = "Password does not matched.";
            	header("Location: patient.php");
			} else {

				  		// Check if image file is a actual image or fake image
		          $target_dir = "../images-patient/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  header("Location: patient.php");
                  $uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                  $_SESSION['error']  = "Your file was not uploaded.";
                  header("Location: patient.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	$save = mysqli_query($conn, "INSERT INTO patient (nationality, patient_firstname, patient_middlename, patient_lastname, patient_suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$Nationality', '$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                            if($save) {
	                            $_SESSION['success']  = "Patient information has been successfully saved!";
	                            header("Location: patient.php");                                
                            } else {
                              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                              header("Location: patient.php");
                            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: patient.php");
                      }
				 }

			}

		}

	}








	// SAVE ADMIN
	if(isset($_POST['create_admin'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$contact         = $_POST['contact'];
		$email           = $_POST['email'];
		$address         = $_POST['address'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);


		$check_email = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
			$_SESSION['exists']  = "Email is already taken.";
            header("Location: admin.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['exists']  = "Password does not matched.";
            	header("Location: admin.php");
			} else {

				  		// Check if image file is a actual image or fake image
		          $target_dir = "../images-admin/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  header("Location: admin.php");
                  $uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                  $_SESSION['error']  = "Your file was not uploaded.";
                  header("Location: admin.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	$save = mysqli_query($conn, "INSERT INTO admin (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                            if($save) {
	                            $_SESSION['success']  = "Admin information has been successfully saved!";
	                            header("Location: admin.php");                                
                            } else {
                              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                              header("Location: admin.php");
                            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: admin.php");
                      }
				 }

			}

		}

	}








	// SAVE THERAPIST
	if(isset($_POST['create_therapist'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$contact         = $_POST['contact'];
		$email           = $_POST['email'];
		$address         = $_POST['address'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);
		$Nationality     = $_POST['Nationality'];


		$check_email = mysqli_query($conn, "SELECT * FROM therapist WHERE therapist_email='$email'");
		if(mysqli_num_rows($check_email)>0) {
			$_SESSION['exists']  = "Email is already taken.";
            header("Location: therapist.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['exists']  = "Password does not matched.";
            	header("Location: therapist.php");
			} else {

				  		// Check if image file is a actual image or fake image
		          $target_dir = "../images-therapist-credentials/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  header("Location: therapist.php");
                  $uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                  $_SESSION['error']  = "Your file was not uploaded.";
                  header("Location: therapist.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	$save = mysqli_query($conn, "INSERT INTO therapist (nationality, firstname, middlename, lastname, suffix, gender, dob, age, address, therapist_email, contact, password, credential_image, date_registered) VALUES ('$Nationality', '$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                            if($save) {
	                            $_SESSION['success']  = "Therapist information has been successfully saved!";
	                            header("Location: therapist.php");                                
                            } else {
                              $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
                              header("Location: therapist.php");
                            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: therapist.php");
                      }
				 }

			}

		}

	}





	// SAVE CONSULTANCY FEE
	if(isset($_POST['create_fee'])) {

		$therapist_Id = $_POST['therapist_Id'];
		$Consultancy  = $_POST['Consultancy'];

			$check = mysqli_query($conn, "SELECT * FROM consultancy_fee WHERE consult_fee_therapist_Id ='$therapist_Id' ");
			if(mysqli_num_rows($check) > 0) {
					$_SESSION['exists'] = "This therapist has already a consultancy fee. Just update it you want.";
          header("Location: consultancy_fee.php");
			} else {
					$save = mysqli_query($conn, "INSERT INTO consultancy_fee (consult_fee_therapist_Id, consult_fee) VALUES ('$therapist_Id', '$Consultancy')");
					if($save) {
            $_SESSION['success']  = "Therapist consultancy fee has been successfully saved!";
            header("Location: consultancy_fee.php");                                
          } else {
            $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
            header("Location: consultancy_fee.php");
          }

			}

	}





	// CREATE APPOINTMENT
		if(isset($_POST['create_appointment'])) {
			$id           = $_POST['patient_Id'];
			$therapist    = $_POST['therapist'];
			$fee          = $_POST['fee'];
			$no_of_hours  = $_POST['no_of_hours'];
			$total_amount = $_POST['total_amount'];
			$date         = $_POST['date'];
			$time         = $_POST['time'];

			$exist = mysqli_query($conn, "SELECT * FROM appointment WHERE appointment_patient_Id='$id' AND appointment_therapist_Id='$therapist' "); 
			if(mysqli_num_rows($exist)>0) {
					$_SESSION['exists'] = "This patient have already have set an appointment with the chosen therapist.";
          header("Location: appointment.php");    
			} else {
					$save = mysqli_query($conn, "INSERT INTO appointment (appointment_patient_Id, appointment_therapist_Id, appointment_consultancy_fee_Id, no_of_hours, total_amount, appointment_date, appointment_time) VALUES ('$id', '$therapist', '$fee', '$no_of_hours', '$total_amount', '$date', '$time')");

					if($save) {
		         $_SESSION['success']  = "You have successfully added an appointment.";
		         header("Location: appointment.php");
		      } else {
		       	 $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
		         header("Location: appointment.php");      
		      }
			}
		}






		if(isset($_POST['credential_update'])) {

			$therapist_Id = $_POST['therapist_Id'];
			$file         = basename($_FILES["fileToUpload"]["name"]);


			// Check if image file is a actual image or fake image
      $target_dir = "../images-therapist-credentials/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
            header("Location: credential.php");         
          	$uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            $_SESSION['error']  = "Your file was not uploaded.";
            header("Location: credential.php");         
          // if everything is ok, try to upload file
          } else {

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             	
              	 $save = mysqli_query($conn, "UPDATE therapist SET credential_image='$file' WHERE therapist_Id='$therapist_Id'");

                    if($save) {
                       $_SESSION['success']  = "You have successfully updated therapist credential image.";
                       header("Location: credential.php?therapist_Id=$therapist_Id");
                    } else {
                     	 $_SESSION['exists'] = "Something went wrong while updating the credential. Please try again.";
                       header("Location: credential.php");      
                    }

              } else {
                    	 $_SESSION['exists'] = "There was an error uploading your file.";
                       header("Location: credential.php");         
              }
		}
	}



?>