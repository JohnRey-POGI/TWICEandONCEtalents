<?php
    require ("DatabaseConnection.php");
    //$commentnewcount = $_POST['commentNewCount'];
    
    if (isset($_POST['UserPostComment'])){
        $postID = (int)$_POST['UserPostComment'];
        
        // validate if admin
        $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE userID = 1");
        while (($row = mysqli_fetch_assoc($result))){
            $userposition = ($row['username']);
        }
        
        $querylastcomment = mysqli_query($dbConn,"Select * from userposttable order by UserPostID");//'.$postID.'
        while ($row = mysqli_fetch_assoc($querylastcomment)) {
                (int)$userlastcomment = ($row['UserPostID']);
        }
        $currentpostid = $userlastcomment - $postID;
        //echo '<script>alert('.$postID.');</script>';
        //echo '<script>alert("'.$userlastcomment.' - '.$postID.' = '.$currentpostid.'");</script>';
        //$commentcount = (int)$_POST['NewCommentCount'];
        //$commentcount = (int)$_POST['NewCommentCount'];
        //echo '<script>alert('.$commentcount.');</script>';
        if(isset($_POST['NewCommentCount'])){
            $commentcount = (int)$_POST['NewCommentCount'] + 3;
        } else {
            $commentcount = 3;
        }
        
        
        //echo '<script>alert('.$commentcount.');</script>';
        $query = mysqli_query($dbConn,"Select * from usercommenttable where UserPostID = $currentpostid order by UserCommentID desc limit $commentcount");//'.$postID.'
        if (mysqli_num_rows($query) > 0) {
            $tempcommentcount = 0;
            while ($row = mysqli_fetch_assoc($query)) {
                $tempcommentcount += 1;
                $usercommentname = ($row['UserWhoComment']);
                $usercommentext = ($row['UserTextComment']);
                $wrapusercommentext = wordwrap($usercommentext , 30, "<br>", true);
                $usercommentdate = ($row['UserWhoCommentDate']);
                echo '<div id="postcommentid'.($postID + 1).''.$tempcommentcount.'"><img id="myImg" style="float:left;height:40px;max-width:40px;border-radius:50px;margin-top:7px;margin-right:10px;margin-left:30px;" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />';
                echo '<a href-"#" style="font-size:15px;">
                     <b><a ';
                        // check the username if admin
                        if ($usercommentname == $userposition){
                            echo 'id="userposition"';
                        }
                echo ' style="font-size:13px;">'.$usercommentname.'</a></b></a><a style="font-size:10px;margin-left:35px;">'.$usercommentdate.'</a><div style="font-size:11px;">&nbsp;'.$wrapusercommentext.'</div><br> </div><br>';
            }
            $postID += 1;
            echo '<br><div id="viewmorecomment" onclick="viewmorecomment(postcommentid'.($postID).''.$tempcommentcount.'.id,comments'.$postID.'.id,'.$postID.');">view more</div>';
        } else {
            //echo 'no comment/s';
        }
    }
?>