<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

$conn = mysqli_connect($servername , $username , $password , $database);

if(!$conn){
    die("Error due to " . mysqli_connect_error());
}
else{
    // echo "Connected Sucessfully";
}

?>