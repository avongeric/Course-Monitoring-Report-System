<?php
error_reporting(0); 
    include("connect.php");
	session_start();
    $user_role=$_SESSION['sess_userrole'];
	$user = $_SESSION['sess_username'];
	$uid = $_SESSION['sess_user_id'] ;
	if(!isset($_SESSION['sess_username']) || $user_role!="1"){
      header('Location: index.php?err=2');
    }
    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">CMR System</a> 
            </div>
  <div style="color: white; padding: 15px 50px 5px 50px;float: right;font-size: 16px;"><?php

echo "Today is " . date("l"); echo "&nbsp;&nbsp;". date("Y-M-d") ;
?> 
  <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    <li>
                        <a   href="admin-course.php"><i class="fa fa-dashboard fa-3x"></i> Courses</a>
                    </li>
                     <li>
                        <a class="active-menu" href="admin_usersaccount.php"><i class="fa fa-desktop fa-3x"></i> Users Account</a>
                    </li><li>
                        <a  href="faculty.php"><i class="fa fa-qrcode fa-3x"></i> Faculty</a>
                    </li>
						   <li  >
                        <a   href="report.php" target="_blank"><i class="fa fa-bar-chart-o fa-3x"></i> Report</a>
                    </li>	
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. </h5>
                    </div>
                </div>
                  <hr />
				<div class="col-md-10 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic User Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#adduser" data-toggle="tab">Add User </a>
                                </li>
                                <li class=""><a href="#viewusers" data-toggle="tab">View Users</a>
                                </li>
								<li class=""><a href="#roles" data-toggle="tab">Add Roles</a>
                                </li>
								<li class=""><a href="#viewroles" data-toggle="tab">View Roles</a>
                                </li>
                            </ul>

                            <div class="tab-content">
								
                                <div class="tab-pane fade active in" id="adduser">
								<?php
									if(isset($_POST['btninsert'])){
										 //$password = md5($password);
									$username =  $_POST['txtusername'];
									$password = md5($_POST['txtpassword']);
									$role = $_POST['txtselectrole'];
									$email = $_POST['txtemail'];
									if($username=="" || $password== "" || $role== ""|| $email== ""){	
									echo "<span style='color:red'>All fields are required.<span>";
											}else{
									$sql = "INSERT INTO userstbl (username, password, roleid, email) VALUES ('$username', '$password', '$role','$email')";
									if($conn->query($sql) === TRUE){
										echo "<p class='text-success'>Record added successfully.</p>";
									} else{
										echo "<p class='text-danger'>Insert users error.<p> " ; 
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
									}}
									
								?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name="txtusername" id="txtusername" type="text"/>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="txtpassword" id="txtpassword"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Role</label>
											<?php
										 $result = mysqli_query($conn, "SELECT roleid,rolename FROM roletbl");
										 echo '<select  class="form-control" name="txtselectrole" id="txtselectrole">';
										 echo "<option value=''></option>";
										 while($r = mysqli_fetch_array($result))
										 { 
										 echo "<option value='" .$r['roleid'] ."'>".$r['rolename']. "</option>";
										 }
										 echo "</select>";
										?>
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="txtemail" id="txtemail"/>
                                        </div>
                                        <button type="submit" name="btninsert" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="viewusers">
                                    <p></p>
                                    <div class="panel-body">
									<div class="table-responsive">
											<?php 
											
												$sql = "SELECT u.userid,u.username,r.rolename,u.email FROM userstbl u,roletbl r where r.roleid=u.roleid";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
												  <tr><th>Username</th><th>Role</th><th>Email</th><th>Delete</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
													 <td>" . $row['username']. "</td>
													 <td>" . $row['rolename']. "</td>
													 <td>" . $row['email']. "</td>
													  <td>" . '<a href="deleteuser.php?id=' . $row['userid'] . '" class="btn btn-danger">Delete</button>'. "</td>
													 </tr>";
												 }
												 echo "</table>";
												} else {
													 echo "0 results";
												}
										?> 
						</div>
				</div>
                                </div>
								<div class="tab-pane fade" id="roles">
								<?php
									if(isset($_POST['btninsertrole'])){
										 //$password = md5($password);
									$rolename =  $_POST['txtrole'];
									if($rolename=="" ){	
									echo "<span style='color:red'>Role name cannot be enter.<span>";
											}else{
									$sql = "INSERT INTO roletbl (rolename) VALUES ('$rolename')";
									if($conn->query($sql) === TRUE){
										echo "<p class='text-success'>Record added successfully.</p>";
									} else{
										echo "<p class='text-danger'>Insert role error.<p> " ; 
									}
									}}
									
								?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="form-group">
                                            <label>Role Name</label>
                                            <input class="form-control" name="txtrole" id="txtrole" type="text"/>
                                        </div>
                                        <button type="submit" name="btninsertrole" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>

                                    </form>
                                </div>
								<div class="tab-pane fade" id="viewroles">
                                    <p></p>
                                    <div class="panel-body">
									<div class="table-responsive">
											<?php 
											
												$sql = "SELECT roleid,rolename FROM roletbl";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
												  <tr><th>Role Name</th><th>Delete</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
													 <td>" . $row['rolename']. "</td>
													  <td>" . '<a href="deleterole.php?id=' . $row['roleid'] . '" class="btn btn-danger">Delete</button>'. "</td>
													 </tr>";
												 }
												 echo "</table>";
												} else {
													 echo "0 results";
												}
										?> 
						</div>
				</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</div>
                
                </div>          
			</div>
            </div>
        </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
