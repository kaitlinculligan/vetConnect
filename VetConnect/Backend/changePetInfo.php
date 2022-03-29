<?php
    //created by Kaitlin Culligan on 03/27/22
    //this script allows clients to add or delete a pet
    include_once 'session.php'
    include_once 'config.php'

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
            }//only runs if use selects to delete
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