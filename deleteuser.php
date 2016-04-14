<?php 
include("connect.php");
$userid = $_GET['id']; 
$sql="DELETE FROM userstbl WHERE userid='$userid'";
$result = $conn->query($sql) or trigger_error($conn->error);
if($result){
header('Refresh:0; admin-users.php.php#viewusers'); /* Redirect browser */
exit();
}
else {
echo "There was an error";
}
?> 