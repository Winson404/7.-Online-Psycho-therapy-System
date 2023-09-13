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




	// DELETE MESSAGE
	if(isset($_POST['delete_message'])) {
		$msg_Id = $_POST['msg_Id'];

		$delete = mysqli_query($conn, "UPDATE message SET therapist_delete=1 WHERE msg_Id='$msg_Id'");
		if($delete) {
			$_SESSION['success']  = "Message has been deleted!";
	        header("Location: messages.php");   
		} else {
			$_SESSION['exists'] = "Something went wrong while deleting the message. Please try again.";
            header("Location: messages.php");
		}
	}

?>