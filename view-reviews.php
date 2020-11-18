<?php
	
	include 'connect.php';
	$conn = OpenCon();
	session_start();

	// For a helpseeker, show the reviews they've written
	function showWrittenReviews() {
		global $conn;
		$sql = "SELECT name, rating, feedback
				FROM Users U, Review R
				WHERE U.userID = R.counsellor AND
					  R.reviewAuthor =".$_SESSION["userID"];

		$result = $conn->query($sql);

		if(mysqli_num_rows($result)==0) {

			echo "<p class = 'text-center'> You have written no reviews! </p>";

		} else {

			echo "<table class= 'table mt-5 mb-5'>
				<thead>
					<tr>
						<th>Counsellor</th>
						<th>Session Rating</th>
						<th>Feedback</th>
					</tr>
				</thead>";

			while($row = $result->fetch_assoc()) { 
				echo "<tr>
						<td>".$row["name"]."</td>
						<td>".$row["rating"]."</td>
						<td>".$row["feedback"]."</td>
					  </tr>";
			}

			echo "</table>";
		}
	}

	// For a counsellor, show the reviews they've received
	function showRecievedReviews() {
		global $conn;
		$sql = "SELECT name, rating, feedback
				FROM Users U, Review R
				WHERE U.userID = R.reviewAuthor AND
					  R.counsellor =".$_SESSION["userID"];

		$result = $conn->query($sql);

		if(mysqli_num_rows($result)==0) {

			echo "<p class = 'text-center'> You have received no reviews! </p>";

		} else {

			echo "<table class= 'table mt-5 mb-5'>
				<thead>
					<tr>
						<th>HelpSeeker</th>
						<th>Session Rating</th>
						<th>Feedback</th>
					</tr>
				</thead>";

			while($row = $result->fetch_assoc()) { 
				echo "<tr>
						<td>".$row["name"]."</td>
						<td>".$row["rating"]."</td>
						<td>".$row["feedback"]."</td>
					  </tr>";
			}

			echo "</table>";
		}
	}

	// Show the relevant type of reviews depending on user type
	function showRelevantReviews() {

		if($_SESSION["userType"] == "helpSeeker") {
			echo "<h1 class = 'text-center mt-5 mb-4'> Written Reviews </h1>";
			showWrittenReviews();
		} else {
			echo "<h1 class = 'text-center mt-5 mb-4'> Recieved Reviews </h1>";
			showRecievedReviews();
		}

	}

	// Show all reviews in the platform
	function showAllReviews() {
		global $conn;  
		$sql = "SELECT U1.name AS author, U2.name AS receiver, rating, feedback
				FROM Users U1, Users U2, Review R
				WHERE U1.userID = R.reviewAuthor AND
					  U2.userID = R.counsellor";

		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) { 
			echo "<tr>
					<td>".$row["author"]."</td>
					<td>".$row["receiver"]."</td>
					<td>".$row["rating"]."</td>
					<td>".$row["feedback"]."</td>
				  </tr>";
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
			          		<a class="dropdown-item active" href="/cpsc304/view-reviews.php">View Reviews</a>
			          		<a class="dropdown-item" href="#">Write a Review</a>
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
				        	<a class="dropdown-item" href="#">Types of Help</a>
				        </div>
			      	</li>
			      	
			    </ul>
	  		</div>
		</nav>
		
		<!-- Page content -->
		<div class = "container">
			<?php showRelevantReviews() ?>
			<h1 class = "text-center mt-5 mb-4"> All Reviews </h1>
			<table class="table mt-5 mb-5">
			<thead>
				<tr>
					<th>Help Seeker</th>
					<th>Counsellor</th>
					<th>Session Rating</th>
					<th>Feedback</th>
				</tr>
			</thead>
				<?php showAllReviews() ?>
			</table>
		</div>
	</body>
	<?php CloseCon($conn) ?>
</html>