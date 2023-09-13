<?php 

	session_start();
	include 'config.php';

	// ADMIN / EMPLOYER LOGIN
	if(isset($_POST['login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		$check = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password' AND user_type='Admin'");
		if(mysqli_num_rows($check)===1) {

				$row = mysqli_fetch_array($check);
				if($row['email'] === $email && $row['password'] === $password) {
					$_SESSION['admin_Id'] = $row['admin_Id'];
					header("Location: Admin/dashboard.php");
				} else {
					///$_SESSION['exists'] = "Password is incorrect. Try again!"; 
	               // $script =  "<script> $(document).ready(function(){ $('#employerlogin').modal('show'); }); </script>";  
	                //header("Location: index.php"); 
	                echo '<script>alert ("Password is incorrect. Please try again.");
	                		window.history.go(-1);
	                	  </script>';
				}
			
		} else {
				
				$check2 = mysqli_query($conn, "SELECT * FROM patient WHERE email='$email' AND password='$password' AND patient_status='Confirmed'");
                if(mysqli_num_rows($check2)===1) {

					$row = mysqli_fetch_array($check2);
					if($row['email'] === $email && $row['password'] === $password) {
						$_SESSION['patient_Id'] = $row['patient_Id'];
						header("Location: Patient/dashboard.php");
					} else {
						///$_SESSION['exists'] = "Password is incorrect. Try again!"; 
		               // $script =  "<script> $(document).ready(function(){ $('#employerlogin').modal('show'); }); </script>";  
		                //header("Location: index.php"); 
		                echo '<script>alert ("Password is incorrect. Please try again.");
		                		window.history.go(-1);
		                	  </script>';
					}
					
				} else {

						$check2 = mysqli_query($conn, "SELECT * FROM therapist WHERE therapist_email='$email' AND password='$password' AND status='Confirmed'");
						if(mysqli_num_rows($check2)===1) {

								$row = mysqli_fetch_array($check2);
								if($row['therapist_email'] === $email && $row['password'] === $password) {
									$_SESSION['therapist_Id'] = $row['therapist_Id'];
									header("Location: Therapist/dashboard.php");
								} else {
									///$_SESSION['exists'] = "Password is incorrect. Try again!"; 
					               // $script =  "<script> $(document).ready(function(){ $('#employerlogin').modal('show'); }); </script>";  
					                //header("Location: index.php"); 
					                echo '<script>alert ("Password is incorrect. Please try again.");
					                		window.history.go(-1);
					                	  </script>';
								}	
					
						} else {
								echo '<script>alert ("Password is incorrect. Please try again.");
				                		window.history.go(-1);
				                	  </script>';
						}
		         }
         }
	}
	

?>