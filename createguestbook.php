<?php
	
		$DSN = 'mysql:host=localhost;dbname=bincom_todo';
 		$ConnectingDB = new PDO($DSN,'root','');

 		session_start();
echo "just testing";
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
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>create a guestbook</title>
	<link rel="stylesheet" type="text/css" href="guestbook.css">
</head>
<body>


	<h1>Bincom Assessment: Guestbook/ Create Guestbook</h1>

	<?php
		if (isset($_POST['bookRoom'])) {
			if (empty($_POST['fullname'])) {
				echo "<p class='errormsg'> Please enter the name of guest... </p>";
			}else{
				$fullname = $_POST['fullname'];
				$duration = $_POST['duration'];
				$room = $_POST['roomtype'];
					$duration = $_POST['duration'];
					if(($room == "choose") || ($duration == "choose")){
						echo '<p class="pending-price"> Please select the room and duration</p>';
					}else{
						if($room == "presidential"){
							$price = 35000 * $duration;
							$roomNum = 301;
							
						}elseif($room == "innhouse_Room"){
							$price = 10000 * $duration;
							$roomNum = 167;
							
						}elseif($room == "governor"){
							$price = 20000 * $duration;
							$roomNum = 222;
							
						}
						
					}


				// START
				global $ConnectingDB;
				$sql = "INSERT INTO guestbook(fullname, roomtype, roomNum, duration, price)";
				$sql .= "VALUES(:fullname, :roomtype,:roomNum, :duration, :price)";

				$stmt = $ConnectingDB->prepare($sql);
				$stmt->bindValue(':fullname', $fullname);
				$stmt->bindValue(':roomtype', $room);
				$stmt->bindValue(':roomNum', $roomNum);
				$stmt->bindValue(':duration', $duration);
				$stmt->bindValue(':price', $price);
							
				$Execute = $stmt->execute();
					if ($Execute) {
					// echo "<p class='successmsg'> task has been added successfully </p>";
						$_SESSION["SuccessMessage"]= "Guestbook created successfully";
				header("Location:" . 'booking_sys.php');
				} else {
					$_SESSION["ErrorMessage"]= "Something went wrong. Try again";
				}
				// FINISH
			}
		}
		
	?>
	<form method="POST" action="createguestbook.php">
		
		<div>
			<p>Create Guestbook</p>
			<div>
				<input type="text" name="fullname" placeholder="Enter fullname">
			</div>
			<div class="select">
				<label for="roomtype">City:</label>
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


			<div>
				<input type="submit" name="price" value="view price">
			</div>

			<?php
				if(isset($_POST['price'])){
					$room = $_POST['roomtype'];
					$duration = $_POST['duration'];
					if(($room == "choose") || ($duration == "choose")){
						echo '<p class="pending-price"> Please select the room and duration</p>';
					}else{
						if($room == "presidential"){
							$price = 35000 * $duration;

							echo '<p class="pending-price">' .number_format($price).'</p>';
						}elseif($room == "innhouse_Room"){
							$price = 10000 * $duration;
							echo '<p class="pending-price">' .number_format($price).'</p>';
							
						}elseif($room == "governor"){
							$price = 20000 * $duration;
							echo '<p class="pending-price">' .number_format($price).'</p>';
							
						}
						
					}
				}


				// submit


			?>

			<div class="bookroom"><input type="submit" name="bookRoom" value="Book Accommodation"></div>
		</div>
	</form>

</body>
</html>