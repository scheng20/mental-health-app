<?php
	
	include 'connect.php';
	$conn = OpenCon();
	session_start();

	// Check if the helpseeker form is submitted
	if(isset($_POST['HelpSeekerSubmit'])){ 
		processHelpSeekerUpdate();
	} 

	// Check if the counsellor form is submitted
	if(isset($_POST['CounsellorSubmit'])){ 
		processCounsellorUpdate();
	} 

	// Display the helpSeeker update form
	function showHelpSeekerForm() {

		global $conn; 
		$sql = "SELECT * FROM Users WHERE userID =". $_SESSION['userID'];
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		echo "<form action = '' method='POST'>
				  <div class='form-row'>
				    <div class='col'>
				    	<label>Email</label>
				    	<input name='email' type='text' class='form-control' placeholder='Email' value = ".$row["email"].">
				    </div>
				    <div class='col'>
				    	<label>Password</label>
				    	<input name='password' type='password' class='form-control' placeholder='Password' value =".$row["password"].">
				    </div>
				  </div>
				  <div class='form-row mt-5'>
				    <div class='col'>
				    	<label>Name</label>
				    	<input name='name' type='text' class='form-control' placeholder='Name' value = ".$row["name"].">
				    </div>
				    <div class='col'>
				    	<label>Age</label>
				    	<input name='age' type='number' class='form-control' placeholder='Age' value =".$row["age"].">
				    </div>
				    <div class='col'>
				    	<label>Phone Number</label>
				    	<input name='phone' type='text' class='form-control' placeholder='Phone Number' value =".$row["phone"].">
				    </div>
				  </div>
				  <div class = 'form-row mt-5 float-right'>
				  	<button name='HelpSeekerSubmit' type='submit' class='btn btn-success mr-2'>Save Changes</button>
				  	<a href='/cpsc304/profile.php' class='btn btn-success'>Go Back</a>
				  </div>
			  </form>";
	}

	// Process the help seeker update
	function processHelpSeekerUpdate() {

		global $conn;

		$email = $_POST['email'];
		$password = $_POST['password'];
	  	$name = $_POST['name'];
	  	$age = $_POST['age'];
	  	$phone = $_POST['phone'];

	  	$sql = "UPDATE Users 
	  			SET email = '$email',
	  				password = '$password',
	  				name = '$name',
	  				age = '$age',
	  				phone = '$phone'
	  			WHERE userID =".$_SESSION["userID"];

	  	$conn->query($sql);
	}

	// Display the counsellors update form
	function showCounsellorForm() {

		global $conn; 
		$sql = "SELECT * 
				FROM Users U, Counsellor C 
				WHERE U.userID = C.userID AND 
				U.userID =". $_SESSION['userID'];
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		echo "<form action = '' method='POST'>
				  <div class='form-row'>
				    <div class='col'>
				    	<label>Email</label>
				    	<input name='email' type='text' class='form-control' placeholder='Email' value = ".$row["email"].">
				    </div>
				    <div class='col'>
				    	<label>Password</label>
				    	<input name='password' type='password' class='form-control' placeholder='Password' value =".$row["password"].">
				    </div>
				  </div>
				  <div class='form-row mt-5'>
				    <div class='col'>
				    	<label>Name</label>
				    	<input name='name' type='text' class='form-control' placeholder='Name' value = ".$row["name"].">
				    </div>
				    <div class='col'>
				    	<label>Age</label>
				    	<input name='age' type='number' class='form-control' placeholder='Age' value =".$row["age"].">
				    </div>
				    <div class='col'>
				    	<label>Phone Number</label>
				    	<input name='phone' type='text' class='form-control' placeholder='Phone Number' value =".$row["phone"].">
				    </div>
				  </div>
				  <div class='form-row mt-5'>
				    <div class='col'>
				    	<label>Years of Experience</label>
				    	<input name='experience' type='number' class='form-control' placeholder='Email' value = ".$row["yearsExperience"].">
				    </div>
				    <div class='col'>
				    	<label>Certification</label>
				    	<input name='certification' type='text' class='form-control' placeholder='Password' value =".$row["certification"].">
				    </div>
				  </div>
				  <div class = 'form-row mt-5 float-right'>
				  	<button name='CounsellorSubmit' type='submit' class='btn btn-success mr-2'>Save Changes</button>
				  	<a href='/cpsc304/profile.php' class='btn btn-success'>Go Back</a>
				  </div>
			  </form>";
	}

	// Process the counsellor update
	function processCounsellorUpdate() {

		global $conn;

		$email = $_POST['email'];
		$password = $_POST['password'];
	  	$name = $_POST['name'];
	  	$age = $_POST['age'];
	  	$phone = $_POST['phone'];
	  	$experience = $_POST['experience'];
	  	$certification = $_POST['certification'];

	  	$sql = "UPDATE Users 
	  			SET email = '$email',
	  				password = '$password',
	  				name = '$name',
	  				age = '$age',
	  				phone = '$phone'
	  			WHERE userID =".$_SESSION["userID"];

	  	$conn->query($sql);

	  	$sql = "UPDATE Counsellor
	  			SET yearsExperience = '$experience',
	  				certification = '$certification'
	  			WHERE userID =".$_SESSION["userID"];
	  	
	  	$conn->query($sql);
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
			          		<a class="dropdown-item" href="/cpsc304/write-reviews.php">Write a Review</a>
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

			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          		Leaderboard
			        	</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="/cpsc304/top-counsellor.php">Top Counsellor</a>
				        	<a class="dropdown-item" href="/cpsc304/active-counsellor.php">Most Active Counsellor</a>
				        	<a class="dropdown-item" href="/cpsc304/active-helpseeker.php">Most Active Help Seeker</a>
				        </div>
			      	</li>

			      	<li class="nav-item">
			        	<a class="nav-link" href="/cpsc304/lookup.php">Look Up</a>
			      	</li>
			      	
			    </ul>
	  		</div>
		</nav>
		
		<!-- Page content -->
		<div class = "container">
			<h1 class = "text-center mt-5 mb-5"> Update Profile </h1>
			<?php 
				if($_SESSION["userType"] == "helpSeeker") {
					showHelpSeekerForm();
				} else {
					showCounsellorForm();
				}
			 ?>
		</div>

	</body>
	<?php CloseCon($conn) ?>
</html>