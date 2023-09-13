<?php 

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'vendor/PHPMailer/src/Exception.php';
		require 'vendor/PHPMailer/src/PHPMailer.php';
		require 'vendor/PHPMailer/src/SMTP.php';

	session_start();
	include '../config.php';


	// UPDATE THERAPIST
	if(isset($_POST['update_therapist'])) {

		$therapist_Id    = $_POST['therapist_Id'];
		$firstname  		 = $_POST['firstname'];
		$middlename 		 = $_POST['middlename'];
		$lastname   		 = $_POST['lastname'];
		$suffix     		 = $_POST['suffix'];
		$gender     		 = $_POST['gender'];
		$dob        		 = $_POST['dob'];
		$age        		 = $_POST['age'];
		$contact    		 = $_POST['contact'];
		$email      		 = $_POST['email'];
		$address    		 = $_POST['address'];
		$file       		 = basename($_FILES["fileToUpload"]["name"]);
		$Nationality     = $_POST['Nationality'];

		if(empty($file)) {

					$save = mysqli_query($conn, "UPDATE therapist SET nationality='$Nationality', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', therapist_email='$email', contact='$contact' WHERE therapist_Id='$therapist_Id'");
		            if($save) {
			                $_SESSION['success']  = "Your information has been updated!";
			                header("Location: about_me_update.php");                                
		            } else {
			                $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
			                header("Location: about_me_update.php");
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
	                      	$save = mysqli_query($conn, "UPDATE therapist SET nationality='$Nationality', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', therapist_email='$email', contact='$contact', image='$file' WHERE therapist_Id='$therapist_Id'");
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






	// CHANGE THERAPIST PASSWORD
	if(isset($_POST['password_therapist'])) {

    	$therapist_Id = $_POST['therapist_Id'];
    	$OldPassword  = md5($_POST['OldPassword']);
    	$password     = md5($_POST['password']);
    	$cpassword    = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM therapist WHERE password='$OldPassword' AND therapist_Id='$therapist_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
    				// COMPARE BOTH NEW AND CONFIRM PASSWORD
		    		if($password != $cpassword) {
		    				$_SESSION['exists']  = "Password does not matched. Please try again";
		          			header("Location: changepassword.php");
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE therapist SET password='$password' WHERE therapist_Id='$therapist_Id' ");

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




    // APPROVE APPOINTMENT
    if(isset($_POST['approve_apppointment'])) {

    	$therapist_Id   = $_POST['therapist_Id'];
    	$appointment_Id = $_POST['appointment_Id'];
    	$user_email     = $_POST['email'];

    	$approve = mysqli_query($conn, "UPDATE new_appointment SET appointment_status='Approved' WHERE appointment_Id='$appointment_Id'");

    	if($approve) {
    					
    					$update = mysqli_query($conn, "UPDATE therapist SET availability='Not available' WHERE therapist_Id='$therapist_Id'");
    					if($update) {

    							$email   = $user_email ;
							    $subject = 'Appointment approved!';
							    $message = '<h3>Congratulations!</h3>
															<p>Good day sir/maam , we have successfully approved your appointment. Thank you!</p>';

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
											
									     		$_SESSION['success']  = "You have successfully approved your appointment.";
		    								  header("Location: appointment.php");

									    } catch (Exception $e) {
									    	echo 'failed';
									    	$_SESSION['success']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
		        			      header("Location: appointment.php");
									    }

    					} else {
    							$_SESSION['exists']  = "Something went wrong while updating the record.";
      						header("Location: appointment.php");
    					}
					
			} else {
							$_SESSION['exists']  = "Something went wrong while updating the record.";
      				header("Location: appointment.php");
			}
    }







    // DENY APPOINTMENT
    if(isset($_POST['deny_apppointment'])) {
    	$appointment_Id = $_POST['appointment_Id'];
    	$user_email  = $_POST['email'];

    	$deny = mysqli_query($conn, "DELETE FROM new_appointment WHERE appointment_Id='$appointment_Id'");

    	if($deny) {

    					$email   = $user_email ;
					    $subject = 'Appointment denied!';
					    $message = '<h3>Sorry!</h3>
													<p>Good day sir/maam , we have denied your appointment.</p>';

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
									
							     		$_SESSION['success']  = "You have denied your appointment.";
    								  header("Location: appointment.php");

							    } catch (Exception $e) {
							    	echo 'failed';
							    	$_SESSION['success']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
        			      header("Location: appointment.php");
							    }

					
			} else {
					$_SESSION['exists']  = "Something went wrong while updating the record.";
      				header("Location: appointment.php");
			}
    }







    // DONE APPOINTMENT
    if(isset($_POST['done_apppointment'])) {
    	$appointment_Id = $_POST['appointment_Id'];
    	$user_email  = $_POST['email'];

    	$deny = mysqli_query($conn, "UPDATE new_appointment SET appointment_status='Done' WHERE appointment_Id='$appointment_Id'");

    	if($deny) {

    					$_SESSION['success']  = "Appointment done.";
    					header("Location: appointment.php");

					
			} else {
					$_SESSION['exists']  = "Something went wrong while updating the record.";
      				header("Location: appointment.php");
			}
    }







    // MARK AS READ PATIENT MESSAGE
	if(isset($_GET['mark_as_read'])) {

		$msg_Id = $_GET['mark_as_read'];

			$update = mysqli_query($conn, "UPDATE message SET msg_read=1 WHERE msg_Id='$msg_Id'");
			if($update) {
					header("Location: messages.php");
			} else {
					header("Location: messages.php");
			}
	}



	if(isset($_POST['not_available'])) {

		$therapist_Id = $_POST['therapist_Id'];

			$update = mysqli_query($conn, "UPDATE therapist SET availability='Not available' WHERE therapist_Id='$therapist_Id'");
			if($update) {
					echo "<script>
					             alert('Availability has been set to Not available.'); 
					             window.history.go(-1);
					     </script>";
			} else {
					echo "<script>
					             alert('Something went wrong.'); 
					             window.history.go(-1);
					     </script>";
			}
	}






	if(isset($_POST['available'])) {

		$therapist_Id = $_POST['therapist_Id'];

			$update = mysqli_query($conn, "UPDATE therapist SET availability='Available' WHERE therapist_Id='$therapist_Id'");
			if($update) {
					echo "<script>
					             alert('Availability has been set to Available.'); 
					             window.history.go(-1);
					     </script>";
			} else {
					echo "<script>
					             alert('Something went wrong.'); 
					             window.history.go(-1);
					     </script>";
			}
	}


?>