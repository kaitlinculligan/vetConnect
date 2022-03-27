<?php

    include_once 'session.php'
    include_once 'config.php'

    //have to add in ability to get client id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $date = trim($_POST['date']);
        $time = trim($_POST['time']);
        $petName = trim($_POST['pet']);
        /*$location = trim($_POST['location']);*/
    
    
        $dt = $date . " " $time;

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
                $petQuery = $db->prepare("SELECT pet_id FROM Pets WHERE name = ? AND client_id = ?")
                $petQuery->bind_param('si', $dt, $client);
                $petQuery->execute();
                $petQuery->store_result();
                if($query->num_rows <= 0){
                    $error .= "<p>there were no pets with that name</p>";
                }
                $pet = myslqi_fetch_assoc($petQuery);
                //make appointment in appointment table
                $insertQuery = $db->prepare("INSERT INTO Appointment (vet_id, client_id, pet_id, time) VALUES (?, ?, ?, ?)")
                $insertQuery->bind_param('iiis', $vet['id'], $pet['id'], $client, $dt);
                $insertError = $insertQuery->execute();
                if($insertError){
                    $error .= '<p>made an appointment at ' . $dt'</p>';
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