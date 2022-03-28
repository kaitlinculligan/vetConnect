<?php
    //created by Kaitlin Culligan on 03/26/22
    //this script allows clients to make an appointment
    include_once 'session.php';
    include_once 'config.php';

    //have to add in ability to get client id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $date = trim($_POST['date']);
        $time = trim($_POST['time']);
        $petName = trim($_POST['pet']);
        /*$location = trim($_POST['location']);*/
    
    
        $dt = $date . " " . $time; //date time format is mm/dd/yy time

        if($query = $db->prepare("SELECT * FROM time_availability WHERE available_time = ?")){
            $error = '';

            $query->bind_param('s', $dt);
            $query->execute();

            $query->store_result();

            //no vets at given time
            if($query->num_rows <= 0){
                $error .= '<p>There are no vets available at this time</p>';
            }

            //there is a vet available at that given time
            if(empty($error)){
                //select first vet in query list
                $vet = myslqi_fetch_assoc($query);
                //pull pet id from that table
                $petQuery = $db->prepare("SELECT pet_id FROM Pets WHERE name = ? AND client_id = ?");
                $petQuery->bind_param('si', $dt, $client);
                $petQuery->execute();
                $petQuery->store_result();
                if($query->num_rows <= 0){
                    $error .= "<p>there were no pets with that name</p>";
                }
                $pet = myslqi_fetch_assoc($petQuery);
                //make appointment in appointment table
                $insertQuery = $db->prepare("INSERT INTO Appointment (vet_id, client_id, pet_id, time) VALUES (?, ?, ?, ?)");
                $insertQuery->bind_param('iiis', $vet['id'], $pet['id'], $client, $dt);
                $insertError = $insertQuery->execute();
                if($insertError){
                    $error .= '<p>made an appointment at ' . $dt . '</p>';
                }
                else{
                    $error .= '<p>unable to book appointment</p>';
                }
                //remove vets availability at that time
                $availabilityQuery = $db->prepare("DELETE FROM time_availability WHERE available_time = ? AND vet_id = ?");
                $availabilityQuery->bind_param('si', $dt, $vet['id']);
                $availabilityError = $availabilityQuery->execute();
                if($availabilityError){}
                else{
                    $error .= "<p>Couldn't properly delete vet availability</p>";
                }
            }
        }
    }
    $query->close();
    $petQuery->close();
    $insertQuery->close();
    $availabilityQuery->close();

    mysqli_close($db);

?>

<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for clients to book appointments, as well as view and leave comments -->
    <head>
		<title>VetConnect - Appointments</title>
		<link rel="stylesheet" href="mainWebsite.css">
	</head>
    <body>
		<div class="header">
			<h1 class="websiteName">VetConnect</h1>
			<ul class="options">
				<li><button><a href = "logout.php">Logout</a></button></li>
				<li><button><a href = "EditInfoClient.html">Edit Info</a></button></li>
			</ul>
		</div>
		<div class="main">
			<h2>Make An Appointment</h2>
			<form>
				<label for="date">Date(mm/dd/yyyy):</label><br>
				<input type="text" id="date" name="date"><br>
				<label for="time">Time(24h):</label><br>
				<input type="text" id="time" name="time"><br>
				<label for="pet">Pet Name:</label><br>
				<input type="text" id="pet" name="pet"><br>
				<label for="location">Location:</label><br>
				<input type="text" id="location" name="location"><br>
				<input type="submit" value="Submit">
			</form>
			<h2>Previous Appointments</h2>
			<table>
				<tr>
					<th>Appointment Id</th>
					<th>Comment From Vet</th>
					<th>Comment From You</th>
				</tr>
				<tr>
					<td>Appointment 0</td>
					<td>Fantasic Vet</td>
					<td><form>
						<input type="text" id="feedback" name="feedback">
						<input type="submit" value="Submit">
					</form></td>
				</tr>
			</table>
		</div>
	</body>
</html>