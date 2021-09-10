<?php

		$DSN = 'mysql:host=localhost;dbname=bincom_todo';
 		$ConnectingDB = new PDO($DSN,'root','');

 		session_start();

 		function ErrorMessage(){
 		if(isset($_SESSION["ErrorMessage"])){
 			$Output = "<div class='errormsg'>";
 			$Output .=htmlentities($_SESSION["ErrorMessage"]);
 			$Output .= "</div>";
 			$_SESSION["ErrorMessage"] = null;
 			return $Output;
 		}
 	}

 	function SuccessMessage(){
 		if(isset($_SESSION["SuccessMessage"])){
 			$Output = "<div class='successmsg'>";
 			$Output .=htmlentities($_SESSION["SuccessMessage"]);
 			$Output .= "</div>";
 			$_SESSION["SuccessMessage"] = null;
 			return $Output;
 		}
 	}

	global $ConnectingDB;
	if (isset($_GET['editguestbook'])) {
		$editguestbook = $_GET['editguestbook'];

		$sql = "SELECT * FROM guestbook ORDER BY id desc";
			$stmttasks = $ConnectingDB->query($sql);
			while ($DataRows = $stmttasks->fetch()) {
				$guestid       = $DataRows['id'];
				$fullname 			= $DataRows['fullname'];
				$roomtype 			= $DataRows['roomtype'];
				$roomNum			= $DataRows['roomNum'];
				$duration			= $DataRows['duration'];
				$price				= $DataRows['price'];
				$dateadded			= $DataRows['dateadded'];
			}

		
	}elseif(isset($_POST['editguestbook'])){
			$fullname = $_POST['fullname'];
			$duration = $_POST['duration'];
			$roomtype = $_POST['roomtype'];
			$editguestval = $_POST['editguestid'];

			if (empty($fullname) && ($duration == "choose") && ($roomtype == "choose")) {
				$_SESSION["ErrorMessage"]= "No change was made";
				header("Location:" . 'booking_sys.php');

			}elseif(!empty($fullname) && (($duration == "choose") || ($roomtype == "choose"))){
				$_SESSION["ErrorMessage"]= "Please enter the guest's duration and room number";
				header("Location:" . 'booking_sys.php');

			}elseif ((!empty($fullname) && (($duration !== "choose") || ($roomtype !== "choose")))) {

				if($roomtype == "presidential"){
							$price = 35000 * $duration;
							$roomNum = 301;
							
						}elseif($roomtype == "innhouse_Room"){
							$price = 10000 * $duration;
							$roomNum = 167;
							
						}elseif($roomtype == "governor"){
							$price = 20000 * $duration;
							$roomNum = 222;
							
						}
					$sql = "UPDATE guestbook SET fullname='$fullname', roomtype='$roomtype', roomNum='$roomNum', duration='$duration',price='$price' WHERE id='$editguestval'";
				
				$Execute = $ConnectingDB->query($sql);
				
				if($Execute){
					$_SESSION["SuccessMessage"]= "Guestbook updated successfully";
					header("Location:" . 'booking_sys.php');
				}else{
					$_SESSION["ErrorMessage"]= "Something went wrong. Try again";
					header("Location:" . 'booking_sys.php');
				}
				
			}

		
	}else{
		header("Location:" . 'booking_sys.php');
		exit;
		echo "something went wrong";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Edit Guestbook</title>
	<link rel="stylesheet" type="text/css" href="guestbook.css">
</head>
<body>
	<h1>Bincom Assessment: Edit Guestbook</h1>

	<form method="POST" action="editguestbook.php">
		
		<div>
			<p>Create Guestbook</p>
			<div>
				<input type="text" name="fullname" value="<?php echo $fullname;?>" placeholder="Enter fullname">
			</div>
			<div class="select">
				<label for="roomtype">Room:</label>
				<select name="roomtype" id="roomtype">
			        <option value="choose">pick a room</option>
			        <option value="innhouse_Room">Innhouse Room - 167</option>
			        <option value="governor">Governor Suite - 222</option>
			        <option value="presidential">Presidential Lounge - 301</option>
			    </select>
			</div>

			<div class="select">
				<label for="duration">Duration:</label>
				<select name="duration" id="duration">
			        <option value="choose">select duration</option>
			        <option value="1">1 night</option>
			        <option value="2">2 days</option>
			        <option value="3">3 days</option>
			        <option value="7">4 - 7 days</option>
			        <option value="10">8 - 10 days</option>
			        <option value="14">2 weeks</option>
			        <option value="21">3 weeks</option>
			        <option value="30">1 month</option>
			        <option value="40">2 months</option>
			    </select>
			</div>

			<input type="hidden" name="editguestid" value="<?php echo $editguestbook;?>">
			

			<div class="bookroom"><input type="submit" name="editguestbook" value="Edit Guestbook"></div>
		</div>
	</form>
</body>
</html>