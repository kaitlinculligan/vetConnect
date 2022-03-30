<?php

?>

<!DOCTYPE html>
<html>
    <!-- created by Kaitlin Culligan, 03/25/22-->
    <!-- This page is meant for vets to see their up coming appointments, as well as view and leave comments -->
    <head>
		<title>VetConnect - Appointments</title>
		<link rel="stylesheet" href="mainWebsite.css">
	</head>
	<body>
		<div class="header">
			<h1 class="websiteName">VetConnect</h1>
			<ul class="options">
				<li><button><a href = "logout.php">Logout</a></button></li>
				<li><button><a href = "EditInfoVet.html">Edit Info</a></button></li>
			</ul>
		</div>
		<div class="main">
			<h2>Upcoming appointments</h2>
			<p>Appointment one</p>
			<button>Accept</button>
			<button>Decline</button>

            <h2>Previous Appointments</h2>
			<table>
				<tr>
					<th>Appointment Id</th>
					<th>Comment From Client</th>
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