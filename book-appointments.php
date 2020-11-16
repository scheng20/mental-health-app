<?php
	
    include 'connect.php';
    session_start();
    $conn = OpenCon();

	function showCounsellors() {

		global $conn;  
		$sql = "SELECT * FROM Counsellor";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) {
            $sql = "SELECT name FROM Users WHERE userID=".$row["userID"];
            $name = $conn->query($sql)->fetch_assoc()['name'];
			echo "<option value=".$row["userID"].">$name</option>";
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
		<div class = "container">
			<h1 class = "text-center mt-5 mb-5"> Book Appointment </h1>
			<form action="./add-appointments.php" method="post" >
                <div class="form-group">
                    <select class="form-control" name="userID" id="userID"> 
                    <?php showCounsellors()?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="platform">What platform?</label>
                    <input name="platform" id="platform" required></input>
                </div>

                <div class="form-group col-md-5">
                    <label for="date" id="date">Choose a date: </label>
                    <input type="date" name="date" required></input>
                </div>

                <div class="form-group col-md-3">
                    <label for="startTime" id="startTime">Start Time: </label>
                    <input type="time" name="startTime" required></input>
                </div>

                <div class="form-group col-md-3">
                    <label for="endTime" id="endTime">End Time: </label>
                    <input type="time" name="endTime" required></input>
                </div>

                <button class="btn btn-primary" type="submit" value="submit">Sign up </button>
            </form>

		</div>
	</body>
</html>