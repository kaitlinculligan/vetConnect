<?php

    include_once 'session.php'
    include_once 'config.php'

    //have to add in ability to get vet id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $add = trim($_POST['add']);
        $delete = trim($_POST['delete']);
        $name = trim($_POST['date']);
        $species = trim($_POST['time']);

        if($add === true || $delete === true){
            if($add === true){
                if($query = $db->prepare("INSERT INTO time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('iss', $client, $name, $species);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>added pet ' . $name'</p>';
                    }
                    else{
                        $error .= '<p>unable to add pet</p>';
                    }
                }
            }
            else if($delete === true){
                if($query = $db->prepare("DELETE FROM time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('iss', $client, $name, $species);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>removed pet ' . $name'</p>';
                    }
                    else{
                        $error .= '<p>unable to remove pet</p>';
                    }
                }
            }
        }
        
    }
    $query->close();

    mysqli_close($db);

?>