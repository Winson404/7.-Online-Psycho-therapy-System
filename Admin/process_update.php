<?php 
	
	  use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'vendor/PHPMailer/src/Exception.php';
		require 'vendor/PHPMailer/src/PHPMailer.php';
		require 'vendor/PHPMailer/src/SMTP.php';

	session_start();
	include '../config.php';

	// UPDATE PATIENT
	if(isset($_POST['update_patient'])) {

		$patient_Id 	 = $_POST['patient_Id'];
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
		$file          = basename($_FILES["fileToUpload"]["name"]);
		$Nationality   = $_POST['Nationality'];

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE patient SET nationality='$Nationality', patient_firstname='$firstname', patient_middlename='$middlename', patient_lastname='$lastname', patient_suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', disease_type='$disease' WHERE patient_Id='$patient_Id'");
		            if($save) {
			                $_SESSION['success']  = "Patient information has been updated!";
			                header("Location: patient.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
			                header("Location: patient.php");
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
	                      	$save = mysqli_query($conn, "UPDATE patient SET nationality='$Nationality', patient_firstname='$firstname', patient_middlename='$middlename', patient_lastname='$lastname', patient_suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', disease_type='$disease', image='$file' WHERE patient_Id='$patient_Id'");
				            if($save) {
					                $_SESSION['success']  = "Patient information has been updated!";
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






	// CHANGE PATIENT PASSWORD
	if(isset($_POST['password_patient'])) {

    	$patient_Id  = $_POST['patient_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM patient WHERE password='$OldPassword' AND patient_Id='$patient_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: patient.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE patient SET password='$password' WHERE patient_Id='$patient_Id' ");

			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          					header("Location: patient.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          				header("Location: patient.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: patient.php");
    	}

    }











    // UPDATE ADMIN
	if(isset($_POST['update_admin'])) {

		$admin_Id    = $_POST['admin_Id'];
		$firstname  = $_POST['firstname'];
		$middlename = $_POST['middlename'];
		$lastname   = $_POST['lastname'];
		$suffix     = $_POST['suffix'];
		$gender     = $_POST['gender'];
		$dob        = $_POST['dob'];
		$age        = $_POST['age'];
		$contact    = $_POST['contact'];
		$email      = $_POST['email'];
		$address    = $_POST['address'];
		$file       = basename($_FILES["fileToUpload"]["name"]);

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE admin SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE admin_Id='$admin_Id'");
		            if($save) {
			                $_SESSION['success']  = "Admin information has been updated!";
			                header("Location: admin.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
			                header("Location: admin.php");
		            }

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
	                      	$save = mysqli_query($conn, "UPDATE admin SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact', image='$file' WHERE admin_Id='$admin_Id'");
				            if($save) {
					                $_SESSION['success']  = "Admin information has been updated!";
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




	// CHANGE ADMIN PASSWORD
	if(isset($_POST['password_admin'])) {

    	$admin_Id    = $_POST['admin_Id'];	
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM admin WHERE password='$OldPassword' AND admin_Id='$admin_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: admin.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE admin SET password='$password' WHERE admin_Id='$admin_Id' ");

			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          					header("Location: admin.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          				header("Location: admin.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: admin.php");
    	}

    }







    // UPDATE THERAPIST
	if(isset($_POST['update_therapist'])) {

		$therapist_Id = $_POST['therapist_Id'];
		$firstname    = $_POST['firstname'];
		$middlename   = $_POST['middlename'];
		$lastname     = $_POST['lastname'];
		$suffix       = $_POST['suffix'];
		$gender       = $_POST['gender'];
		$dob          = $_POST['dob'];
		$age          = $_POST['age'];
		$contact      = $_POST['contact'];
		$email        = $_POST['email'];
		$address      = $_POST['address'];
		$file         = basename($_FILES["fileToUpload"]["name"]);
		$Nationality  = $_POST['Nationality'];

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE therapist SET nationality='$Nationality', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', therapist_email='$email', contact='$contact' WHERE therapist_Id='$therapist_Id'");
		            if($save) {
			                $_SESSION['success']  = "Therapist information has been updated!";
			                header("Location: therapist.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
			                header("Location: therapist.php");
		            }

		} else {

				  // Check if image file is a actual image or fake image
		          $target_dir = "../images-therapist/";
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
	                      	$save = mysqli_query($conn, "UPDATE therapist SET nationality='$Nationality', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', therapist_email='$email', contact='$contact', image='$file' WHERE therapist_Id='$therapist_Id'");
				            if($save) {
					                $_SESSION['success']  = "Therapist information has been updated!";
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






	// CHANGE THERAPIST PASSWORD
	if(isset($_POST['password_therapist'])) {

    	$therapist_Id  = $_POST['therapist_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM therapist WHERE password='$OldPassword' AND therapist_Id='$therapist_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: therapist.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE therapist SET password='$password' WHERE therapist_Id='$therapist_Id' ");

			    			if($update_password) {
			    					$_SESSION['success']  = "Password has been changed.";
		          					header("Location: therapist.php");
			    			} else {
			    					$_SESSION['exists']  = "Something went wrong while changing the password.";
			          				header("Location: therapist.php");
			    			}
		    		}
    	} else {
    		$_SESSION['exists']  = "Old password is incorrect.";
            header("Location: therapist.php");
    	}

    }






  // APPROVE THERAPIST ACCOUNT
	if(isset($_POST['approve_therapist'])) {
		$therapist_Id = $_POST['therapist_Id'];
		$user_email  = $_POST['email'];

		$delete = mysqli_query($conn, "UPDATE therapist SET status='Confirmed' WHERE therapist_Id='$therapist_Id'");
		if($delete) {


							$email   = $user_email ;
					    $subject = 'Account approved!';
					    $message = '<h3>Congratulations!</h3>
													<p>Good day sir/maam , we have successfully approved your account. Thank you!</p>';

									//Load composer's autoloader

							    $mail = new PHPMailer(true);                            
							    try {
							        //Server settings
							        $mail->isSMTP();                                     
							        $mail->Host = 'smtp.gmail.com';                      
							        $mail->SMTPAuth = true;                             
							        $mail->Username = 'bssccti@gmail.com';     
							        $mail->Password = 'eshdzviotsxqjero';             
							        $mail->SMTPOptions = array(
							            'ssl' => array(
							            'verify_peer' => false,
							            'verify_peer_name' => false,
							            'allow_self_signed' => true
							            )
							        );                         
							        $mail->SMTPSecure = 'ssl';                           
							        $mail->Port = 465;                                   

							        //Send Email
							        $mail->setFrom('bssccti@gmail.com');
							        
							        //Recipients
							        $mail->addAddress($email);              
							        $mail->addReplyTo('bssccti@gmail.com');
							        
							        //Content
							        $mail->isHTML(true);                                  
							        $mail->Subject = $subject;
							        $mail->Body    = $message;

							        $mail->send();
									
							     		$_SESSION['success']  = "Therapist account has been confirmed!";
	           					header("Location: therapist.php");

							    } catch (Exception $e) {
							    	echo 'failed';
							    	$_SESSION['success']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
        			      header("Location: therapist.php");
							    }

		} else {
			$_SESSION['exists'] = "Something went wrong while updating the record. Please try again.";
            header("Location: therapist.php");
		}
	}










  // APPROVE PATIENT ACCOUNT
	if(isset($_POST['approve_patient'])) {
		$patient_Id = $_POST['patient_Id'];
		$user_email  = $_POST['email'];

		$delete = mysqli_query($conn, "UPDATE patient SET patient_status='Confirmed' WHERE patient_Id='$patient_Id'");
		if($delete) {


							$email   = $user_email ;
					    $subject = 'Account approved!';
					    $message = '<h3>Congratulations!</h3>
													<p>Good day sir/maam , we have successfully approved your account. Thank you!</p>';

									//Load composer's autoloader

							    $mail = new PHPMailer(true);                            
							    try {
							        //Server settings
							        $mail->isSMTP();                                     
							        $mail->Host = 'smtp.gmail.com';                      
							        $mail->SMTPAuth = true;                             
							        $mail->Username = 'bssccti@gmail.com';     
							        $mail->Password = 'eshdzviotsxqjero';             
							        $mail->SMTPOptions = array(
							            'ssl' => array(
							            'verify_peer' => false,
							            'verify_peer_name' => false,
							            'allow_self_signed' => true
							            )
							        );                         
							        $mail->SMTPSecure = 'ssl';                           
							        $mail->Port = 465;                                   

							        //Send Email
							        $mail->setFrom('bssccti@gmail.com');
							        
							        //Recipients
							        $mail->addAddress($email);              
							        $mail->addReplyTo('bssccti@gmail.com');
							        
							        //Content
							        $mail->isHTML(true);                                  
							        $mail->Subject = $subject;
							        $mail->Body    = $message;

							        $mail->send();
									
							     		$_SESSION['success']  = "Patient account has been confirmed!";
	           					header("Location: patient.php");

							    } catch (Exception $e) {
							    	echo 'failed';
							    	$_SESSION['success']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
        			      header("Location: patient.php");
							    }

		} else {
			$_SESSION['exists'] = "Something went wrong while updating the record. Please try again.";
            header("Location: patient.php");
		}
	}











	// UPDATE CONSULTANCY FEE
	if(isset($_POST['update_Consultancy_fee'])) {

		$consult_fee_Id = $_POST['consult_fee_Id'];
		$Consultancy    = $_POST['Consultancy'];

		$delete = mysqli_query($conn, "UPDATE consultancy_fee SET consult_fee='$Consultancy' WHERE consult_fee_Id ='$consult_fee_Id'");
		if($delete) {
			$_SESSION['success']  = "Therapist consultancy fee has been updated!";
	        header("Location: consultancy_fee.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: consultancy_fee.php");
		}
	}





	  // UPDATE APPOINTMENT
	if(isset($_POST['update_appointment'])) {

		$appointment_Id = $_POST['appointment_Id'];
		$patient_Id     = $_POST['patient_Id'];
		$therapist_Id   = $_POST['therapist_Id'];
		$fee_Id         = $_POST['fee_Id'];
		$no_of_hours    = $_POST['no_of_hours'];
		$total_amount   = $_POST['total_amount'];
		$date           = $_POST['date'];
		$time           = $_POST['time'];


		$update = mysqli_query($conn, "UPDATE appointment SET appointment_patient_Id='$patient_Id', appointment_therapist_Id='$therapist_Id', appointment_consultancy_fee_Id='$fee_Id', no_of_hours='$no_of_hours', total_amount='$total_amount', appointment_date='$date', appointment_time='$time' WHERE appointment_Id ='$appointment_Id'");
		if($update) {
			$_SESSION['success']  = "Appointment has been updated!";
	        header("Location: appointment.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while updating the record. Please try again.";
            header("Location: appointment_update.php");
		}
	}




	if(isset($_POST['confirm_patient_appointment'])) {

		$admin_Id				= $_POST['admin_Id'];
		$new_payment_Id = $_POST['new_payment_Id'];
		$appointment_Id = $_POST['appointment_Id'];
		$user_email     = $_POST['email'];
		$patient_name   = $_POST['patient_name'];
		$total_payable  = $_POST['total_payable'];

		$admin_percentage = 40;
		$therapist_percentage = 60;

		$admin_commission = ($admin_percentage / 100) * $total_payable;            // ADMIN COMMISSION
		$therapist_commission = ($therapist_percentage / 100) * $total_payable;    // THERAPIST COMMISSION

		$update = mysqli_query($conn, "UPDATE new_appointment SET admin_confirmation='Confirmed' WHERE appointment_Id='$appointment_Id'");
			if($update) {

							$update2 = mysqli_query($conn, "UPDATE new_payment SET new_payment_admin_Id='$admin_Id', admin_commission='$admin_commission', therapist_commission='$therapist_commission' WHERE new_payment_Id='$new_payment_Id'");
							if($update2) {

									$email   = $user_email ;
					    		$subject = 'Fully paid patient!';
					        $message = '<h3>Paid patient!</h3>
													<p>Good day sir/maam , patient '.$patient_name.' has been fully paid. You can now approve his appointment!</p>';

									//Load composer's autoloader

							    $mail = new PHPMailer(true);                            
							    try {
							        //Server settings
							        $mail->isSMTP();                                     
							        $mail->Host = 'smtp.gmail.com';                      
							        $mail->SMTPAuth = true;                             
							        $mail->Username = 'bssccti@gmail.com';     
							        $mail->Password = 'eshdzviotsxqjero';             
							        $mail->SMTPOptions = array(
							            'ssl' => array(
							            'verify_peer' => false,
							            'verify_peer_name' => false,
							            'allow_self_signed' => true
							            )
							        );                         
							        $mail->SMTPSecure = 'ssl';                           
							        $mail->Port = 465;                                   

							        //Send Email
							        $mail->setFrom('bssccti@gmail.com');
							        
							        //Recipients
							        $mail->addAddress($email);              
							        $mail->addReplyTo('bssccti@gmail.com');
							        
							        //Content
							        $mail->isHTML(true);                                  
							        $mail->Subject = $subject;
							        $mail->Body    = $message;

							        $mail->send();
									
							     		$_SESSION['success']  = "Appointment has been confirmed.";
	           					header("Location: appointment.php");

							    } catch (Exception $e) {
							    	echo 'failed';
							    	$_SESSION['success']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
        			      header("Location: appointment.php");
							    }

							} else {

									$_SESSION['exists'] = "Something went wrong while confirming the appointment. Please try again.";
	            		header("Location: appointment_update.php");

							}

							

			} else {
						  $_SESSION['exists'] = "Something went wrong while confirming the appointment. Please try again.";
	            header("Location: appointment_update.php");
			}
	}




?>