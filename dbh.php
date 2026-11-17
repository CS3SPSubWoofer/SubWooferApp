<?php

$serverName = "";
$DBUserName = "localhost";
$dbpass = "";
$dBName = "subwoofer";


$conn = mysqli_connect($serverName,$DBUserName, $dbpass,$dBName);

mysqli_set_charset($conn, "utf8mb4");

if (!$conn) {
    die("no connection: " . mysqli_connect_error());

}
