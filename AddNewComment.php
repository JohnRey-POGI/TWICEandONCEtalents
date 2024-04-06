<?php
session_start();

require ("DatabaseConnection.php");
$addcomm = ($_POST['NewComment']);
    if ($addcomm != null){
        $userid = $_SESSION['userID'];
        $username = $_SESSION['username'];
        $comment = $_POST['NewComment'];
        $commentpostid = (int)$_POST['NewCommentID'];
        if (!$comment == null) {
            $comment = mysqli_real_escape_string($dbConn,$comment);
            //echo '<script>alert("adding '.$comment.' to '.$commentpostid.' post '.$userid.' - '.$comment.' - '.$username.'");</script>';
            //$currentpostid = 40;
            //echo '<script>alert('.$insertquery.');</script>';
            
            //get the current id post
            $querylastcomment = mysqli_query($dbConn,"Select * from userposttable order by UserPostID");//'.$postID.'
            while ($row = mysqli_fetch_assoc($querylastcomment)) {
                    (int)$userlastcomment = ($row['UserPostID']);
            }
            $currentpostid = $userlastcomment - $commentpostid;
            //echo '<script>alert("adding '.$comment.' to '.$currentpostid.' post '.$userid.' - '.$username.'");</script>';

            //get the current post
            $querycurrentcomment = mysqli_query($dbConn,"Select * from userposttable where UserPostID = $currentpostid");//'.$postID.'
            while ($row = mysqli_fetch_assoc($querycurrentcomment)) {
                    (int)$userlikecomment = ($row['UserCommentPost']);
            }
            
            $insertcomment = mysqli_query($dbConn,"INSERT into usercommenttable
                    (`UserPostID`,`UserID`,`UserTextComment`,`UserWhoComment`)
                    values($currentpostid,$userid,'".$comment."','".$username."')");
            
            
            $userlikecomment += 1;
            
            $ifcommentg0;
            if($userlikecomment > 1){
                $ifcommentg0 = "Comments";
            } else {
                $ifcommentg0 = "Comment";
            }
            echo ''.$userlikecomment.' '.$ifcommentg0.'';
            //echo '<script>alert('.$userlikecomment.');</script>';
            $updateuserpost = mysqli_query($dbConn,"UPDATE userposttable set `UserCommentPost` = $userlikecomment "
                    . "where `UserPostID` = $currentpostid");
            //echo ''.$updateuserpost.'';
            /*
            $query = mysqli_query($dbConn,"Select * from usercommenttable where `UserPostID` = $currentpostid");//'.$postID.'
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $usercommentname = ($row['UserWhoComment']);
                    $usercommentext = ($row['UserTextComment']);
                    $usercommentdate = ($row['UserWhoCommentDate']);
                    //echo '<script>alert('.$usercommentext.');</script>';
                    echo '<div><img id="myImg" style="float:left;height:40px;max-width:40px;border-radius:50px;margin-top:7px;margin-right:10px;margin-left:30px;" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />';
                    echo '<a href-"#" style="font-size:15px;">'.$usercommentname.'</a><br> <a>&nbsp;'.$usercommentext.'</a><br><a style="font-size:15px;">'.$usercommentdate.'</a></div><br>';
                }
            } else {
                //echo 'no comment/s';
            }*/
        }
    }