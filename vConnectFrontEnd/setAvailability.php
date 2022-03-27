<?php

    include_once 'session.php'
    include_once 'config.php'

    //have to add in ability to get vet id from session info

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
        //trim info from HTML form
        $add = trim($_POST['add']);
        $delete = trim($_POST['delete']);
        $date = trim($_POST['date']);
        $time = trim($_POST['time']);

        if($add === true || $delete === true){
            $dt = $date . $time;
            if($add === true){
                if($query = $db->prepare("INSERT INTO time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('is', $vet, $dt);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>added availability ' . $dt'</p>';
                    }
                    else{
                        $error .= '<p>unable to add availability</p>';
                    }
                }
            }
            else if($delete === true){
                if($query = $db->prepare("DELETE FROM time_availability WHERE vet_id = ? AND available_time = ?")){
                    $error = '';
        
                    $query->bind_param('is', $vet, $dt);
                    $insertError = $query->execute();
        
                    if($insertError){
                        $error .= '<p>removed availability ' . $dt'</p>';
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