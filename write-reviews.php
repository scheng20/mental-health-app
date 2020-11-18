<?php

    include 'connect.php';
    session_start();
    $conn = OpenCon();

	function writeReview() {
		global $conn;
        $id = $_SESSION["userID"];
        $reviewAuthor = $_POST["userID"];
        $counsellor = $_POST["userID"];
        $rating = $_POST["rating"];
        $feedback = $_POST["feedback"];
        
        $sql = "insert into Review (reviewAuthor, counsellor, rating, feedback) values "; 
        $sql .= "($reviewAuthor, $counsellor, $rating, '$feedback');";
        $result = $conn->query($sql);
        return $result;
	}

	function displayContents() {
        if (writeReview()) {
            echo '<div class="alert alert-success" role="alert">
                Review posted. Thanks for your review! </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Unable to post your review. Please try again.
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
			<h1 class = "text-center mt-5 mb-5"> Review Has Posted Confirmation </h1>
            <?php displayContents()?>
            <div> Return to Write Review page <a href="./write-reviews.php"> here</a></div>
        </div>
    </body> 
</html>