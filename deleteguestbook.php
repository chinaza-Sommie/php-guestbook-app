<?php
	$DSN = 'mysql:host=localhost;dbname=bincom_todo';
 	$ConnectingDB = new PDO($DSN,'root','');

 	if (isset($_GET['deleteguestId'])) {
		$deleteguestId = $_GET['deleteguestId'];
		global $ConnectingDB;
		$sql= "DELETE FROM  guestbook WHERE id='$deleteguestId'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			
			header("Location:" . 'booking_sys.php');
			// echo "Gig deleted Successfully";
		}else{
			echo "Something went wrong. Try again";
			// Redirect_to("freelancerdashboard.php");
		}
	}else{
		header("Location:" . 'booking_sys.php');
		exit;
		echo "something went wrong";
	}
?>