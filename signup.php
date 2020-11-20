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

<body style="background-color: #138441">
    <div class = "container text-white">
    <h1 class = "text-center mt-5 mb-5"> Thanks for joining us! Please fill out the following information</h1>
    <form action="" method="post" >
        <div class="form-group">
            <select class="form-control" name="type" id="type"> 
                <option value="HelpSeeker">Helpseeker</option>
                <option value="Counsellor">Counsellor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name" id="name">Name:</input>
            <input name="name" id="name" class="form-control" required></input>
        </div>

        <div class="form-group">
            <label for="email" id="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control"
            pattern=".+@.+" required>
        </div>

        <div class="form-group">
            <label for="password" id="password">Password:</input>
            <input type="password" name="password" id="password" class="form-control" required></input>
        </div>

        <div class="form-group">
        <label for="age" id="age">Age:</input>
        <input type="number" class="form-control" name="age" id="age" min=0 max=200></input>
        </div>
        
        <div class="form-group">
        <label for="location" id="location">Location:</input>
        <input name="location" class="form-control" id="location"></input> 
        </div>

        <div class="form-group">
        <label for="phone">Phone Number: </label>
        <input type="tel" class="form-control" id="phone" name="phone"
        pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
        </div>

        <div class="alert alert-info" role="alert"> Only fill this part out if you are a counsellor:
            <div style="padding-top:1%" class="form-row">
                <div class="form-group col-md-6">
                    How many years of experience as a mental health professional do you have?
                    <select name="yearsExp" class="form-control" id="yearsExp">
                        <option value="5"> &lt; 5 years</option>
                        <option value="10">5-10 years</option>
                        <option value="15">10-15 years</option>
                        <option value="20">15+ years</option>
                    </select>
                </div>
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    Select your current status as a counsellor.
                    <select name="cert" class="form-control" id="cert">
                        <option value="certified">Certified</option>
                        <option value="in progress">In progress</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-light" type="submit" value="submit">Sign up </button>
    </form>

    <div class="alert alert-info mt-3" id="login-link">Already have an account? Login <a href="./login.html">here</a></p>
</div>
</body>
</html>

<?php
    include 'connect.php';
    session_start();
    $conn = OpenCon();

    if (isset($_POST["type"])) {
        addUser(); // only add user to DB if form is submitted
    }

    // add new user to DB
    function addUser() {
        global $conn;
        // get all user data submitted from signup form
        $type = $_POST["type"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $age = $_POST["age"] ? : NULL;
        $location = $_POST["location"] ? : NULL;
        $phone = $_POST["phone"] ? : NULL;

        if (!$type) {
            returnError();
            return;
        }
        
        $sql = "insert into Users (password, name, age, location, email, phone)"; 
        $sql .= "values ('$password', '$name', $age, '$location', '$email', '$phone');";
    
        $result = $conn->query($sql);
        if (!$result) {
            returnError();
            return;
        }
    
        $sql = "select userID from Users where email='$email';";
        $result= $conn->query($sql); // get assigned userID to new user from table
        if (!$result) {
            returnError();
            return;
        }
    
        $id = $result->fetch_assoc()["userID"];
        $_SESSION["userID"] = $id; // set session variable to user ID
    
        // add user to either counsellor or helpseeker table
        if ($type == "Counsellor") { 
            $yearsExp = $_POST["yearsExp"];
            $cert = $_POST["cert"];
            $sql = "insert into Counsellor (userID, yearsExperience, certification) values";
            $sql .= "($id, $yearsExp, '$cert');";
            $result = $conn->query($sql);

            if (!$result) {
                returnError();
                return;
            } else {
                header("Location: /cpsc304/profile.php"); // redirect to new profile
            }
            
        } else {
            $sql = "insert into HelpSeeker (userID, numCounsellors, numReviews) values ($id, 0, 0);";
            $result = $conn->query($sql);

            if (!$result) {
                returnError();
                return;
            } else {
                header("Location: /cpsc304/profile.php"); 
            }
        }
    }

    // user creation error
    function returnError() {
        echo "<div class='alert alert-primary'> Sorry, could not create your account. Try again</div>";
    }
?>

</body>
</html>