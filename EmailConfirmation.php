<?php
session_start();
    require ("DatabaseConnection.php");

    if (!isset($_GET['email']) || !isset($_GET['vkey'])) {
        header ('location:index.php');
        exit();
    } else {
        
        $email = mysqli_real_escape_string($dbConn,$_GET['email']);
        $vkey = mysqli_real_escape_string($dbConn,$_GET['vkey']);
        
        $query = "SELECT * FROM usertable WHERE useremailadd = '".$email."' and isEmailConfirmed = 0 and EmailCode = '".$vkey."' ";
        
        //echo '<script> alert("to :'.$query.'"); </script>';
        $result = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($result) > 0) {
            $query = "UPDATE usertable set isEmailConfirmed = 1 WHERE useremailadd = '".$email."'";
            $result = mysqli_query($dbConn, $query);//, EmailCode = 'null'
            
            $resultquery = mysqli_query($dbConn,"SELECT * FROM usertable WHERE useremailadd = '".$email."'");
            while (($row = mysqli_fetch_assoc($resultquery))){
                $userid = ($row['userID']);
                $username = ($row['username']);
            }
            if (mysqli_num_rows($resultquery) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $userid;
                header('location:UserIndex.php');
            } else {
                //echo '<script> alert("Please enter a valid account"); </script>';
            }
            //header ('location:index.php');
            exit();
        } else {
            header ('location:index.php');
            exit();
        }
    }
?>