<?php

$serverName = "localhost";
$username = "root";
$password = "";
$databaseName = "craigs_database";

$connection = mysqli_connect($serverName, $username, $password, $databaseName);
if (!$connection)  die("Connection failed: " . mysqli_connect_error());

mysqli_set_charset($connection, "utf8");

$queryData = mysqli_query( $connection, "SELECT id, title, latitude, longitude, address FROM items" );

$data = mysqli_fetch_all( $queryData, MYSQLI_ASSOC );

mysqli_close($connection);

// Data for map markers

echo( json_encode($data) );