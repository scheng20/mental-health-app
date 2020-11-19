<?php
	
	include 'connect.php';
	$conn = OpenCon();

	// Find the counsellor that has the highest rating throughout the platform
	function showTopCounsellor() {
		global $conn;
		$sql = "SELECT U.name, AVG(rating)
				FROM Review R, Users U
				WHERE R.counsellor = U.userID
				GROUP BY U.name
				HAVING AVG(rating) >= ALL (SELECT AVG(rating)
			   			   				   FROM Review R2
			   			   				   GROUP BY R2.counsellor)"; 

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo $row["name"];
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
				        	<a class="dropdown-item active" href="/cpsc304/user-directory.php">Users</a>
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
				        	<a class="dropdown-item active" href="/cpsc304/top-counsellor.php">Top Counsellor</a>
				        	<a class="dropdown-item" href="/cpsc304/active-counsellor.php">Most Active Counsellor</a>
				        	<a class="dropdown-item" href="/cpsc304/active-helpseeker.php">Most Active Help Seeker</a>
				        </div>
			      	</li>

			    </ul>
	  		</div>
		</nav>

		<!-- Page content -->
		<div class = "container">
			<h1 class = "text-center mt-5 mb-4"> Top Rated Counsellor </h1>

			<div class='alert alert-success' role='alert'>
				<b>Top Rated Counsellor</b> (highest average rating): <b><?php showTopCounsellor()?></b>
			</div>
		</div>
	</body>
	<?php CloseCon($conn) ?>
</html>