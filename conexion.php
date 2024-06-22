<?php

$server = "localhost";
$db = "aproyect";
$user = "root";
$pass = "";

$connect = @mysqli_connect($server, $user, $pass, $db);

if (!$connect) {
    echo "<div class='alert alert-danger'>Error: " . mysqli_connect_error() . "</div>";
    exit();
}

?>