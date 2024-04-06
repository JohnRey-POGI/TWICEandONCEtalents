<?php
session_start();

require 'DatabaseConnection.php';
    echo '<script>alert("psaok")</script>';

if(isset($_POST['UserLikePost'])){
    $userid = $_SESSION['userID'];
    $likebutton = (int)$_POST['UserLikePost'];
    
    //get hte last post id
    $querylastcomment = mysqli_query($dbConn,"Select * from userposttable order by UserPostID");//'.$postID.'
    while ($row = mysqli_fetch_assoc($querylastcomment)) {
        (int)$userlastcomment = ($row['UserPostID']);
    }
    $currentpostid = $userlastcomment - $likebutton;
    
    //find the current id post
    $queryidpostcomment = mysqli_query($dbConn,"Select * from userposttable where UserPostID = $currentpostid");//'.$postID.'
    while ($row = mysqli_fetch_assoc($queryidpostcomment)) {
        (int)$usercurrentlikecount = ($row['UserLikePost']);
    }
    if (mysqli_num_rows($queryidpostcomment) > 0) {
        $userlikecomment = $usercurrentlikecount;
    } else {
        
    }
    //$selectuserpost = mysqli_query($dbConn, "SELECT `UserLikePost` FROM `userposttable UserPostID = ");
    
    //check if already like
    $selectquery = mysqli_query($dbConn, "SELECT * FROM `userpostliketable` where UserPostID = $currentpostid and UserID = $userid");
    while ($row = mysqli_fetch_assoc($querylastcomment)) {
        (int)$userlikecomment = ($row['UserLikePost']);
    }
    
    //echo '<script>alert("'.$userlikecomment.'")</script>';
    
    if (mysqli_num_rows($selectquery) > 0) {
        //removelike  unlike already liked
        //echo '<script>alert("Already liked")</script>';
        $insertquery = mysqli_query($dbConn, "DELETE from `userpostliketable` where UserPostID = $currentpostid and UserID = $userid");
        
        //echo '<script>alert("'.$likebutton.'")</script>';
        $userlikecomment -= 1;
        
        if($userlikecomment > 1){
            $iflikeg0 = "Likes";
        } else {
            $iflikeg0 = "Like";
        }
    
        $updateuserpost = mysqli_query($dbConn,"UPDATE userposttable set `UserLikePost` = $userlikecomment "
                        . "where `UserPostID` = $currentpostid");
        echo ''.$userlikecomment.' '.$iflikeg0.'';
    } else {
        $insertquery = mysqli_query($dbConn, "INSERT INTO `userpostliketable`(`UserPostID`, `UserID`)
                VALUES ($currentpostid,$userid)");
        //echo '<script>alert("'.$likebutton.'")</script>';
        $userlikecomment += 1;
        
        if($userlikecomment > 1){
            $iflikeg0 = "Likes";
        } else {
            $iflikeg0 = "Like";
        }
    
        $updateuserpost = mysqli_query($dbConn,"UPDATE userposttable set `UserLikePost` = $userlikecomment "
                        . "where `UserPostID` = $currentpostid");
        echo ''.$userlikecomment.' '.$iflikeg0.'';
    }
}


