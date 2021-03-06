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
    <h1 class = "text-center mt-5 mb-5">Welcome to the Mental Health Webapp!</h1>
    <h3 class = "text-center mt-5 mb-3">Login</h3>

    <form action='./login.php' method='post' class = "text-center">

        <div class="form-group">
        <label for="email" id="email" class = "text-left">Email:</input>
        <input type='email' class="form-control" id='email' name='email' pattern=".+@.+" required>
        </input>
        </div>

        <div class="form-group">
        <label for="password" id="password" class = "text-left">Password:</input>
        <input id='password' class="form-control" name='password' type="password" required>
        </input>
        </div>

        <button type="submit" class="btn btn-light" value="submit"> Login </button>
    </form>

    <div class="alert alert-info mt-5" id="login-link">Don't have an account? Signup <a href="./signup.php">here</a></div>
</div>
</body>
</html>

<?php
    include './connect.php';
    session_start(); // will not expire until user closes the browser

    $conn = OpenCon();
    if (isset($_POST['password']) && isset($_POST['email'])) {
        loginSuccess();
    } else if (isset($_SESSION["userID"])) {
        header('Location: profile.php');
        die();
    }

    function loginSuccess() {
        global $conn;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "select userID from Users where email='$email' and password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userID'] = $row['userID'];
            header('Location: profile.php');
            die();
        } else {
            echo "<div class='alert alert-primary'>Cannot login. Try Again.</div>";
        }
    }
    
?>

