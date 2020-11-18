<?php
	
	include 'connect.php';
	$conn = OpenCon();

	session_start();

	//$_SESSION["userID"] = 1; // HARDCODED USER ID FOR LOCAL TESTING PURPOSES, REMOVE LATER
		
	// Determine if the current user is a counsellor or help seeker
	// NOTE: This function may need to be refactored to be in the login page instead
	function setUserType() {
		global $conn;

		$sql = "SELECT COUNT(1)
				FROM helpSeeker
				WHERE userID =".$_SESSION['userID'];

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$num = $row["COUNT(1)"];

		if($num == 1) {
			$_SESSION["userType"] = "helpSeeker";
		} else {
			$_SESSION["userType"] = "counsellor";
		}
	}

	// Display basic information of user
	function showBasicInfo() {

		global $conn;  
		$sql = "SELECT name, age, location, email, phone FROM Users WHERE userID =". $_SESSION['userID'];
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		echo "<p><b>Name: </b>".$row["name"]."</p>
			  <p><b>Age: </b>".$row["age"]."</p>
			  <p><b>Location: </b>".$row["location"]."</p>
			  <p><b>Email: </b>".$row["email"]."</p
			  <p><b>Phone: </b>".$row['phone']."</p>";
	}

	// Display basic user profile information
	function showProfilePicture() {

		if($_SESSION["userType"] == "helpSeeker") {
			echo "<img src='../cpsc304/assets/helpseeker-pfp.png' class='img-fluid img-max'>";
		} else {
			echo "<img src='../cpsc304/assets/counsellor-pfp.png' class='img-fluid img-max'>";
		}
	}

	// Display counsellor details if user is a counsellor
	function showCounsellorDetails() {

		global $conn;

		// Fetch yearsOfExperience, certification 
		$sql = "SELECT yearsExperience, certification, numPatients 
				FROM counsellor
				WHERE userID =".$_SESSION['userID'];
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		echo "<p><b>Years of Experience: </b>".$row["yearsExperience"]."</p>
			  <p><b>Certification: </b>".$row["certification"]."</p>";
		
		// Fetch the average rating for a counsellor
		$sql = "SELECT AVG(R.rating) AS AvgRating
				FROM review R
				GROUP BY R.counsellor
				HAVING R.counsellor =".$_SESSION["userID"];
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if (mysqli_num_rows($result)==0) {
			echo "<p><b>Average Rating: </b> No Ratings Yet </p>";
		} else {
			echo "<p><b>Average Rating: </b>".$row["AvgRating"]."</p>";
		}

		// Fetch the number of patients based on number of unique helpSeekers
		$sql = "SELECT COUNT(DISTINCT A.helpSeekerID) AS numOfPatients
				FROM Appointment A
				GROUP BY A.counsellorID
				HAVING A.counsellorID =".$_SESSION["userID"];
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		echo "<p><b>Number of Patients: </b>".$row["numOfPatients"]."</p>";

		// Fetch the counsellor's level based on their yearsOfExperience
		$sql = "SELECT level
				FROM Counsellor C, Counselloryearsexperience CY
				WHERE C.yearsExperience = CY.yearsExperience AND 
	  				  C.userID =".$_SESSION["userID"];
	  	$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		echo "<p><b>Level: </b>".$row["level"]."</p>";

	}

	// Display the hotlines related to the user
	function showHotlines() {

		global $conn;
		$sql = "";

		if($_SESSION["userType"] == "helpSeeker") {
			echo "<p><b> Favourite Hotlines </b></p>";

			$sql = "SELECT HL.name, HL.phoneNum, HL.typeOfHelp
					FROM Hotline HL, FavouriteHotline FH
					WHERE HL.phoneNum = FH.hotlineNum AND
	  					  FH.helpSeekerID =".$_SESSION["userID"];

		} else {
			echo "<p><b> Recommended Hotlines </b></p>";

			$sql = "SELECT HL.name, HL.phoneNum, HL.typeOfHelp
					FROM Hotline HL, RecommendedHotline RH
					WHERE HL.phoneNum = RH.hotlineNum AND
	  					  RH.counsellorID =".$_SESSION["userID"];
		}

	 	$result = $conn->query($sql);

	 	if(mysqli_num_rows($result)==0) {

	 		echo "You have no saved hotlines!";

	 	} else {

	 		echo "<table class='table mb-5 mr-3'>
				<thead>
					<tr>
						<th>Name</th>
						<th>Phone #</th>
						<th>Type of Help</th>
					</tr>
				</thead>";

	 		while($row = $result->fetch_assoc()) { 
				echo "<tr>
						<td>".$row["name"]."</td>
						<td>".$row["phoneNum"]."</td>
						<td>".$row["typeOfHelp"]."</td>
					  </tr>";
			}

			echo "</table>";
	 	}
		
	}

	// Display the resource centres related to the user
	function showCentres() {
		global $conn;

		$sql = "";

		if($_SESSION["userType"] == "helpSeeker") {
			echo "<p><b> Favourite Centres </b></p>";

			$sql = "SELECT RC.centreName, RC.address, RC.email, RC.phoneNum
					FROM ResourceCentre RC, FavouriteCentre FC
					WHERE RC.centreID = FC.centreID AND 
	  					  FC.helpSeekerID =".$_SESSION["userID"];
		} else {
			echo "<p><b> Recommended Centres </b></p>";

			$sql = "SELECT RC.centreName, RC.address, RC.email, RC.phoneNum
					FROM ResourceCentre RC, RecommendedCentre REC
					WHERE RC.centreID = REC.centreID AND 
	  					  REC.counsellorID =".$_SESSION["userID"];
		}

		$result = $conn->query($sql);

		if(mysqli_num_rows($result)==0) {

	 		echo "You have no saved resource centres!";

	 	} else {

	 		echo "<table class='table mb-5 mr-3'>
				<thead>
					<tr>
						<th>Center Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Phone #</th>
					</tr>
				</thead>
			 ";

	 		while($row = $result->fetch_assoc()) { 
				echo "<tr>
						<td>".$row["centreName"]."</td>
						<td>".$row["address"]."</td>
						<td>".$row["email"]."</td>
						<td>".$row["phoneNum"]."</td>
					  </tr>";
			}

			echo "</table>";

	 	}		

	}

