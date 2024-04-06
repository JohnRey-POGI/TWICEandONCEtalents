<?php 
require 'DatabaseConnection.php';

if ($dbConn) {
    mysqli_select_db($dbConn, $dbDatabase);
    //print("<strong>Successfully connected to Database.</strong>");
} else {
    die("<strong>Error :</strong> Could not connect to database.");
}
$download = "#";
$appName = "App Name";

$query = mysqli_query($dbConn,"SELECT * FROM appdownloads WHERE id = 1");
//if ($query){
    while (($row = mysqli_fetch_assoc($query))){
        //print($row['id']." - ".$row['appname']." - ".$row['downloads']."</br>");
        $download = ($row['downloads']);
        $appName = ($row['appname']);
    }
//} else {
//    print("<strong>Error :</strong> Query not working.");
//}
?>
<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location:index.php');
}


$title = "Home";
$username = $_SESSION['username'];
$content = '
<div id="postcontent" class="responsive"></br></br>
    <img src="Data/Images/Icons App.png" id="iconapp" title="JYP 2.0 Building" alt="JYP 2.0 Building" />
    </br>
    <a id="appname""> '.$appName. '</a>
    </br>
    <a id="mytext">Application for Android 9+</a>
    </br>
    <a id="mytext">' .$download. '</a> <a id="mytext"> downloads </a> 
    </br>
    <form action="" METHOD="POST"> <!-- action="Updatequery.php" TARGET="_BLANK" -->
        <button id="downloadbutton" type="submit" VALUE="1" name="pressed">DOWNLOAD</button>
    </form>
    
    </br></br>
    <div class="iframe-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/klmDNxM3QhY?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    </br></br>
    <img id="myImg1" src="Data/Images/JYPbuilding.png" title="JYP 2.0 Building" alt="JYP 2.0 Building" />
    <img id="myImg2" src="Data/Images/jyptop.png" title="JYP 2.0 Building top View" alt="JYP 2.0 Building top View" />
    <img id="myImg3" src="Data/Images/dining.png" title="JYPBOB" alt="JYPBOB" />
    <img id="myImg4" src="Data/Images/madonnaroom.png" title="Madonna dance room" alt="Madonna dance room" />
    <img id="myImg5" src="Data/Images/danceroom.png" title="JYPE main danceroom" alt="JYPE main danceroom" />
    </br>
    </br></br>
    <form action="" METHOD="POST"> <!-- action="Updatequery.php" TARGET="_BLANK" -->
        <button id="downloadbutton" type="submit" VALUE="1" name="pressed">DOWNLOAD</button>
    </form>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img1 = document.getElementById("myImg1");
var img2 = document.getElementById("myImg2");
var img3 = document.getElementById("myImg3");
var img4 = document.getElementById("myImg4");
var img5 = document.getElementById("myImg5");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img1.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
img2.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
img3.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
img4.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
img5.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

    
';

include 'UserMasterPage.php';
?>
