<?php 
ob_start();
session_start();

require 'DatabaseConnection.php';

if (isset($_SESSION['username'])){
    header('location:UserMedia.php');
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
use PHPMailer\PHPMailer\PHPMailer;

    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");
    
$userid = "";
$username = "";
$ifconfirmed = "";
if (isset($_POST['unameLI'])){
    $username = $_POST['unameLI'];
    $password = $_POST['psw'];
    
    $username = mysqli_real_escape_string($dbConn,$username);
    $password = mysqli_real_escape_string($dbConn,$password);
    
    //$password = md5($password);
    
    $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE username = '".$username."' and userpass = '".$password."'"); // and isEmailConfirmed = 1
    while (($row = mysqli_fetch_assoc($result))){
        $userid = ($row['userID']);
        $ifconfirmed = ($row['isEmailConfirmed']);
    }
    if ($ifconfirmed == '0') {
        echo '<script> alert("Please verify your account first."); </script>';
    } else {
        if (mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            $_SESSION['userpass'] = $password;
            $_SESSION['userID'] = $userid;
            header('location:UserIndex.php');
        } else {
            //header('location:index.php");
            //echo '<script> alert('.$ifconfirmed.'); </script>'; 
            echo '<script> alert("Please enter a valid account."); </script>';
        } 
    }
}

$useremail = "";
if (isset($_POST['unameSU'])){
    $useremail = $_POST['uemail'];
    $username = $_POST['unameSU'];
    $password = $_POST['psw'];
    $password2 = $_POST['psw-repeat'];
    $vkey = time();
    //echo '<script>alert("'.$password.'");</script>';
    if (strlen($username) < 5){
        echo '<script>alert("Your username must be atleast 5 characters");</script>';
    } else if ($password != $password2) {
        echo '<script>alert("Your password does not match");</script>';
    } else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Enter a Valid Email!!!");</script>';
    } else {
        //$password = $password2;
        $useremail = mysqli_real_escape_string($dbConn,$useremail);
        $username = mysqli_real_escape_string($dbConn,$username);
        $password = mysqli_real_escape_string($dbConn,$password);
        
        $vkey = md5($vkey);
        
        //$password = md5($password);
        
        //echo '<script>alert("'.$password.'");</script>';
    
        $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE useremailadd = '".$useremail."' or username = '".$username."'");
        if (mysqli_num_rows($result) >= 1){
            echo '<script> alert("Email address or UserName was already taken"); </script>';
        } else {
            $getemailacc = mysqli_query($dbConn, "SELECT * FROM tokenaccount");
            $tokenemail = "";
            $tokenpass = "";
            while ($row1 = mysqli_fetch_assoc($getemailacc)) {
                $tokenemail = ($row1['emailacc']);
                $tokenpass = ($row1['passwordacc']);
            }
            
            $insertuserquery = mysqli_query($dbConn,"INSERT into usertable (username,userpass,useremailadd,EmailCode) VALUES('".$username."','".$password."','".$useremail."','".$vkey."')");
            if ($insertuserquery) {
                
                /*$to = $useremail;
                $subject = "Email Verification";
                $message = "<a> href='http://localhost/registerverification.phpvkey=$vkey'</a>";
                $headers = "From: twoncetalents@gmail.com \r\n";
                $headers .= "MIME-Version: 1.0". "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                echo '<script> alert("to :'.$to.' from :'.$subject.' Message :'.$message.'"); </script>';
                //mail($to, $subject, $message, $headers);*/
                
                include_once "PHPMailer/PHPMailer.php";
                
                $mail = new PHPMailer();
                $mail->IsSMTP(); 

                $mail->CharSet="UTF-8";
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPDebug = 1; 
                $mail->Port = 465 ; //465 or 587

                 $mail->SMTPSecure = 'ssl';  
                $mail->SMTPAuth = true; 
                $mail->IsHTML(true);

                //Authentication
                $mail->Username = $tokenemail;
                $mail->Password = $tokenpass;

                //Set Params
                /*$mail->SetFrom("twoncetalents@gmail.com");
                $mail->AddAddress("johnreystaana@gmail.com");
                $mail->Subject = "Test";
                $mail->Body = "hello";*/

                /*if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    echo "Message has been sent";
                }*/
                //$mail = new PHPMailer();
                $mail->setFrom($tokenemail);
                $mail->addAddress($useremail, $username);
                $mail->Subject = 'Email Verification';
                $mail->isHTML(true);
                $mail->Body = "
                        Please click the link below to verify your registration<br><br>
                        
                        <a href='https://twoncetalents.000webhostapp.com/EmailConfirmation.php?vkey=$vkey&email=$useremail'>Verify here</a>
                        ";
                        //https://twoncetalents.000webhostapp.com/EmailConfirmation.php
                        //http://localhost/TWONCEwebsite/EmailConfirmation.php
                if($mail->send()){
                    //echo '<script> alert("Successfully registered, PLease verify your email!"); </script>';
                    $_SESSION['emailsend'] = $mail;
                    header('location:ThankyouRegister.php');
                    ob_end_flush();
                } else {
                    echo '<script> alert("Error! not register"); </script>';
                    //header('location: UserMasterPage.php');
                }
                //header('location:ThankyouRegister.php');
                
                /*$result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE username = '".$username."' and userpass = '".$password."'");
                while (($row = mysqli_fetch_assoc($result))){
                    $userid = ($row['userID']);
                }
                if (mysqli_num_rows($result) == 1){
                    $_SESSION['username'] = $username;
                    $_SESSION['userID'] = $userid;
                    //header('location:UserIndex.php');
                } else {
                    echo '<script> alert("Please enter a valid account"); </script>';
                }*/
            } else {
                echo '<script>alert("Error occured");</script>';
            }
        }
    }
}
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
        alert("Please Login or Sign Up first!!!");
        //$(document).ready(function(){
            //userpost = 10;
            //$("#MoreUserPost").click(function(){
                /*userpost = currentposts + 5;
                $("#content").load("MoreUserPost.php",{
                    MediaPost: userpost
                });*/
            //});
        //});
    }
    function addcomment(commentid){
        var removecomment = document.getElementById(commentid).value = "";
        alert("Please Login or Sign Up first!!!");
    }
    function viewmorecomment(id, id2, id3){
        //alert("Current comment:  " + commentcount + "  " + id2);
        //var newcommentcount = commentcount + 3;
        var commentid = id + "";
        var postid = id2 + "";
        commentid = commentid.replace("postcommentid"+id3,"");
        postid = postid.replace("comments","");
        //alert("Current comment:  " + commentid + " "+id2+" " + postid);
        
        /*$("#"+id).load("MorePostComment.php",{
        });*/
        $("#"+id2).load("MorePostComment.php",{
            NewCommentCount: commentid,
            UserPostComment: (postid - 1)
        });
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
        <link rel="icon" type="image/png" href="Data/Images/TWONCE Logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="circle1"> </div> <div class="circle2"> </div>
        <div id="wrapper">
            <div id="banner">
                <a href="UserIndex.php"><img id="logo" src="Data/Images/TWONCE Logo.png" width="250" height="250" title="Logo of a company" alt="TWONCETALENTS" /></a>
                
                <div id="headerlogin"><a onclick="document.getElementById('id01').style.display='block'">Log in</a>
                |&nbsp;<a onclick="document.getElementById('id02').style.display='block'">Sign Up</a></div>
            
            </div>
            <nav id="navigation">
                <ui id="nav">
                    <li id="navtext1"> <a href="index.php">Home</a> </li>
                    <li id="navtext2"> <a href="Media.php">Post</a> </li>
                    <li id="navtext3"> <a href="Contact.php">Contact</a> </li>
                    <li id="navtext4"> <a href="About.php">About</a> </li>
                </ui>
            </nav>
            <nav id="content"><br><div style="margin-top: 180px">PLEASE LOG IN</div>
                
                <?php
                    // validate if admin
                    $result = mysqli_query($dbConn,"SELECT * FROM usertable WHERE userID = 1");
                    while (($row = mysqli_fetch_assoc($result))){
                        $userposition = ($row['username']);
                    }
                    
                    $query = mysqli_query($dbConn,"SELECT * FROM userposttable AS a
                                                    LEFT JOIN usertable AS b
                                                    ON a.UserIDPost = b.userID
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
                        echo '>'.$userpostname.'</a></b><br>'
                            . '<a style="color:gray;">&nbsp;&nbsp;'.$userposttime.'<br><br>'
                            . '<a>'.$usercaptionpost.'<br><br><br>';
                        if ($userpicturepost > 0){
                            echo '<img style="width:300px;max-width:300px;" src="Data/Images/JYPbuilding.png">';
                        
                        }
                        echo'<br><br>
                            <div style="text-align:center;height:60px">
                                <a style="float:left;">'.$userlikepost.' '.$iflikeg0.'</a>
                                <a style="float:right;" onClick="passcommentID(commentbutton'.$tempcountpost.'.id,comments'.$tempcountpost.'.id);">'.$usercommentpost.' '.$ifcommentg0.'</a><br><br>
                                <div class="likecommentbutton"><a>Like</a></div>
                                <a id="commentbutton'.$tempcountpost.'" onClick="passcommentID(this.id,comments'.$tempcountpost.'.id);"><div class="likecommentbutton">Comment</div></a>
                            </div>
                            <a style="text-align:center">
                                <img id="commentImg" src="Data/Images/JYPbuilding.png" title="Profile" alt="Profile" />
                                <input id="replyComment'.$tempcountpost.'" autocomplete="off" class="ReplyComment" type="text" placeholder="Enter comment here" name="ucommentpost">
                                <img id="commentbtn" class="commentbtncss" onClick="addcomment(replyComment'.$tempcountpost.'.id)" src="Data/Images/sendlogo.png">
                            </a>
                            <div id="comments'.$tempcountpost.'"><a id="viewmore"></a></div>
                            </div>';
                    };
                    echo'<div id="MoreUserPost" onClick="currentdisplaypost('.$tempcountpost.');" >
                            <a id="MorePost">MORE</a>
                        </div>';
                ?>
            </nav>
            <footer id="footer">
                All Rights Reserve 2020
                <br>
                <a href="https://www.facebook.com/twoncetalents"><img src="Data/Images/FacebookLogo.png" width="40"></a> &nbsp;
                <a href="https://www.youtube.com/channel/UCSUStQs2lX7KCLH6wdqnbFA"><img src="Data/Images/YoutubeLogo.png" width="50" style="margin-top: 5px"></a>
            </footer>
        </div>
    <div id="id01" class="modal">

        <form class="modal-content animate" action="" method="POST">
          <!---->

        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="Data/Images/TWONCE Logo.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <!--<form METHOD="POST" TARGET="_BLANK" >
            </form>-->
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="unameLI" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button id="btnlogin" type="submit" >LOGIN</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtnlogin">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
          <!---->
      </form>
    </div>


    <div id="id02" class="modal">
      <span onclick="document.getElementById('id02').style.display='none'" class="closesignup" title="Close Modal">&times;</span>
      <form class="modal-content" action="" method="POST">
        <div class="container">
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="uemail" maxlength="50" required>

          <label for="email"><b>UserName</b></label>
          <input type="text" placeholder="Enter User Name" name="unameSU" maxlength="10" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" maxlength="50" required>

          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw-repeat" maxlength="50" required>

          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
          </label>

          <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

          <div class="clearfix">
            <button id="btnsignup" type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtnsignup">Cancel</button>
            <button id="btnsignup" type="submit" class="signupbtnsignup">Sign Up</button>
          </div>
        </div>
      </form>
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