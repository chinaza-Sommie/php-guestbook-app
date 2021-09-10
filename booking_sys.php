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
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Guest Booking System</title>
	<style type="text/css">

		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body{
			/*background-color: #591a1a7a;*/
			background-color: #591a1a4f;
		}

		h1{
			text-align: center;
			font-style: italic;
			padding: 10px 0;
			background-color: #591a1a;
			color: white;
			margin-bottom: 30px;
		}

		.hero{
			display: flex;
			justify-content: center;
			width: 100%;
			margin-top: 40px;
		}

		.hero>div{
			display: flex;
			justify-content: space-between;
			width: 80%;
		}

		.hero div div{
			width:45%;
			/*border: 1px solid yellow;*/
		}

		.hero-welcome{
			font-size: 31px;
			color: #591a1a;
			font-style: italic;
			font-weight: bold;
			line-height: 50px;
		}

		.hero-name{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.hero-name div{
			background-color: #591a1a;
			color:white;
			font-size: 30px;
			padding: 20px;
			padding:50px 40px 40px 40px;
			border-radius: 70% 30% 30% 70% / 60% 40% 60% 40%;
			height: 200px;
		}

		.guestbook-cont{
			border-top: 1px solid #591a1a;
			display: flex;
			padding: 20px;
			margin-top: 30px;
		}

		.guestbook-cont>div{
			border: 1px solid #591a1a;
			width: 25%;
			padding: 5px 10px;
			/*background-color: #591a1a7a;*/
			background-color: #591a1a42;
			margin: 0 10px;
		}

		.guest-name{
			display: flex;
			justify-content: space-between;
			padding: 5px 10px;
			border-bottom: 1px solid #591a1a;
		}

		.Name{
			font-size: 21px;
			font-style: italic;
		}

		.room-det{
			font-weight: bold;
			color: #591a1a;
			padding: 20px 0;
			font-size: 20px;
			border-bottom: 1px solid #591a1a4f;
		}

		.room-det p span{
			font-weight: normal;
			color: black;
		}

		.room-price{
			display: flex;
			justify-content: space-between;
			padding:10px;
			font-weight: bold;
			color: #591a1a;

		}

		.room-price p span{
			font-size: 18px;
			font-style: italic;
		}

		.guestbook-features{
			margin-top: 10px;
			border-top: 1px solid #591a1a;
			display: flex;
			justify-content: space-between;
			padding: 20px 10px;
		}

		.guestbook-features a{
			text-decoration: none;
			border: 1px solid #591a1a;
			width: 40%;
			text-align: center;
			padding: 10px;
			border-radius: 5px;
			background-color: #591a1a;
			color: white;
			transition: 0.5s;
		}

		.guestbook-features a:hover{
			cursor: pointer;
			background-color: inherit;
			color: #591a1a;
			font-weight: bold;
		}

		.add{
			font-size: 25px;
			background-color: inherit;
		}
		.add a{
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
			text-decoration: none;
			color: #591a1a;
			font-weight: bold;
		}

		.add a:hover{
			background-color: #591a1a4f;
		}

		.errormsg{
			color:red;
			font-style: italic;
			font-weight: bold;
			text-align: center;
		}

		.successmsg{
			color:green;
			font-style: italic;
			font-size: 21px;
			margin-top: 20px;
			font-weight: bold;
			text-align: center;
		}

		@media (max-width: 700px){
			.hero-name{
				display: block;
			}
			.guestbook-cont>div{
				width:100%;
			}
		}
	</style>
</head>
<body>

	<h1>Bincom Assessment: Guestbook</h1>

	<div class="hero">
		<div>
			<div class="hero-welcome">Welcome, <br> 
				Our lobby reservations are at your service
			</div>

			<div class="hero-name">
				<div>
					Lobby<br>Reservation
				</div>
			</div>
		</div>
	</div>

	<?php
		echo ErrorMessage();
				echo SuccessMessage();
	?>
	<div class="guestbook-cont">

		<div>
			<div class="guest-name">
				<p class="Name">John Doe </p>
				<p> 25 Aug, 2020</p>
			</div>

			<div class="room-det">
				<p>Room No: <span>215 </span></p>
				<p> Room type: <span> Presidential Suite </span></p>
			</div>

			<div class="room-price">
				<p>Amount: <span>N 200,000 </span></p>
				<p>Duration: <span> 5 days</span></p>
			</div>

			<div class="guestbook-features">
				<a href=""> Edit </a>
				<a href=""> Delete </a>
			</div>
		</div>


		<?php

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
	
		?>
			<div>
				<div class="guest-name">
					<p class="Name"><?php echo $fullname; ?> </p>
					<p> 
						<?php 
		   			 				$dateadded = strtotime($dateadded);
		    						$dateadded = date('d M, Y', $dateadded);
		    						echo $dateadded;
								?>
					</p>
				</div>

				<div class="room-det">
					<p>Room No: <span><?php echo $roomNum; ?> </span></p>
					<p> Room type: <span><?php echo $roomtype; ?> suite </span></p>
				</div>

				<div class="room-price">
					<p>Amount: <span>N <?php echo number_format($price); ?></span></p>
					<p>Duration: <span><?php echo $duration; ?> days</span></p>
				</div>

				<div class="guestbook-features">
					<a href="editguestbook.php?editguestbook=<?= $guestid;?>"> Edit </a>
					<a href="deleteguestbook.php?deleteguestId=<?= $guestid;?>"> Delete </a>
				</div>
			</div>
		<?php }?>


		<div class="add">
			<a href="createguestbook.php">
				ADD GUEST
			</a>
		</div>
	</div>
</body>
</html>