<?php
require_once "config.php";
require_once "session.php";
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($POST['password']);
   // validate if email is empty
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }
    if (empty($error)) {
       if ($query = $db->prepare ("SELECT * FROM user WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
              $row = $query->fetch();
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    // Redirect the user to welcome page
                    if($row['type']==="vet"){
                        header("location: AppointmentVet.php");
                    }
                    else{
                        header("location: AppointmentClient.php");
                    }
                    exit;
                  } else {
                    $error .= '<p class="error">The password is not valid.</p>';
                }
              } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
            }
        $query->close();
    }
    // Close connection
    mysqli_close($db);
    }
}
}
    ?>
 <!DOCTYPE html>
<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for registered users to log in through -->
    <!-- Users will be redirected to their corresponding sections of the site after logging in -->
    <link rel="stylesheet" href="mainWebsite.css">
	<style>
	form {
		padding-top: 75px;
	}
	</style>
    <div class="main">
        <h1>VetConnect</h1>
        <form>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Submit">
        </form>
        <p>If you don't have an account, register <a href="Register.php">here</a></p>
    </div>
</html>
