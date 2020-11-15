<?php
	
	include 'connect.php';
	$conn = OpenCon();

	// Display information of all hotlines
	function showHotlines() {

		global $conn;  
		$sql = "SELECT name, phoneNum, typeOfHelp FROM Hotline";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) { 
			echo "<tr>
					<td>".$row["name"]."</td>
					<td>".$row["phoneNum"]."</td>
					<td>".$row["typeOfHelp"]."</td>
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
		<nav class="navbar navbar-expand-lg">
			<a class="navbar-brand" href="#">Mental Health Webapp</a>
		 	<div class="collapse navbar-collapse" id="navbarNav">
		 		<ul class="navbar-nav">

		 			<li class="nav-item">
			        	<a class="nav-link" href="#">Profile</a>
			      	</li>

			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown">
			          	Appointments
			        	</a>
				        <div class="dropdown-menu">
				        	<a class="dropdown-item" href="#">View Appointments</a>
				        	<a class="dropdown-item" href="#">Book an Appointment</a>
				        </div>
			      	</li>

			     	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown">
			          		Reviews
			        	</a>
			        	<div class="dropdown-menu">
			          		<a class="dropdown-item" href="#">View Reviews</a>
			          		<a class="dropdown-item" href="#">Write a Review</a>
			        	</div>
			      	</li>

			     	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown">
			          		Posts
			        	</a>
				        <div class="dropdown-menu">
				        	<a class="dropdown-item" href="#">View Posts</a>
				        	<a class="dropdown-item" href="#">Write a Post</a>
				        </div>
			      	</li>

			      	<li class="nav-item dropdown">
			        	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown">
			          		Directories
			        	</a>
				        <div class="dropdown-menu">
				        	<a class="dropdown-item" href="/cpsc304/user-directory.php">Users</a>
				        	<a class="dropdown-item active" href="#">Hotlines</a>
				        	<a class="dropdown-item" href="#">Resource Centers</a>
				        	<a class="dropdown-item" href="#">Types of Help</a>
				        </div>
			      	</li>
			      	
			    </ul>
	  		</div>
		</nav>
		
		<!-- Page content -->
		<div class = "container">
			<h1 class = "text-center mt-5 mb-4"> Hotline Directory </h1>
			<table class="table mt-5 mb-5">
			<thead>
				<tr>
					<th>Name</th>
					<th>Phone Number</th>
					<th>Type of Help</th>
				</tr>
			</thead>
			<?php showHotlines() ?>
			</table>
		</div>
	</body>
	<?php CloseCon($conn) ?>
</html>