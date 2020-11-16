<?php

    include 'connect.php';
    session_start();
    $conn = OpenCon();

    function bookAppointment() {
        global $conn;
        $id = $_SESSION["userID"];
        $counsellorID = $_POST["userID"];
        $platform = $_POST["platform"];
        $date = $_POST["date"];
        $startTime = $_POST["startTime"];
        $endTime = $_POST["endTime"];
        
        $sql = "insert into Appointment (counsellorID,helpSeekerID,meetingPlatform,date,startTime,endTime) values "; 
        $sql .= "($counsellorID, $id, '$platform', '$date', '$startTime', '$endTime');";
        $result = $conn->query($sql);
        return $result;
    }

    function displayContents() {
        if (bookAppointment()) {
            echo '<div class="alert alert-success" role="alert">
                Appointment booking was successful! </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Appointment booking was not successful!
            </div>';
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
			<h1 class = "text-center mt-5 mb-5"> Appointment Confirmation </h1>
            <?php displayContents()?>
            <div> Return to Appointment Booking page <a href="./appointment-booking.php"> here</a></div>
        </div>
    </body> 
</html>

