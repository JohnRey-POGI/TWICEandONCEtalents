<?php
session_start();
if(!$_SESSION['emailsend']) {
    header('location:index.php');
}?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/MainStyle.css">
        <link rel="icon" type="image/png" href="Data/Images/TWONCE Logo.png">
        <title></title>
    </head>
    <body>
        <div class="circle1"> </div>
        <div class="circle2"> </div>
        <footer id="footer">
        </footer>
        <div id="ThankyouRegistration" style="text-align: center;">
            <img id="ThankyouDesign" style="" src="Data/Images/TWONCE Logo.png" title="TWONCEtalents" alt="TWONCETALENTS" />
            <br>Thank you for register ONCE!!!<br>Please verify your account via email<br><br><br>
            
            <a href="index.php">Go to Home Page</a><br>
        </div>
        <br>
        <footer id="footer">
            All Rights Reserve 2020
            <br>
            <a href="https://www.facebook.com/twoncetalents"><img src="Data/Images/FacebookLogo.png" width="40"></a> &nbsp;
            <a href="https://www.youtube.com/channel/UCSUStQs2lX7KCLH6wdqnbFA"><img src="Data/Images/YoutubeLogo.png" width="50" style="margin-top: 5px"></a>
        </footer>
    </body>
</html>
