<?php
$servername = "mysql.cms.gre.ac.uk";
$username = "aa9625f";
$password = "avm8My9Q";
$dbname = "mdb_aa9625f";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
?>  