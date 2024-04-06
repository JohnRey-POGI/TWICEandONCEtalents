<?php
session_start();
require ("DatabaseConnection.php");

$userpost = "";
if (isset($_POST['upost'])){
    $userpost = $_POST['upost'];
    if ($userpost != ""){
        $userid = $_SESSION['userID'];
        if (!$userpost == null){
            $userpost = mysqli_real_escape_string($dbConn,$userpost);
        
            $result = mysqli_query($dbConn,"INSERT into userposttable (`UserIDPost`,`UserPicturePost`,`UserCaptionPost`) values($userid,0,'".$userpost."')");
            header('location:UserMedia.php');
        } else {
            header('location:UserMedia.php');
        }
    } else {
        //echo '<script>alert("Please input text.")</script>';
        //header('location:UserMedia.php');
    }
}
?>