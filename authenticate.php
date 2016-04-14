<?php 
session_start();
include("connection.php");
 $username = "";
 $password = "";
 if(isset($_POST['username'])){
  $username = $_POST['username'];
 }
 if (isset($_POST['password'])) {
  $password = $_POST['password'];
 }
$password = md5($password);
 $q = 'SELECT * FROM userstbl WHERE username=:username AND password=:password';
 $query = $dbh->prepare($q);
 $query->execute(array(':username' => $username, ':password' => $password));

 if($query->rowCount() == 0){
  header('Location: index.php?err=1');
 }else{
  $row = $query->fetch(PDO::FETCH_ASSOC);
  session_regenerate_id();
  $_SESSION['sess_user_id'] = $row['userid'];
  $_SESSION['sess_username'] = $row['username'];
  $_SESSION['sess_userrole'] = $row['roleid'];
  $_SESSION['sess_useremail'] = $row['email'];
  $user_name=$_SESSION['sess_username'];
  $user_role=$_SESSION['sess_userrole'];
  session_write_close();
  
  if($user_role == "1"){
   header('Location: admin-course.php');
  }else  if( $user_role == "2"){
   header('Location: staffcl_home.php');
  }else  if( $user_role == "3" ){
   header('Location: staffcm_home.php');
  }else  if($user_role == "4"){
   header('Location: dlt_home.php');
  }else  if($user_role == "5"){
   header('Location: pvc_home.php');
  }else  if($user_role == "6"){
  header('Location: greport.php');}
  else{
     header('Location: index.php?err=1');
  }
 }
?>