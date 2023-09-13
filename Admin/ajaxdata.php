	<?php

	include '../config.php';


	//ADD: GET CONSULT FEE AUTOMATICALLY
	if(isset($_POST['therapist_Id'])) {
		$therapist_Id = $_POST['therapist_Id'];
		$fetch = mysqli_query($conn, "SELECT * FROM consultancy_fee WHERE consult_fee_therapist_Id='$therapist_Id'"); 
	?>
		<?php 
			while ($row = mysqli_fetch_array($fetch)) {
		?>
		<option value="<?php echo $row['consult_fee_Id']; ?>" selected><?php echo $row['consult_fee']; ?></option>
		<?php 
			} 
		?>

		<?php
	}
?>




<?php
	//ADD: GET TOTAL AMOUNT TO PAY AUTOMATICALLY
	if(isset($_POST['hours'])) {
		$hours = $_POST['hours'];
		$fee   = $_POST['fee'];
		

		$select  = mysqli_query($conn, "SELECT * FROM consultancy_fee WHERE consult_fee_Id='$fee'");
		$rows = mysqli_fetch_array($select);
		$fee_value = $rows['consult_fee'];

		$total = $hours * $fee_value; 
		?>


		<option value="<?php echo $total; ?>" selected><?php echo $total; ?></option>

		<?php 

	}
?>




<?php 


	// ADD APPOINTMENT
	if(isset($_POST['update_therapist_Id'])) {
		$therapist_Id = $_POST['update_therapist_Id'];
		$fetch = mysqli_query($conn, "SELECT * FROM consultancy_fee WHERE consult_fee_therapist_Id='$therapist_Id'"); 
	?>
		<?php 
			while ($row = mysqli_fetch_array($fetch)) {
		?>
		<option value="<?php echo $row['consult_fee_Id']; ?>" selected><?php echo $row['consult_fee']; ?></option>
		<?php 
			} 
		?>

		<?php
	}



?>