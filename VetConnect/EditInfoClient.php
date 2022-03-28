<?php
    //created by Kaitlin Culligan on 03/27/22
    //this script allows clients to add or delete a pet
    include_once 'session.php';
    include_once 'config.php';

    //have to add in ability to get vet id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $add = trim($_POST['add']);
        $delete = trim($_POST['delete']);
        $name = trim($_POST['date']);
        $species = trim($_POST['time']);

        //only runs if user selects to add or delete a pet, not both
        if(($add === true || $delete === true) && $add != $delete){
            //only runs if user selects to add
            if($add === true){
                if($query = $db->prepare("INSERT INTO pets (client_id, name, species) VALUES (?, ?, ?)")){
                    $error = '';
        
                    $query->bind_param('iss', $client, $name, $species);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>added pet ' . $name . '</p>';
                    }
                    else{
                        $error .= '<p>unable to add pet</p>';
                    }
                }
            }//only runs if use selects to delete
            else if($delete === true){
                if($query = $db->prepare("DELETE FROM pets WHERE client_id = ? AND name = ? AND species = ?")){
                    $error = '';
        
                    $query->bind_param('iss', $client, $name, $species);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>removed pet ' . $name . '</p>';
                    }
                    else{
                        $error .= '<p>unable to remove pet</p>';
                    }
                }
            }
        }
        
    }
    elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitlocation'])){
        $location = trim($_POST['location']);

        if($query = $db->prepare("UPDATE users SET location = ? WHERE client_id = ?")){
            $error = '';

            $query->bind_param('si', $location, $_SERVER["userid"]);
            $insertError = $query->execute();

            if($insertError){
                $error .= '<p>could not change location to ' . $location . '</p>';
            }
        }
    }
    $query->close();

    mysqli_close($db);

?>

<!DOCTYPE html>
<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for clients to edit their location and pet information -->
    <head>
		<title>VetConnect - User Info</title>
		<link rel="stylesheet" href="mainWebsite.css">
	</head>
	<body>
		<div class="header">
			<h1 class="websiteName">VetConnect</h1>
			<ul class="options">
				<li><button><a href = "logout.php">Logout</a></button></li>
				<li><button style="width: 170px;"><a href="AppointmentClient.html">Make An Appointment</a></button><li>
			</ul>
		</div>
		<div class="main">
			<h2>Client Edit</h2>
			<form>
				<label for="location">Location:</label><br>
				<input type="text" id="location" name="location"><br>
				<input type="submit" value="SubmitLocation">
			</form>
			<h1>Add Pet</h1>
			<form>
				<label for="name">Name:</label><br>
				<input type="text" id="name" name="name"><br>
				<label for="species">Species:</label><br>
				<input type="text" id="species" name="species"><br>
				<input type="submit" value="Submit">
			</form>
			<h1>Delete Pet</h1>
			<form>
				<label for="name">Name:</label><br>
				<input type="text" id="name" name="name"><br>
				<label for="species">Species:</label><br>
				<input type="text" id="species" name="species"><br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>