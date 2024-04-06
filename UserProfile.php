<?php 
session_start();
require 'DatabaseConnection.php';
    
if (!isset($_SESSION['username'])){
    header('location:index.php');
} else {
    $userid = $_SESSION['userID'];
    $userpassword = $_SESSION['userpass'];
        //update user data
        //echo '<script>alert("'.$userpassword.'")</script>';
    if(isset($_POST['newuname'])){
        $newusername = $_POST['newuname'];
        if (!$newusername == "") {
            $newpassconfirm = $_POST['oldpass'];
            //$newpassconfirm = md5($newpassconfirm);   return
                //echo '<script>alert("new '.$newpassconfirm.' old'.$userpassword.'")</script>';
            if ($newpassconfirm == $userpassword) {
                    //echo '<script>alert("'.$newusername.'")</script>';
                $updateuserquery = mysqli_query($dbConn, "UPDATE `usertable` SET username = '".$newusername."' where userID = $userid");
                $_SESSION['username'] = $newusername;
                echo '<script>alert("Username was succesfully saved")</script>';
            } else {
                echo '<script>alert("The old password you entered didn`t match the password you entered!!!")</script>';
            }
        }
    }
        
    if(isset($_POST['newpass'])){
        $newuserpass = $_POST['newpass'];
        if (!$newuserpass == "") {
            $newpassconfirm = $_POST['oldpass'];
            //$newpassconfirm = md5($newpassconfirm);   return
            //echo '<script>alert("new '.$newpassconfirm.' old'.$userpassword.'")</script>';
            if ($newpassconfirm == $userpassword) {
                //$newuserpass = md5($newuserpass);     return
                //echo '<script>alert("'.$newuserpass.'")</script>';
                $updateuserquery = mysqli_query($dbConn, "UPDATE `usertable` SET userpass = '".$newuserpass."' where userID = $userid");
                $_SESSION['userpass'] = $newuserpass;
                echo '<script>alert("Password was succesfully saved")</script>';
            } else {
                echo '<script>alert("The old password you entered didn`t match the password you entered!!!")</script>';
            }
        }
    }
}

$userpostid = "";
$useridpost = "";
$userpicturepost = "";
$usercaptionpost = "";
$usercommentpost = "";
$userlikepost = "";
$userposttime = "";
$row = "";
$post = "";
$userpostname = "";

$title = "Media";
$username = $_SESSION['username'];
$userid = $_SESSION['userID'];

?>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
    function passcommentID(id,id2) {
        //alert("You Pressed:  " + id +" "+id2);
        //$(document).ready(function(){
            //$("#"+id).click(function(){
                var btnid = id + "";
                var postid = id2 + "";
                btnid = btnid.replace("commentbutton","");
                postid = postid.replace("comments","");
                //alert("You Pressed:  " + btnid +" "+postid);
                $("#"+id2).load("MorePostComment.php",{
                    UserPostComment: (postid - 1)
                });
            //});
        //});
    }
    function currentdisplaypost(currentposts) {
        //alert("Current post:  " + currentposts);
        //$(document).ready(function(){
            //userpost = 10;
            //$("#MoreUserPost").click(function(){
                userpost = currentposts + 5;
                $("#content").load("MoreUserProfilePost.php",{
                    UserPost: userpost,
                });
            //});
        //});
    }
    function addcomment(commentid,id2,commentcount){
        //alert("Current post:  " + commentid + " " + id2 + " " + commentcount);
        //var addnewcomment = document.getElementById(commentcount).value;
        var newcomment = document.getElementById(commentid).value;
        var newcommentid = commentid + "";
        var postid = id2 + "";
        
        if (newcomment !== ""){
            newcommentid = newcommentid.replace("replyComment","");
            postid = postid.replace("comments","");
            //alert("Current post:  " + newcomment + " " + newcommentid);
            $("#"+commentcount).load("AddNewComment.php",{
                NewComment: newcomment,
                NewCommentID: (newcommentid - 1)
            });
            $("#"+id2).load("MorePostComment.php",{
                UserPostComment: (postid - 1)
            });
            //addnewcomment += document.getElementById(commentcount).value;
            newcomment = document.getElementById(commentid).value = "";
        } else {
            alert("Please input text.");
        }
    }
    function viewmorecomment(id, id2, id3){
        //alert("Current comment:  " + id + "  " + id2 + " " + id3);
        //var newcommentcount = commentcount + 3;
        var commentid = id + "";
        var postid = id2 + "";
        commentid = commentid.replace("postcommentid"+id3,"");
        postid = postid.replace("comments","");//
        //alert("Current comment:  " + commentid + " "+id2+" " + postid);
        
        /*$("#"+id).load("MorePostComment.php",{
        });*/
        $("#"+id2).load("MorePostComment.php",{
            NewCommentCount: commentid,
            UserPostComment: (postid - 1)
        });
    }
    function passlikedID(id,buttonid, buttonstyle) {
        //alert("You Pressed:  " + id  + " "+ buttonid +"  " + buttonstyle);
        //$(document).ready(function(){
            //$("#"+id).click(function(){
                var newdesign = document.getElementById(buttonid).className;
                if (buttonstyle === 'likedcommentbutton') {
                    var newdesign = document.getElementById(buttonid).className = 'likecommentbutton';
                    //newdesign = 'likecommentbutton';
                    //alert("You Pressed:  unlike" + " " + newdesign);
                } else {
                    var newdesign = document.getElementById(buttonid).className = 'likedcommentbutton';
                    //newdesign = 'likedcommentbutton';
                    //alert("You Pressed:  like" + " " + newdesign);
                }
                var btnid = id + "";
                btnid = btnid.replace("likebutton","");
                //alert("You Pressed:  " + btnid +" "+id);
                $("#likecount"+btnid).load("UserLikePost.php",{
                    UserLikePost: (btnid - 1)
                });
                /*("#likebutton"+btnid).load("UserLikePost.php",{
                    UserLikePost: (btnid - 1)
                });*/
            //});
        //});
    }
