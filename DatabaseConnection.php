<?php

$dbUser = "root"; //root   id15136283_twonce
$dbPass = ""; //nopass    l12O^9u<Xu66N}KB
$dbDatabase = "appdownloads"; //appdownloads       id15136283_twoncetalents
$dbHost = "localhost";  //localhost;  127.0.0.1

$dbConn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbDatabase);

if ($dbConn) {
    mysqli_select_db($dbConn, $dbDatabase);
    //print("<strong>Successfully connected to Database.</strong>");
} else {
    die("<strong>Error :</strong> Could not connect to database.");
}

?>
