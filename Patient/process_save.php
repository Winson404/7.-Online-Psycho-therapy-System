<?php 

		session_start();
		include '../config.php';

		if(isset($_POST['save'])) {

			$user_Id							   = $_POST['user_Id'];
			$city_from               = $_POST['city_from'];
			$name                    = $_POST['name'];
			$Disappearance           = $_POST['Disappearance'];
			$gender                  = $_POST['gender'];
			$dob                     = $_POST['dob'];
			$Pronouns                = $_POST['Pronouns'];
			$Race                    = $_POST['Race'];
			$Height                  = $_POST['Height'];
			$Weight                  = $_POST['Weight'];
			$Hair                    = $_POST['Hair'];
			$Headhair                = $_POST['Headhair'];
			$dye                     = $_POST['dye'];
			$eye                     = $_POST['eye'];
			$teeth                   = $_POST['teeth'];  //ARRAY
			$scars                   = $_POST['scars'];
			$Piercings               = $_POST['Piercings'];
			$Tattoos                 = $_POST['Tattoos'];
			$Clothing                = $_POST['Clothing'];
			$Footwear                = $_POST['Footwear'];
			$Shoe                    = $_POST['Shoe'];
			$Coat                    = $_POST['Coat'];
			$Head                    = $_POST['Head'];
			$Jewelry                 = $_POST['Jewelry'];
			$Eyewear                 = $_POST['Eyewear'];
			$Illnesses               = $_POST['Illnesses'];
			$Medication              = $_POST['Medication'];
			$History                 = $_POST['History'];
			$Hobbies                 = $_POST['Hobbies'];
			$gadget                  = $_POST['gadget']; //ARRAY
			$Cell                    = $_POST['Cell'];
			$PersonEmail             = $_POST['PersonEmail'];
			$Lastlocation            = $_POST['Lastlocation'];
			$personwith              = $_POST['personwith'];
			$Personaddress           = $_POST['Personaddress'];
			$Phonelastperson         = $_POST['Phonelastperson'];
			$workschool              = $_POST['workschool'];
			$Schooladdress           = $_POST['Schooladdress'];
			$Schoolcontact           = $_POST['Schoolcontact'];
			$datefiled               = $_POST['datefiled'];
			$Time                    = $_POST['Time'];
			$repeatmissing           = $_POST['repeatmissing'];
			$lawagency               = $_POST['lawagency'];
			$Assigned                = $_POST['Assigned'];
			$Enforcement             = $_POST['Enforcement'];
			$Case                    = $_POST['Case'];
			$reward                  = $_POST['reward'];
			$Family_Guardian         = $_POST['Family_Guardian'];
			$Relationship            = $_POST['Relationship'];
			$Authorized_Email  	   	 = $_POST['Authorized_Email'];
			$Authorized_fb           = $_POST['Authorized_fb'];
			$Comments   					   = $_POST['Comments'];
			$Completing              = $_POST['Completing'];
			$Relationship_to_Missing = $_POST['Relationship_to_Missing'];
			$Contact_completingform  = $_POST['Contact_completingform'];
			$file                    = basename($_FILES["fileToUpload"]["name"]);

			$all_teeth=""; 

  	  foreach($teeth as $teeths)  
      {  
         $all_teeth .= $teeths.",";  
      } 

      $all_gadget=""; 

  	  foreach($gadget as $gadgets)  
      {  
         $all_gadget .= $gadgets.",";  
      } 

			 			  // Check if image file is a actual image or fake image
		          $target_dir = "../images-missing/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	                  $_SESSION['error']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
	                  header("Location: posted_add.php");         
                  	$uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  if ($uploadOk == 0) {
	                  $_SESSION['error']  = "Your file was not uploaded.";
	                  header("Location: posted_add.php");         
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	 $save = mysqli_query($conn, "INSERT INTO posted (user_Id, city_from, name, disappearance_date, gender, dob, pronouns, race, height, weight, hair_color, head_color, dye_color, eye, teeth, scars, piercings, tattoos, clothing, footwear, shoe_size, coat, 	head_wear, jewelry, eyewear, illnesses, medication, drugs_alcohol, hobbies, gadgets, contact, email, last_location, last_person_with, last_person_with_address, last_person_with_contact, work_school_name, work_school_address, 	work_school_contact, date_report_filed, time_missing, repeat_missing, agency_enforcement,	officer, agency_phone, emergency_number, reward, family_contact, relationship_to_missing, family_email, family_fb, comments, name_who_fill_up, name_who_fill_up_relationship, name_who_fill_up_contact, posted_image) VALUES ('$user_Id', '$city_from', '$name', '$Disappearance', '$gender', '$dob', '$Pronouns', '$Race', '$Height', '$Weight', '$Hair', '$Head', '$dye', '$eye', '$all_teeth', '$scars', '$Piercings', '$Tattoos', '$Clothing', '$Footwear', '$Shoe', '$Coat', '$Head', '$Jewelry', '$Eyewear', '$Illnesses', '$Medication', '$History', '$Hobbies', '$all_gadget', '$Cell', '$PersonEmail', '$Lastlocation', '$personwith', '$Personaddress', '$Phonelastperson', '$workschool', '$Schooladdress', '$Schoolcontact', '$datefiled', '$Time', '$repeatmissing', '$lawagency', '$Assigned', '$Enforcement', '$Case', '$reward', '$Family_Guardian', '$Relationship', '$Authorized_Email', '$Authorized_fb', '$Comments', '$Completing', '$Relationship_to_Missing', '$Contact_completingform', '$file')");

                            if($save) {
	                             $_SESSION['success']  = "Missing person's information has been posted!";
	                             header("Location: posted.php");
                            } else {
                             	 $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
	                             header("Location: posted_add.php");      
                            }

                      } else {
                            	 $_SESSION['exists'] = "There was an error uploading your file.";
	                             header("Location: posted_add.php");         
                      }
				 					
				 					}

		}





		// CREATE APPOINTMENT
		if(isset($_POST['create_appointment'])) {
			$id           = $_POST['patient_Id'];
			$therapist    = $_POST['therapist'];
			$date         = $_POST['date'];
			$time         = $_POST['time'];



			$exist = mysqli_query($conn, "SELECT * FROM new_appointment WHERE appointment_patient_Id='$id' AND appointment_therapist_Id='$therapist' AND (appointment_status='Pending' || appointment_status='Approved')"); 
			if(mysqli_num_rows($exist)>0) {
					$_SESSION['exists'] = "You already have set an appointment with this therapist.";
          header("Location: appointment.php");    
			} else {

$save = mysqli_query($conn, "INSERT INTO new_appointment (appointment_patient_Id, appointment_therapist_Id, appointment_date, appointment_time) VALUES ('$id', '$therapist', '$date', '$time')");

							if($save) {
				         $_SESSION['success']  = "You have successfully added an appointment.";
				         header("Location: appointment.php");
				      } else {
				       	 $_SESSION['exists'] = "Something went wrong while saving the information. Please try again.";
				         header("Location: appointment.php");      
				      }


					


			}
		}



		if(isset($_POST['new_payment'])) {

			$or_number	  = $_POST['or_number'];
			$id           = $_POST['patient_Id'];
			$therapist    = $_POST['therapist'];
			$fee          = $_POST['fee'];
			$no_of_hours  = $_POST['no_of_hours'];
			$total_amount = $_POST['total_amount'];
			$amount_to_pay= $_POST['amount_to_pay'];
			$date         = date('Y-m-d');

			$balance = $total_amount - $amount_to_pay;

			$admin = mysqli_query($conn, "SELECT * FROM admin");
			$row_admin = mysqli_fetch_array($admin);
			$admin_Id = $row_admin['admin_Id'];

			$save = mysqli_query($conn, "INSERT INTO new_payment (OR_num, new_payment_patient_Id, new_payment_therapist_Id, new_payment_consultancy_fee_Id, no_of_hours, total_amount_payable, total_amount_to_paid, balance, date_paid) VALUES ('$or_number', '$id', '$therapist', '$fee', '$no_of_hours', '$total_amount', '$amount_to_pay', '$balance', '$date')");
			if($save) {
		         $insert = mysqli_query($conn, "INSERT INTO admin_payment (admin_payment_patient_Id, admin_payment_therapist_Id, admin_payment_admin_Id, OR_num) VALUES ('$id','$therapist', '$admin_Id', '$or_number')");
		         if($insert) {
		         	$_SESSION['success']  = "Payment successful.";
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





		// PAYMENT
		if(isset($_POST['payment'])) {

			$or_number		 = $_POST['or_number'];
			$admin_Id       = $_POST['admin_Id'];
			$appointment_Id = $_POST['appointment_Id'];
			$patient_Id     = $_POST['patient_Id'];
			$therapist_Id   = $_POST['therapist_Id'];
			$total_payable  = $_POST['total_payable'];
			$amount_to_pay  = $_POST['amount_to_pay'];
			$date           = date('Y-m-d');


			$admin_percentage = 40;
			$therapist_percentage = 60;

			$balance = $total_payable - $amount_to_pay;

			$admin_commission = ($admin_percentage / 100) * $amount_to_pay;            // ADMIN COMMISSION
			$therapist_commission = ($therapist_percentage / 100) * $amount_to_pay;    // THERAPIST COMMISSION

			
			$save = mysqli_query($conn, "INSERT INTO payment (OR_num, payment_admin_Id, payment_patient_Id, payment_therapist_Id, total_payable, amount_paid, balance, admin_commission, therapist_commission, date_paid) VALUES ('$or_number', '$admin_Id', '$patient_Id', '$therapist_Id', '$total_payable', '$amount_to_pay', '$balance', '$admin_commission', '$therapist_commission', '$date')");
			if($save) {
		         $_SESSION['success']  = "Paid successful.";
		         header("Location: payment.php?appointment_Id=$appointment_Id");
		      } else {
		       	 $_SESSION['exists'] = "Error.";
		         header("Location: payment.php?appointment_Id=$appointment_Id");      
		      }
		}






		// ADD COMMENT
		if(isset($_POST['add_comment'])) {

			$therapist_Id = $_POST['therapist_Id'];
			$patient_Id   = $_POST['patient_Id'];
			$comment      = $_POST['comment'];
			$date         = date('Y-m-d');

			$save = mysqli_query($conn, "INSERT INTO message (msg_therapist_Id, msg_patient_Id, msg_comment, msg_date_added) VALUES ('$therapist_Id', '$patient_Id', '$comment', '$date') ");
			if($save) {
		         $_SESSION['success']  = "Message has been sent.";
		         header("Location: new_payment.php");
		      } else {
		       	 $_SESSION['exists'] = "Meesage not sent.";
		         header("Location: new_payment.php");  
		      }
		}


		// ADD REPLY 
		if(isset($_POST['add_reply'])) {

			$msg_Id       = $_POST['msg_Id'];
			$msg_comment  = $_POST['msg_comment'];
			$therapist_Id = $_POST['therapist_Id'];
			$patient_Id   = $_POST['patient_Id'];
			$comment      = $_POST['comment'];
			$date         = date('Y-m-d');

			if(!empty($msg_comment)) {

				$save = mysqli_query($conn, "INSERT INTO message (msg_therapist_Id, msg_patient_Id, msg_comment, msg_date_added) VALUES ('$therapist_Id', '$patient_Id', '$comment', '$date') ");
				if($save) {
			         $_SESSION['success']  = "Message has been sent.";
			         header("Location: messages.php");
			      } else {
			       	 $_SESSION['exists'] = "Meesage not sent.";
			         header("Location: messages.php");  
			      }

			} else {
				
			      $save = mysqli_query($conn, "UPDATE message SET msg_comment='$comment', msg_date_added='$date' WHERE msg_Id='$msg_Id' ");

					if($save) {
				       $_SESSION['success']  = "Message has been sent.";
				       header("Location: messages.php");
				    } else {
				     	 $_SESSION['exists'] = "Message not sent.";
				       header("Location: messages.php");      
				    }
			}

			
		}




		// REPLY THERAPIST
	// 	if(isset($_POST['reply'])) {

	// 	$patient_Id   = $_POST['patient_Id'];
	// 	$therapist_Id = $_POST['therapist_Id'];
	// 	$comment      = $_POST['comment'];
	// 	$date         = date('Y-m-d');

	// 	$save = mysqli_query($conn, "INSERT INTO message (msg_therapist_Id, msg_patient_Id, msg_comment, msg_date_added) VALUES ('$therapist_Id', '$patient_Id', '$comment', '$date') ");

	// 	if($save) {
 //       $_SESSION['success']  = "Message has been sent.";
 //       header("Location: messages.php");
 //    } else {
 //     	 $_SESSION['exists'] = "Message not sent.";
 //       header("Location: messages.php");      
 //    }


	// }

?>