</script>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/MainStyle.css">
        <link rel="stylesheet" type="text/css" href="CSS/ImageModal.css">
        <link rel="stylesheet" type="text/css" href="CSS/CopiedDesign.css">
        <link rel="stylesheet" type="text/css" href="CSS/LoginDesign.css">
        <link rel="stylesheet" type="text/css" href="CSS/UserMediaStyle.css">
        <link rel="stylesheet" type="text/css" href="CSS/ProfileStyle.css">
        <link rel="icon" type="image/png" href="Data/Images/TWONCE Logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="circle1"> </div> <div class="circle2"> </div>
        <div id="wrapper">
            <div id="banner">
                <a href="UserIndex.php"><img id="logo" src="Data/Images/TWONCE Logo.png" width="250" height="250" title="Logo of a company" alt="TWONCETALENTS" /></a>
                <div id="headerlogin"><a id="headerloginbtn" href="UserProfile.php"><?php echo $username ?></a>&nbsp;|&nbsp;<a id="headerloginbtn" href="UserLogout.php">Logout</a></div>
            </div>
            <nav id="navigation">
                <ui id="nav">
                    <li id="navtext1"> <a href="UserIndex.php">Home</a> </li>
                    <li id="navtext2"> <a href="UserMedia.php">Post</a> </li>
                    <li id="navtext3"> <a href="Contact.php">Contact</a> </li>
                    <li id="navtext4"> <a href="About.php">About</a> </li>
                </ui>
            </nav>
            <div id="content">
                <div id="postcontent" class="responsive">
                <div style="font-size:30px">Profile</div><br><br>
                <form action="" method="POST">
                    <div style="font-size:20px"><b style="margin-right:57px;">Name</b>
                    <input id="uname" name="newuname" class="usernamepassinput" type="text" placeholder="<?php echo $username ?>" maxlength="10"></div>
                    <br>
                    <div style="font-size:20px;"><b style="margin-right:20px;">Password</b>
                    <input id="psw" name="newpass" class="usernamepassinput" type="password" placeholder="  **********" maxlength="50"></div>
                    <br>
                    <div style="font-size:20px;"><b>Old Password</b><br>
                    <input id="oldpsw" style="text-align:center;" name="oldpass" class="usernamepassinput" type="password" placeholder="**********" maxlength="50" required></div>
                    <br>
                    <button id="saveprofilebtn" name="btnsubmit" type="submit">Save</button>
                    <br>
                </form>
                </div>
                <div id="postcontainerenter" style="margin-top: 0px">
                    <a><img id="myinputImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" /></a>
                    <form action="UserAddProfilePost.php" method="POST">
                        <a id="postinputtext"><input style="border-radius: 40px;width:80%;" autocomplete="off" type="text" placeholder="Enter text here" maxlength="1000" name="upost" required></a>
                        <br>
                            <!--<button id="postpicture">PICTURE</button>-->
                            <button id="userpost" type="submit">POST</button>
                        <!--<br><div id="refresh"></div><br>-->
                    </form>    
                </div>
                <?php
                
                    // validate if admin
                    $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE userID = 1");
                    while (($row = mysqli_fetch_assoc($result))){
                        $userposition = ($row['username']);
                    }
                    //echo '<script>alert("'.$userposition.'")</script>';
                    
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
                                                    ON a.UserIDPost = b.userID where UserIDPost = $userid 
                                                    order by a.UserPostID DESC
                                                    LIMIT 10");
                    $tempcountpost = 0;
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
                        echo '>'.$userpostname.'</a></b><br>'
                            . '<a style="color:gray;">&nbsp;&nbsp;'.$userposttime.'<br><br>'
                            . '<a>'.$wrapusercaptionpost.'<br><br><br>';
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
                    echo'<div id="MoreUserPost" onClick="currentdisplaypost('.$tempcountpost.');" >
                            <a id="MorePost">MORE</a>
                        </div>';
                ?>
                
            </div>
            <footer id="footer">
                All Rights Reserve 2020
                <br>
                <a href="https://www.facebook.com/twoncetalents"><img src="Data/Images/FacebookLogo.png" width="40"></a> &nbsp;
                <a href="https://www.youtube.com/channel/UCSUStQs2lX7KCLH6wdqnbFA"><img src="Data/Images/YoutubeLogo.png" width="50" style="margin-top: 5px"></a>
            </footer>
        </div>
    </body>
<script>    
// Get the modal
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}
// Get the modal
var modal1 = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 120 || document.documentElement.scrollTop > 120) {
    document.getElementById("logo").style.height = "100px";
    document.getElementById("logo").style.width = "100px";
    document.getElementById("banner").style.height = "100px";
    document.getElementById("navigation").style.top = "100px";
    document.getElementById("headerlogin").style.fontSize = "15px";
    document.getElementById("headerlogin").style.margin = "40px 20px";
  } else {
    document.getElementById("logo").style.height = "150px";
    document.getElementById("logo").style.width = "150px";
    document.getElementById("banner").style.height = "150px";
    document.getElementById("navigation").style.top = "150px";
    document.getElementById("headerlogin").style.fontSize = "20px";
    document.getElementById("headerlogin").style.margin = "60px 10px";
  }
}
</script>
</html>