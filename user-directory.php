<?php
	
	include 'connect.php';
	$conn = OpenCon();

	function showUsers() {

		global $conn;  
		$sql = "SELECT userID, name, age, location, email, phone FROM Users";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) { 
			echo "<tr>
					<td>".$row["userID"]."</td>
					<td>".$row["name"]."</td>
					<td>".$row["age"]."</td>
					<td>".$row["location"]."</td>
					<td>".$row["email"]."</td>
					<td>".$row["phone"]."</td>
				  </tr>";
		}
	}

	function showTopHelpSeeker() {
		global $conn;
		$sql = ""; // TODO

		echo "dunno";

	}

	function showTopCounsellor() {
		global $conn;
		$sql = ""; // TODO

		echo "dunno";
	}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/main.css">
	</head>

	<body>

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg">
			<a class="navbar-brand" href="#">Mental Health Webapp</a>
			 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			 	<span class="navbar-toggler-icon"></span>
			 </button>
		 	<div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="#">Profile</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Appointments</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Reviews</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Posts</a>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Directories
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			          <a class="dropdown-item" href="#">Users</a>
			          <a class="dropdown-item" href="#">Hotlines</a>
			          <a class="dropdown-item" href="#">Resource Centers</a>
			          <a class="dropdown-item" href="#">Types of Help</a>
			        </div>
			      </li>
			    </ul>
	  		</div>
		</nav>

		<!-- Page content -->
		<div class = "container">
			<h1 class = "text-center mt-5 mb-4"> User Directory </h1>

			<p> Top help seeker (booked an appointment with all counsellors): <?php showTopHelpSeeker() ?></p> 
			<p> Top counsellor (booked an appointment with all help seekers): <?php showTopCounsellor() ?></p> 

			<table class="table mt-5 mb-5">
			<thead>
				<tr>
					<th>userID</th>
					<th>name</th>
					<th>age</th>
					<th>location</th>
					<th>email</th>
					<th>phone</th>
				</tr>
			</thead>
			<?php showUsers() ?>
			</table>
		</div>
	</body>
</html>