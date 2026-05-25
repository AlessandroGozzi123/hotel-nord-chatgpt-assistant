<?php

$host = 'localhost';
$dbname = 'alessandro_gozzi';
$username = 'pwap';
$password = 'pwap654321';

$DB = mysqli_connect($host, $username, $password, $dbname) or die("Nepovedlo se pripojit k DB. ");
mysqli_set_charset($DB, "utf8");
?>