<?php
error_reporting(0);
include("connect.php");
session_start();
$user_role=$_SESSION['sess_userrole'];
$user = $_SESSION['sess_username'];
$uid = $_SESSION['sess_user_id'] ;
	//isset($_SESSION['valid'])
if(!isset($_SESSION['sess_username']) || $user_role!="1"){
header('Location: index.php?err=2');
}
?>	
<!DOCTYPE html>
<html>
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
                        <a  class="active-menu" href="admin-course.php"><i class="fa fa-dashboard fa-3x"></i> Courses</a>
                    </li>
                     <li>
                        <a  href="admin-users.php"><i class="fa fa-desktop fa-3x"></i> Users Account</a>
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
            <div class="row">
                <div class="col-md-10 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Course Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
							
                                <li class="active"><a href="#addcourse" data-toggle="tab">Add New Course</a>
                                </li>
                                <li class=""><a href="#viewcourses" data-toggle="tab">View Courses</a>
                                </li>
                                <li class=""><a href="#assigncourse" data-toggle="tab">Assign Course</a>
                                </li>
                            </ul>

                            <div class="tab-content">
							
                                <div class="tab-pane fade active in" id="addcourse">
								
								<?php
								
								if(isset($_POST['btninsert'])){
								$facultyid = $_POST['selectfaculty'];
								$id =  $_POST['txtcourseid'];
								$name =  $_POST['txtcoursename'];
								$aim =  $_POST['txtaim'];
								$description =  $_POST['txtdescription'];
								if($facultyid=="" || $id== "" || $name== ""|| $aim== ""|| $description== ""){	
									echo "<span style='color:red'>All fields are required.<span>";
											}else{
								$sql = "INSERT INTO coursestbl (facultyid, courseid, name, aim, description) VALUES ('$facultyid','$id', '$name','$aim','$description')";
								if($conn->query($sql) === TRUE){
									echo "<span style='color:green'>Records added successfully.</span>";
								} else{
									echo "<span style='color:red'>Error With Course ID.</span>";
								}
								}}
							?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="form-group">
                                            <label>Select Faculty</label>
											<?php
											 $result = mysqli_query($conn, "SELECT facultyid,facultyname FROM facultytbl");
											 echo '<select  class="form-control" name="selectfaculty" id="selectfaculty">';
											 echo "<option value=''></option>";
											 while($r = mysqli_fetch_array($result))
											 { 
											 echo "<option value='" .$r['facultyid'] ."'>".$r['facultyname']. "</option>";
											 }
											 echo "</select>";
											?>
                                        </div>
                                        <div class="form-group">
                                            <label>Course ID</label>
                                            <input class="form-control" name="txtcourseid" id="txtcourseid"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input class="form-control"  name="txtcoursename" id="txtcoursename"/>
                                        </div>
										<div class="form-group">
                                            <label>Course Aim</label>
                                            <textarea class="form-control" name="txtaim" id="txtaim" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Description</label>
                                            <textarea class="form-control" name="txtdescription" id="txtdescription" rows="3"></textarea>
                                        </div>
                                        <button type="submit" name="btninsert" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="viewcourses">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<?php 
											
												$sql = "SELECT c.courseid, c.name,c.description,f.facultyname FROM coursestbl c,facultytbl f where c.facultyid=f.facultyid";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Course Name</th><th>Faculty</th><th>Description</th><th>Update</th><th>Delete</th></tr>";
												 while($row = $result->fetch_assoc()) {
													echo "<tr>
										 <td>" . $row['name']. "</td>
										 <td>" . $row['facultyname']. "</td>
										 <td> " .'<a href="coursedescription.php?id=' . $row['courseid'] . '" target="_blank">View</a>'."</td>
										 
										  <td>" .'<a class="btn btn-success" href="admin_updatecourse.php?id=' . $row['courseid'] . '" target="_blank">Click</a>'. "</td>
										  
										 <td>" . '<a class="btn btn-danger" href="deletecourse.php?id=' . $row['courseid'] . '">Delete</a>'."</td>
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
                                <div class="tab-pane fade" id="assigncourse">
								
                                    <p></p>
									<?php
									if(isset($_POST['btnassign'])){
										 //$password = md5($password);
									$courseid = $_POST['selectcourse'];
									$academicyear = $_POST['selectacdyear'];
									$courseleader =  $_POST['selectcl'];
									$coursemoderator = $_POST['selectcm'];
									if($courseid == "" ||$academicyear=="" || $courseleader== "" || $coursemoderator== ""){	
									echo "<span style='color:red'>All fields are required.<span>";
											}else if($courseleader == $coursemoderator){	
									echo "<span style='color:red'>A staff cannot be both courseleader and coursemoderator.<span>";
									}else{
									$sql = "INSERT INTO assigntbl (courseid, academicyear, courseleader, coursemoderator) VALUES ('$courseid', '$academicyear', '$courseleader', '$coursemoderator')";
									if($conn->query($sql) === TRUE){
										echo "<p class='text-success'>Record added successfully.</p>";
									} else{
										echo "<p class='text-danger'>Insert course error.<p> " ;										
									}
									}}
									
								?>
									
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="form-group">
									<label>Select Course</label>
									<?php
											 $result = mysqli_query($conn, "SELECT courseid,name FROM coursestbl where courseid not in (select courseid from assigntbl)");
											 echo '<select  class="form-control" name="selectcourse" id="selectcourse">';
											 echo "<option value=''></option>";
											 while($r = mysqli_fetch_array($result))
											 { 
											 echo "<option value='" .$r['courseid'] ."'>".$r['name']. "</option>";
											 }
											 echo "</select>";
											?>
									</div>
									<div class="form-group">
									<label>Select Academic Year</label>
									<?php
											 $result = mysqli_query($conn, "SELECT acyearid,year FROM academicyear");
											 echo '<select  class="form-control" name="selectacdyear" id="selectacdyear">';
											 echo "<option value=''></option>";
											 while($r = mysqli_fetch_array($result))
											 { 
											 echo "<option value='" .$r['acyearid'] ."'>".$r['year']. "</option>";
											 }
											 echo "</select>";
											?>
									</div>
									<div class="form-group">
									<label>Select Course Leader</label>
									<?php
											 $result = mysqli_query($conn, "SELECT userid,username FROM userstbl where roleid='2'");
											 echo '<select  class="form-control" name="selectcl" id="selectcl">';
											 echo "<option value=''></option>";
											 while($r = mysqli_fetch_array($result))
											 { 
											 echo "<option value='" .$r['userid'] ."'>".$r['username']. "</option>";
											 }
											 echo "</select>";
											?>
									</div>
									<div class="form-group">
									<label>Select Course Moderator</label>
									<?php
											 $result = mysqli_query($conn, "SELECT userid,username FROM userstbl where roleid='3'");
											 echo '<select  class="form-control" name="selectcm" id="selectcm">';
											 echo "<option value=''></option>";
											 while($r = mysqli_fetch_array($result))
											 { 
											 echo "<option value='" .$r['userid'] ."'>".$r['username']. "</option>";
											 }
											 echo "</select>";
											?>
									</div>
									<button type="submit" name="btnassign" class="btn btn-success">Assign Course</button>
                                    </form>
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
