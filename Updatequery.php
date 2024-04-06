<?php 
require ("DatabaseConnection.php");
$insidedownload = "#";
if (!isset($_POST['pressed'])){
    header('location:index.php');
} else {
    if($_POST['pressed'] == 1 ){
        $query = mysqli_query($dbConn,"SELECT * FROM appdownloads WHERE id = 1");

        while ($row = mysqli_fetch_assoc($query)){
            //print($row['id']." - ".$row['appname']." - ".$row['downloads']."</br>");
            $insidedownload = $row['downloads'];
        }

        $sql = mysqli_query($dbConn,"UPDATE appdownloads SET downloads = ".$insidedownload." + 1 WHERE id = 1");

        //header("Location: https://drive.google.com/file/d/1CX76Q3-9T0BLu2OI012CEn_cT5DbK30c/view?usp=sharing");
        header("Location: https://drive.google.com/u/0/uc?id=1CX76Q3-9T0BLu2OI012CEn_cT5DbK30c&export=download");
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
-->
