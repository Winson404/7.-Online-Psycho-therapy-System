<?php 
	session_start();
	include '../config.php';

	// UPDATE PATIENT
	if(isset($_POST['update_patient'])) {

		$patient_Id    = $_POST['patient_Id'];
		$firstname  	 = $_POST['firstname'];
		$middlename 	 = $_POST['middlename'];
		$lastname   	 = $_POST['lastname'];
		$suffix     	 = $_POST['suffix'];
		$gender     	 = $_POST['gender'];
		$dob        	 = $_POST['dob'];
		$age        	 = $_POST['age'];
		$contact    	 = $_POST['contact'];
		$email      	 = $_POST['email'];
		$address    	 = $_POST['address'];
		$disease    	 = $_POST['disease'];
		$file       	 = basename($_FILES["fileToUpload"]["name"]);
		$Nationality   = $_POST['Nationality'];

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE patient SET nationality='$Nationality', patient_firstname='$firstname', patient_middlename='$middlename', patient_lastname='$lastname', patient_suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', disease_type='$disease' WHERE patient_Id='$patient_Id'");
		            if($save) {
			                $_SESSION['success']  = "Your information has been updated!";
			                header("Location: about_me_update.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
			                header("Location: about_me_update.php");
		            }

		} else {

				  // Check if image file is a actual image or fake image
		          $target_dir = "../images-patient/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
                  header("Location: about_me_update.php");
                  $uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
                  $_SESSION['error']  = "Your file was not uploaded.";
                  header("Location: about_me_update.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	                      	$save = mysqli_query($conn, "UPDATE patient SET nationality='$Nationality', patient_firstname='$firstname', patient_middlename='$middlename', patient_lastname='$lastname', patient_suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', disease_type='$disease', image='$file' WHERE patient_Id='$patient_Id'");
				            if($save) {
					                $_SESSION['success']  = "Your information has been updated!";
					                header("Location: about_me_update.php");                                
				            } else {
					                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
					                header("Location: about_me_update.php");
				            }
                      } else {
                            $_SESSION['exists'] = "There was an error uploading your file.";
                            header("Location: about_me_update.php");
                      }

				 }

		}

		
	}






	// CHANGE PATIENT PASSWORD
	if(isset($_POST['password_patient'])) {

    	$patient_Id     = $_POST['patient_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM patient WHERE password='$OldPassword' AND patient_Id='$patient_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: changepassword.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE patient SET password='$password' WHERE patient_Id='$patient_Id' ");

			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          					header("Location: changepassword.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          				header("Location: changepassword.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: changepassword.php");
    	}

    }







    // UPDATE APPOINTMENT
	if(isset($_POST['update_appointment'])) {

		$appointment_Id = $_POST['appointment_Id'];
		$therapist_Id   = $_POST['therapist'];
		$date           = $_POST['date'];
		$time           = $_POST['time'];


		$update = mysqli_query($conn, "UPDATE new_appointment SET appointment_therapist_Id='$therapist_Id', appointment_date='$date', appointment_time='$time' WHERE appointment_Id ='$appointment_Id'");
		if($update) {
			$_SESSION['success']  = "Appointment has been updated!";
	        header("Location: appointment.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while updating the record. Please try again.";
            header("Location: appointment_update.php");
		}
	}




	// MARK AS READ THERAPIST MESSAGE
	if(isset($_GET['mark_as_read'])) {

		$msg_Id = $_GET['mark_as_read'];

			$update = mysqli_query($conn, "UPDATE message SET reply_read=1 WHERE msg_Id='$msg_Id'");
			if($update) {
					header("Location: messages.php");
			} else {
					header("Location: messages.php");
			}
	}






// UPDATE NEW PAYMENT
	if(isset($_POST['update_new_payment'])) {

			$or_number	    = $_POST['OR_num'];
			$new_payment_Id = $_POST['new_payment_Id']; 
			$therapist      = $_POST['therapist'];
			$fee            = $_POST['fee'];
			$no_of_hours    = $_POST['no_of_hours'];
			$total_amount   = $_POST['total_amount'];
			$amount_to_pay  = $_POST['amount_to_pay'];
			$date           = date('Y-m-d');

			$balance = $total_amount - $amount_to_pay;

			$admin = mysqli_query($conn, "SELECT * FROM admin");
			$row_admin = mysqli_fetch_array($admin);
			$admin_Id = $row_admin['admin_Id'];

			$save = mysqli_query($conn, "UPDATE new_payment SET new_payment_therapist_Id='$therapist', new_payment_consultancy_fee_Id='$fee', no_of_hours='$no_of_hours', total_amount_payable='$total_amount', total_amount_to_paid='$amount_to_pay', balance='$balance', date_paid='$date' WHERE new_payment_Id='$new_payment_Id'");
			if($save) {

		         $insert = mysqli_query($conn, "UPDATE admin_payment SET admin_payment_therapist_Id='$therapist' WHERE OR_num='$or_number'");
		         if($insert) {
		         	$_SESSION['success']  = "Payment updated.";
		         	header("Location: new_payment.php");
		         } else {
		         	$_SESSION['success']  = "Something went wrong.";
		         	header("Location: new_payment.php");
		         }
			} else {
					$_SESSION['success']  = "Something went wrong.";
		         header("Location: new_payment.php");
			}
		}



?>