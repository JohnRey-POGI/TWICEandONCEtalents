<?php
session_start();

require 'DatabaseConnection.php';

$userid = $_SESSION['userID'];

if (isset($_POST['UserPost'])){
    $morepost = $_POST['UserPost'];
    // validate if admin
    $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE userID = 1");
        while (($row = mysqli_fetch_assoc($result))){
            $userposition = ($row['username']);
        }
    
    // if user like the post
    //echo '<script>alert("'.$username.'")</script>';
    $userlikeposttable = array();
    $userlikes = mysqli_query($dbConn,"SELECT * FROM userpostliketable WHERE UserID = $userid");
    $i = 1;
    while (($inrow = mysqli_fetch_assoc($userlikes))){
        $userlikeposttable[$i] = ($inrow['UserPostID']);
        $i++;
    }
    
    $query = mysqli_query($dbConn,"SELECT * FROM userposttable AS a
                                    LEFT JOIN usertable AS b
                                    ON a.UserIDPost = b.userID
                                    order by a.UserPostID DESC
                                    LIMIT $morepost");
    $tempcountpost = 0;
    //echo '<script>alert('.$morepost.');</script>';
    echo '
    <div id="postcontainerenter">
        <a><img id="myinputImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" /></a>
        <form action="UserAddPost.php" method="POST">
        <a id="postinputtext"><input style="border-radius: 40px;width:80%;" autocomplete="off" type="text" placeholder="Enter text here" maxlength="1000" name="upost" required></a>
        <br>
            <!--<button id="postpicture">PICTURE</button>-->
            <button id="userpost" type="submit">POST</button>
        <br><div id="refresh"></div><br>
        </form>    
    </div>


    ';
    while (($row = mysqli_fetch_assoc($query))){
        $tempcountpost += 1;
        $userpostid = ($row['UserPostID']);
        $useridpost = ($row['UserIDPost']);
        $userpicturepost = ($row['UserPicturePost']);
        $usercaptionpost = ($row['UserCaptionPost']);
        $usercommentpost = ($row['UserCommentPost']);
        $userlikepost = ($row['UserLikePost']);
        $userposttime = ($row['UserPostTime']);
        $iflikeg0;
        if($userlikepost > 1){
            $iflikeg0 = "Likes";
        } else {
            $iflikeg0 = "Like";
        }
        $ifcommentg0;
        if($usercommentpost > 1){
            $ifcommentg0 = "Comments";
        } else {
            $ifcommentg0 = "Comment";
        }
                        
        $userpostname = ($row['username']);
        echo '<div id="userpostcontent"><a><img id="mypostImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />
            </a>&nbsp;&nbsp;
            <b><a ';
        // check the username if admin
        if ($userpostname == $userposition){
            echo 'id="userposition"';
        }
        $wrapusercaptionpost = wordwrap($usercaptionpost , 45, "<br>", true); //25
        echo '>'.$userpostname.'</a></b><br>
            <a style="color:gray;">&nbsp;&nbsp;'.$userposttime.'<br><br>
            <a>'.$wrapusercaptionpost.'<br><br><br>';
        if ($userpicturepost > 0){
            echo '<img style="width:300px;max-width:300px;" src="Data/Images/JYPbuilding.png">';
        }
        
        echo'<br><br>
        <div style="text-align:center;height:60px">
            <a id="likecount'.$tempcountpost.'" style="float:left;">'.$userlikepost.' '.$iflikeg0.'</a>
            <a id="commentcount'.$tempcountpost.'" style="float:right;" onClick="passcommentID(commentbutton'.$tempcountpost.'.id,comments'.$tempcountpost.'.id);">'.$usercommentpost.' '.$ifcommentg0.'</a><br><br>
            <a id="likebutton'.$tempcountpost.'" onClick="passlikedID(this.id,iflike'.$tempcountpost.'.id,iflike'.$tempcountpost.'.className);"><div id="iflike'.$tempcountpost.'" class="'; //id="iflike'.$tempcountpost.'" 
            $likeorNot = 'likecommentbutton';
            $temp = $i;
        while ($i != 0){
            if (isset($userlikeposttable[$i])){
                //echo '<script>alert("'.$userlikeposttable[$i].'")</script>';
                if ($userlikeposttable[$i] == $userpostid) {
                    $likeorNot = 'likedcommentbutton';
                    break;
                } else {
                    $likeorNot = 'likecommentbutton';
                }
            }
        $i--;
    }
    $i = $temp;
    //echo '<script>alert("'.$i.'")</script>';
                                
    echo ''.$likeorNot.'';    
                            
    echo'">Like</div></a>
        <a id="commentbutton'.$tempcountpost.'" onClick="passcommentID(this.id,comments'.$tempcountpost.'.id);"><div class="likecommentbutton">Comment</div></a>
    </div>
    <a style="text-align:center">
        <img id="commentImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />
        <input id="replyComment'.$tempcountpost.'" autocomplete="off" class="ReplyComment" type="text" placeholder="Enter comment here" maxlength="50" name="ucommentpost">
        <img id="commentbtn" class="commentbtncss" onClick="addcomment(replyComment'.$tempcountpost.'.id,comments'.$tempcountpost.'.id,commentcount'.$tempcountpost.'.id)" src="Data/Images/sendlogo.png">
    </a>
    <div id="comments'.$tempcountpost.'"><a id="viewmore"></a></div>
    </div>';
        };
    echo'<div id="MoreUserPost" onClick="currentdisplaypost('.$tempcountpost.');">
            <a id="MorePost" >MORE</a>
        </div>';

    }

if (isset($_POST['MediaPost'])){
    $morepost = $_POST['MediaPost'];
    
    $query = mysqli_query($dbConn,"SELECT * FROM userposttable AS a
                                    LEFT JOIN usertable AS b
                                    ON a.UserIDPost = b.userID
                                    order by a.UserPostID DESC
                                    LIMIT $morepost");
    $tempcountpost = 0;
    //echo '<script>alert('.$morepost.');</script>';
    echo '<br><div>PLEASE LOGIN</div>';
            
    while (($row = mysqli_fetch_assoc($query))){
        $tempcountpost += 1;
        $userpostid = ($row['UserPostID']);
        $useridpost = ($row['UserIDPost']);
        $userpicturepost = ($row['UserPicturePost']);
        $usercaptionpost = ($row['UserCaptionPost']);
        $usercommentpost = ($row['UserCommentPost']);
        $userlikepost = ($row['UserLikePost']);
        $userposttime = ($row['UserPostTime']);
        $iflikeg0;
        if($userlikepost > 1){
            $iflikeg0 = "Likes";
        } else {
            $iflikeg0 = "Like";
        }
        $ifcommentg0;
        if($usercommentpost > 1){
            $ifcommentg0 = "Comments";
        } else {
            $ifcommentg0 = "Comment";
        }
                        
        $userpostname = ($row['username']);
        echo '<div id="userpostcontent"><a><img id="mypostImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />
            </a>&nbsp;&nbsp;'.$userpostname.'<br>
            <a style="color:gray;">&nbsp;&nbsp;'.$userposttime.'<br><br>
            <a>'.$usercaptionpost.'<br><br><br>';
        if ($userpicturepost > 0){
            echo '<img style="width:300px;max-width:300px;" src="Data/Images/JYPbuilding.png">';
        }
        echo'<br><br>
        <div style="text-align:center;height:60px">
            <a style="float:left;" onClick="passcommentID(commentbutton'.$tempcountpost.'.id,comments'.$tempcountpost.'.id);">'.$userlikepost.' '.$iflikeg0.'</a>
            <a style="float:right;" onClick="passcommentID(commentbutton'.$tempcountpost.'.id,comments'.$tempcountpost.'.id);">'.$usercommentpost.' '.$ifcommentg0.'</a><br><br>
            <div id="likecommentbutton"><a>Like</a></div>
            <a id="commentbutton'.$tempcountpost.'" onClick="passcommentID(this.id,comments'.$tempcountpost.'.id);"><div id="likecommentbutton">Comment</div></a>
        </div>
        <a style="text-align:center">
            <img id="commentImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />
            <input id="replyComment'.$tempcountpost.'" autocomplete="off" class="ReplyComment" type="text" placeholder="Enter comment here" name="ucommentpost">
            <img id="commentbtn" class="commentbtncss" onClick="addcomment(replyComment'.$tempcountpost.'.id,comments'.$tempcountpost.'.id)" src="Data/Images/JYPbuilding.png">
        </a>
        <div id="comments'.$tempcountpost.'"><a id="viewmore"></a></div>
        </div>';
        };
    echo'<div id="MoreUserPost" onClick="currentdisplaypost('.$tempcountpost.');">
            <a id="MorePost" >MORE</a>
        </div>';

    }