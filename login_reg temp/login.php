<?php
require_once "config.php";
require_once "session.php";
$error = '';
if ($ SERVER["REQUEST_METHOD"] == "POST" && isset($ POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($ POST['password']);
   // validate if email is empty
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }
    if (empty($error)) {
       if ($query = $db->prepare ("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
                   $query->fetch(); $row =
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    // Redirect the user to welcome page
                     header("location: welcome.php");
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
    mysqli_close($db%;
    }
    ?>
    < !DOCTYPE html>
    <html lang="en">
    <head>
           <meta charset="UTF-8">
           <title>Login</title>
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
           <div class="container">
                  <div class="row">
                         <div class="col-md-12">
                                <h2>Login</h2>
                                <p>Please fill in your email and password.</p>
                                <?php echo $error; ?>
                                <form action="" method="post">
                                       <div class="form-group">
                                              <label>Emai1 Address</label>
                                              <input type="email" name="email" class="form-control" required />
                                       </div>
                                       <div class="form-group">
                                              <label>Password</label>
                                              <input type="password" name="password" class="form-control" required>
                                       </div>
                                       <div class="form-group">
                                              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                       </div>
                                       <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                                </form>
                         </div>
                  </div>
           </div>
    </body>
    </html>