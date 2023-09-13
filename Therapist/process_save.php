<?php 

		session_start();
		include '../config.php';

		






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
                       $_SESSION['success']  = "You have successfully updated your credential image.";
                       header("Location: credential.php");
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




	if(isset($_POST['reply'])) {

		$msg_Id          = $_POST['msg_Id'];
		$therapist_reply = $_POST['therapist_reply'];
	  $patient_Id      = $_POST['patient_Id'];
		$therapist_Id    = $_POST['therapist_Id'];
		$comment         = $_POST['comment'];
		$date            = date('Y-m-d');
   

		if(!empty($therapist_reply)) {

				$c = mysqli_query($conn, "INSERT INTO message (msg_therapist_Id	, msg_patient_Id, therapist_reply, therapist_date_replied) VALUES ('$therapist_Id', '$patient_Id', '$comment', '$date')");
				if($c) {
		       $_SESSION['success']  = "Message has been sent.";
		       header("Location: messages.php");
		    } else {
		     	 $_SESSION['exists'] = "Message not sent.";
		       header("Location: messages.php");      
		    }

		} else {

				$save = mysqli_query($conn, "UPDATE message SET therapist_reply='$comment', therapist_date_replied='$date' WHERE msg_Id='$msg_Id' ");

				if($save) {
		       $_SESSION['success']  = "Message has been sent.";
		       header("Location: messages.php");
		    } else {
		     	 $_SESSION['exists'] = "Message not sent.";
		       header("Location: messages.php");      
		    }

		}

		

	}




	// ADD REPLY 
		if(isset($_POST['add_reply'])) {

			$therapist_Id = $_POST['therapist_Id'];
			$patient_Id   = $_POST['patient_Id'];
			$comment      = $_POST['comment'];
			$date         = date('Y-m-d');

			$save = mysqli_query($conn, "INSERT INTO message (msg_therapist_Id, msg_patient_Id, msg_comment, msg_date_added) VALUES ('$therapist_Id', '$patient_Id', '$comment', '$date') ");
			if($save) {
		         $_SESSION['success']  = "Message has been sent.";
		         header("Location: messages.php");
		      } else {
		       	 $_SESSION['exists'] = "Meesage not sent.";
		         header("Location: messages.php");  
		      }

		}

?>