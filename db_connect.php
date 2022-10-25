<?php

$servername = "localhost";
$username ="root";
$password = "";
$database = "chatpro";

// Creating database connection

$conn = mysqli_connect($servername, $username, $password, $database, 3306);

//Check connection

if(!$conn)
{
    die("Failed to connect". mysqli_connect_error());
}

?>