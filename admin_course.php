<?php
	include('connect.php');
	session_start();
    $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) || $role!="admin"){
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
                        <a  class="active-menu" href="admin_course.php"><i class="fa fa-dashboard fa-3x"></i> Courses</a>
                    </li>
                     <li>
                        <a  href="admin_usersaccount.php"><i class="fa fa-desktop fa-3x"></i> Users Account</a>
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
								$facultyid = mysql_real_escape_string($_POST['selectfaculty']);
								$id = mysql_real_escape_string($_POST['txtcourseid']);
								$name = mysql_real_escape_string($_POST['txtcoursename']);
								$aim = mysql_real_escape_string( $_POST['txtaim']);
								$description = mysql_real_escape_string($_POST['txtdescription']);
								if($facultyid=="" || $id== "" || $name== ""|| $aim== ""|| $description== ""){	
									echo "<span style='color:red'>All fields are required.<span>";
											}else{
								$sql = "INSERT INTO CoursesTBL (facultyid, courseid, name, aim, description) VALUES ('$facultyid','$id', '$name','$aim','$description')";
								if(mysql_query($sql)){
									echo "<p class='text-success'>Records added successfully.</p>";
								} else{
									echo "<p class='text-danger'>Change Course ID.</p>";
								}
								}}
							?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										<div class="form-group">
                                            <label>Select Faculty</label>
                                            <?php
												$sql=mysql_query("SELECT facultyid,facultyname FROM facultytbl");
												if(mysql_num_rows($sql)){
												$select= '<select  class="form-control" name="selectfaculty" id="selectfaculty">';
												while($rs=mysql_fetch_array($sql)){
													  $select.='<option value="'.$rs['facultyid'].'">'.$rs['facultyname'].'</option>';
												  }
												}
												$select.='</select>';
												echo $select;
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
												$sql = "SELECT c.courseid, c.name,c.description,f.facultyname FROM CoursesTBL c,FacultyTBL f where c.facultyid=f.facultyid";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
												 <tr><th>Course Name</th><th>Faculty</th><th>Description</th><th>Update</th><th>Delete</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
													 <td>" . $row['name']. "</td>
													 <td>" . $row['facultyname']. "</td>
													 <td> " .'<a href="course_desc.php?id=' . $row['courseid'] . '" target="_blank">View</a>'."</td>
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
								<?php
								if(isset($_POST['btnassigncourse'])){
									$courseid = mysql_real_escape_string($_POST['selectcourse']);
									$academicyear = mysql_real_escape_string($_POST['selectacdyear']);
									$courseleader = mysql_real_escape_string( $_POST['selectcl']);
									$coursemoderator = mysql_real_escape_string($_POST['selectcm']);
									 if($courseleader == $coursemoderator){
										  echo "<p class='text-danger'> A staff cannot be both courseleader and coursemoderator</p>";
										}
									else{
									$sql = "INSERT INTO assigntbl (courseid, academicyear, courseleader, coursemoderator) VALUES ('$courseid', $academicyear', '$courseleader', '$coursemoderator')";
									if(mysql_query($sql)){
										echo "<p class='text-success'>Records added successfully.</p>";
									} else{
										echo "<p class='text-danger'> Could not able to execute </p> ";
								}}}
								?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="form-group">
									<label>Select Course</label>
									<?php
										$sql=mysql_query("SELECT courseid,name FROM coursestbl where courseid not in (select courseid from assigntbl)");
										if(mysql_num_rows($sql)){
										$select= '<select  class="form-control" name="selectcourse" id="selectcourse">';
										
										while($row=mysql_fetch_array($sql)){
											  $select.='<option value="'.$row['courseid'].'">'.$row['name'].'</option>';
										  }
										 
										}
										 $select.='</select>';
										echo $select;
										
									?>
									</div>
									<div class="form-group">
									<label>Select Academic Year</label>
									<?php
										$sql=mysql_query("SELECT acyearid,year FROM academicyear");
										if(mysql_num_rows($sql)){
										$select= '<select  class="form-control" name="selectacdyear" id="selectacdyear">';
										while($row=mysql_fetch_array($sql)){
											  $select.='<option value="'.$row['acyearid'].'">'.$row['year'].'</option>';
										  }
										}
										$select.='</select>';
										echo $select;
									?>
									</div>
									<div class="form-group">
									<label>Select Course Leader</label>
									<?php
										$sql=mysql_query("SELECT userid,username FROM userstbl where role='staff'");
										if(mysql_num_rows($sql)){
										$select= '<select  class="form-control" name="selectcl" id="selectcl">';
										while($row=mysql_fetch_array($sql)){
											  $select.='<option value="'.$row['userid'].'">'.$row['username'].'</option>';
										  }
										}
										$select.='</select>';
										echo $select;
									?>
									
									</div>
									<div class="form-group">
									<label>Select Course Moderator</label>
									<?php
									
										$sql=mysql_query("SELECT userid,username FROM userstbl where role='staff'");
										if(mysql_num_rows($sql)){
										$select= '<select  class="form-control" name="selectcm" id="selectcm">';
										while($rs=mysql_fetch_array($sql)){
											  $select.='<option value="'.$rs['userid'].'">'.$rs['username'].'</option>';
										  }
										}
										$select.='</select>';
										echo $select;
									?>
									</div>
									<button type="submit" name="btnassigncourse" class="btn btn-success">Assign Course</button>
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
