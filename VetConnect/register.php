<?php
  require_once "config.php";
  require_once "session.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $fullname = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST["confirm_password"]);
  $usertype =  trim($_POST["userType"]);
  $password_hash = password_hash($password, PASSWORD_BCRYPT);
  $type = '';
  if($usertype=='Yes'){
    $type = "vet";
  }else{
    $type = "client";
  }

   if($query = $db->prepare("SELECT * FROM user WHERE email = ?")) {
     $error = '';
     // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use
    $query->bind_param('s', $email);
    $query->execute();
  // Store the result so we can check if the account exists in the database.
    $query->store_result();
     if ($query->num_rows > 0) {
        $error .= '<p class="error">The email address is already registered!</p>';
      } else {
        // Validate password
        if (strlen($password ) < 6) {
          $error .= '<p class="error">Password must have atleast 6 characters.</p>';
        }
        // Validate confirm password
        if (empty($confirm_password)) {
           $error .= '<p class="error">Please enter confirm password.</p>';
         } else {
           if (empty($error) && ($password != $confirm_password)) {
             $error .= '<p class="error">Password did not match.</p>';
           }
        }
        if (empty($error) ) {
          $insertQuery = $db->prepare("INSERT INTO User (name, email, password,type) VALUES (?, ?, ?, ?);");
          $insertQuery->bind_param("ssss", $fullname, $email, $password_hash, $type);
           $result = $insertQuery->execute();
           if ($result) {$error .= '<p class="success">Your registration was successful!</p>';
           } else {
           $error .= '<p class="error">Something went wrong!</p>';
           }
          }
        }
      }
    $query->close();
    $insertQuery->close();
    // Close DB connection
    mysqli_close($db);
  }
?>
<!DOCTYPE html>
<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for users to register through -->
    <!-- Users will be redirected to the login page after registering -->
    <link rel="stylesheet" href="mainWebsite.css">
	<style>
	form{
		padding-top: 75px;
	}
	</style>
    <div class="main">
        <h1>VetConnect</h1>
        <form>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br>
            <label for="userType">Please check the box if you are a veterinarian:</label>
            <input type="checkbox" id="userType" name="userType"><br>
            <input type="submit" value="Submit">
        </form>
        <p>If you already have an account, log in <a href="Login.php">here</a></p>
    </div>
</html>