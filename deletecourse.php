<?php 
include("connect.php");
$courseid = $_GET['id']; 
$sql="DELETE FROM coursestbl WHERE courseid='$courseid'";
$result = $conn->query($sql) or trigger_error($conn->error);
if($result){
header('Refresh:0; admin-course.php#viewcourses'); /* Redirect browser */
exit();
}
else {
echo "There was and error";
}
?> 