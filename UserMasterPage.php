<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="CSS/MainStyle.css">
        <link rel="stylesheet" type="text/css" href="CSS/ImageModal.css">
        <link rel="stylesheet" type="text/css" href="CSS/CopiedDesign.css">
        <link rel="stylesheet" type="text/css" href="CSS/LoginDesign.css">
        <link rel="stylesheet" type="text/css" href="CSS/UserMediaStyle.css">
        <link rel="stylesheet" type="text/css" href="CSS/ProfileStyle.css">
        <link rel="icon" type="image/png" href="Data/Images/TWONCE Logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="circle1"> </div> <div class="circle2"> </div>
        <div id="wrapper">
            <div id="banner">
                <a href="UserIndex.php"><img id="logo" src="Data/Images/TWONCE Logo.png" title="Logo of a company" alt="TWONCETALENTS" /></a>
                <div id="headerlogin"><a id="headerloginbtn" href="UserProfile.php"><?php echo $username ?></a>&nbsp;|&nbsp;<a id="headerloginbtn" href='UserLogout.php'>Logout</a></div>
            </div>
            <nav id="navigation">
                <ui id="nav">
                    <li id="navtext1"> <a href="UserIndex.php">Home</a> </li>
                    <li id="navtext2"> <a href="UserMedia.php">Post</a> </li>
                    <li id="navtext3"> <a href="Contact.php">Contact</a> </li>
                    <li id="navtext4"> <a href="About.php">About</a> </li>
                </ui>
            </nav>
            <nav id="content"><br>
               <?php echo $content; ?>
            </nav>
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
    document.getElementById("headerlogin").style.fontSize = "17px";
    document.getElementById("headerlogin").style.margin = "60px 10px";
  }
}
</script>
</html>