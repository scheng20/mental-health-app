<?php
	
    include 'connect.php';
    session_start();
	$conn = OpenCon();

	function showResourceCentres() {

		global $conn;  
		$sql = "SELECT * FROM ResourceCentre";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) { 
			echo "<tr>
					<td>".$row["centreID"]."</td>
					<td>".$row["centreName"]."</td>
					<td>".$row["address"]."</td>
					<td>".$row["email"]."</td>
					<td>".$row["postalCode"]."</td>
					<td>".$row["phoneNum"]."</td>
				  </tr>";
		}
	}
?>

<!DOCTYPE html>
<html>
	
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/main.css">
	</head>

	<body>

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

		<div class = "container">
			<h1 class = "text-center mt-5 mb-5"> Resource Centre Directory </h1>
			<table class="table">
			<thead>
				<tr>
					<th>Centre ID</th>
					<th>Centre Name</th>
					<th>Address</th>
					<th>Email</th>
					<th>Postal Code</th>
					<th>Phone</th>
				</tr>
			</thead>
			<?php showResourceCentres()?>
			</table>
		</div>
	</body>
</html>