?>

<!DOCTYPE html>
<html>
	
	<head>
		<!-- Bootstrap Stylesheet -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!-- Custom Stylesheet -->
		<link rel="stylesheet" href="styles/main.css">

		<!-- Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	</head>

	<body>

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">Mental Health Webapp</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
		 	<div class="collapse navbar-collapse" id="navbarNav">
		 		<ul class="navbar-nav">

		 			<li class="nav-item">
			        	<a class="nav-link" href="/cpsc304/profile.php">Profile</a>
			      	</li>

			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          	Appointments
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="/cpsc304/view-appointments.php">View Appointments</a>
				        	<a class="dropdown-item" href="/cpsc304/book-appointments.php">Book an Appointment</a>
				        </div>
			      	</li>

			     	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          		Reviews
			        	</a>
			        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			          		<a class="dropdown-item" href="/cpsc304/view-reviews.php">View Reviews</a>
			          		<a class="dropdown-item" href="/cpsc304/book-appointments.php">Write a Review</a>
			        	</div>
			      	</li>

			     	<li class="nav-item dropdown" aria-labelledby="navbarDropdownMenuLink">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          		Posts
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="#">View Posts</a>
				        	<a class="dropdown-item" href="#">Write a Post</a>
				        </div>
			      	</li>

			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          		Directories
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="/cpsc304/user-directory.php">Users</a>
				        	<a class="dropdown-item" href="/cpsc304/hotline-directory.php">Hotlines</a>
				        	<a class="dropdown-item" href="/cpsc304/resource-centre-directory.php">Resource Centers</a>
				        	<a class="dropdown-item" href="/cpsc304/types-of-help-directory.php">Types of Help</a>
				        </div>
			      	</li>
			      	
			    </ul>
	  		</div>
		</nav>
		
		<!-- Page content -->
		<?php setUserType() ?>
		<div class = "container">
			<h1 class = "text-center mt-5 mb-5"> User Profile </h1>
			<div class = "row">
				<div class ="col-3 mr-3 text-center">
					<?php showProfilePicture() ?>
				</div>
				<div class ="col">
					<?php showBasicInfo() ?>
					<a href="/cpsc304/edit-profile.php" class="btn btn-success mr-2">Edit Profile</a>
					<a href="/cpsc304/delete-profile.php" class="btn btn-danger">Delete Account</a>
				</div>
				<div class = "col">
					<?php 
						if($_SESSION["userType"] == "counsellor") {
							showCounsellorDetails();
						}
					?>
				</div>
			</div>
			<div class = "row mt-5">
				<div class = "col text-center">
					<?php showHotlines() ?>
				</div>
				<div class = "col text-center">
					<?php showCentres() ?>
				</div>
			</div>
		</div>
	</body>
	<?php CloseCon($conn) ?>
</html>