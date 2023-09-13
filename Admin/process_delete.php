<?php 
	session_start();
	include '../config.php';

	// DELETE PATIENT
	if(isset($_POST['delete_patient'])) {
		$patient_id = $_POST['patient_Id'];

		$delete = mysqli_query($conn, "DELETE FROM patient WHERE patient_Id='$patient_id'");
		if($delete) {
			$_SESSION['success']  = "Patient information has been deleted!";
	        header("Location: patient.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: patient.php");
		}
	}


	// DELETE ADMIN
	if(isset($_POST['delete_admin'])) {
		$admin_Id = $_POST['admin_Id'];

		$delete = mysqli_query($conn, "DELETE FROM admin WHERE admin_Id='$admin_Id'");
		if($delete) {
			$_SESSION['success']  = "Admin information has been deleted!";
	        header("Location: admin.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: admin.php");
		}
	}



	// DELETE THERAPIST
	if(isset($_POST['delete_therapist'])) {
		$therapist_Id = $_POST['therapist_Id'];

		$delete = mysqli_query($conn, "DELETE FROM therapist WHERE therapist_Id='$therapist_Id'");
		if($delete) {
			$_SESSION['success']  = "Therapist information has been deleted!";
	        header("Location: therapist.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: therapist.php");
		}
	}



	// DELETE CONSULTANCY FEE
	if(isset($_POST['delete_consultancy_fee'])) {
		
		$consult_fee_Id = $_POST['consult_fee_Id'];

		$delete = mysqli_query($conn, "DELETE FROM consultancy_fee WHERE consult_fee_Id='$consult_fee_Id'");
		if($delete) {
			$_SESSION['success']  = "Therapist consultancy fee has been deleted!";
	        header("Location: consultancy_fee.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: consultancy_fee.php");
		}
	}


	// DELETE APPOINTMENT
	if(isset($_POST['delete_appointment'])) {
		
		$appointment_Id = $_POST['appointment_Id'];

		$delete = mysqli_query($conn, "DELETE FROM appointment WHERE appointment_Id='$appointment_Id'");
		if($delete) {
			$_SESSION['success']  = "Appointment has been deleted!";
	        header("Location: appointment.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the record. Please try again.";
            header("Location: appointment.php");
		}
	}
?>