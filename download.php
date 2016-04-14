<?php
error_reporting(0);
include('connect.php');
if(isset($_GET['id'])) { // if id is set then get the file with the id from database

$id = $_GET['id'];
$path="";
$result = mysqli_query($conn, "select * from cmrtbl where cmrid=$id");
//$result = $conn->query($sql) or trigger_error($conn->error);
if($result === FALSE){
	echo"error";
	 echo "Error: " . $sql . "<br>" . $conn->error;
}
while($row = mysqli_fetch_array($result)) {
$path=$row['path'];
}
$myFileLocation=$path;

header("Content-disposition: attachment; filename=$path");
header("Content-type: application/pdf");
header('Content-Type: image/png');
header('Content-Type: image/jpg');
readfile($path);
}

?>