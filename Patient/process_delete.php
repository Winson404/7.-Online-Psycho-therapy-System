<?php 
	session_start();
	include '../config.php';

	if(isset($_POST['delete_missing'])) {
		$post_Id = $_POST['post_Id'];

		$delete = mysqli_query($conn, "DELETE FROM posted WHERE post_Id='$post_Id'");
		if($delete) {
			$_SESSION['success']  = "Record has been deleted!";
	        header("Location: posted.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: posted.php");
		}
	}



	// DELETE APPOINTMENT
	if(isset($_POST['delete_appointment'])) {
		
		$appointment_Id = $_POST['appointment_Id'];

		$delete = mysqli_query($conn, "DELETE FROM new_appointment WHERE appointment_Id='$appointment_Id'");
		if($delete) {
			$_SESSION['success']  = "Appointment has been deleted!";
	        header("Location: appointment.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: appointment.php");
		}
	}




	// DELETE THERAPIST MESSAGE
	if(isset($_POST['delete_message'])) {
		
		$msg_Id = $_POST['msg_Id'];

		$delete = mysqli_query($conn, "UPDATE message SET patient_delete=1 WHERE msg_Id='$msg_Id'");
		if($delete) {
			$_SESSION['success']  = "Message has been deleted!";
	        header("Location: messages.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the message. Please try again.";
            header("Location: messages.php");
		}
	}




	// DELETE PAYMENT
	if(isset($_POST['delete_payment'])) {
		
		$new_payment_Id = $_POST['new_payment_Id'];

		$delete = mysqli_query($conn, "DELETE FROM new_payment WHERE new_payment_Id='$new_payment_Id'");
		if($delete) {
			$_SESSION['success']  = "Payment has been deleted!";
	        header("Location: new_payment.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: new_payment.php");
		}
	}

?>