<?php
    //created by Kaitlin Culligan on 03/26/22
    //this script allows vets to add or delete an availability
    include_once 'session.php';
    include_once 'config.php';

    //have to add in ability to get vet id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $add = trim($_POST['add']);
        $delete = trim($_POST['delete']);
        $date = trim($_POST['date']);
        $time = trim($_POST['time']);
        $vet = $_SESSION["userid"];

        //only runs if user selects to add or delete availability, not both
        if(($add === true || $delete === true) && $add != $delete){
            $dt = $date . " " . $time; //date time format is mm/dd/yy time
            //only runs if user selects to add
            if($add === true){
                if($query = $db->prepare("INSERT INTO time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('is', $vet, $dt);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>added availability ' . $dt . '</p>';
                    }
                    else{
                        $error .= '<p>unable to add availability</p>';
                    }
                }
            }//only runs if users selects to delete
            else if($delete === true){
                if($query = $db->prepare("DELETE FROM time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('is', $vet, $dt);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>removed availability ' . $dt . '</p>';
                    }
                    else{
                        $error .= '<p>unable to remove availability</p>';
                    }
                }
            }
        }
        
    }
    $query->close();

    mysqli_close($db);

?>

<!DOCTYPE html>
<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for vets to edit their availability -->
    <head>
		<title>VetConnect - User Info</title>
		<link rel="stylesheet" href="mainWebsite.css">
	</head>
	<body>
		<div class="header">
			<h1 class="websiteName">VetConnect</h1>
			<ul class="options">
				<li><button><a href = "logout.php">Logout</a></button></li>
				<li><button style="width: 150px;"><a href = "AppointmentVet.html">View Appointments</a></button></li>
			</ul>
		</div>
		<div class="main">
			<h2>Vet Edit</h2>
			<h1>Change Availability</h1>
			<form>
				<label for="Add">Add</label><br>
				<input type="checkbox" id="add" name="add"><br>
				<label for="Delete">Delete</label><br>
				<input type="checkbox" id="delete" name="delete"><br>
				<label for="date">Date(mm/dd/yyyy):</label><br>
				<input type="text" id="date" name="date"><br>
				<label for="time">Time(24h):</label><br>
				<input type="text" id="time" name="time"><br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>