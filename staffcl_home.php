<?php
	error_reporting(0);
    include("connect.php");
	session_start();
    $user_role=$_SESSION['sess_userrole'];
	$user = $_SESSION['sess_username'];
	$email = $_SESSION['sess_useremail']; 
	$uid = $_SESSION['sess_user_id'] ;
     if(!isset($_SESSION['sess_username']) || $user_role!="2"){
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
                        <a class="active-menu" href="staffcl_home.php"><i class="fa fa-dashboard fa-3x"></i>  Course</a>
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
                     <h2>Course Leader Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. </h5>
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Course Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#currentcourse" data-toggle="tab">Current Assigned Course</a>
                                </li>
								<li><a href="#currentcoursecmr" data-toggle="tab">List of CMR Created</a>
                                </li>
                                <li class=""><a href="#prevcourses" data-toggle="tab">Approved CMR Details</a>
                                </li>
								<li class=""><a href="#cmrcomment" data-toggle="tab">CMR Comment</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="currentcourse">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
											<?php 
											$sql = "SELECT a.assignid, a.courseid,y.year,c.name FROM assigntbl a ,academicyear y , coursestbl c where a.courseid = c.courseid  and a.courseleader = $uid and a.academicyear = y.acyearid and a.academicyear = (SELECT acyearid FROM academicyear ORDER BY year DESC LIMIT 1)and a.assignid  not in (select distinct assignid from cmrtbl)";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Course ID</th><th>Academic Year</th><th>Course Name</th><th>Action</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
													 <td>" . $row['courseid']. "</td>
										 <td>" . $row['year']. "</td>
										 <td>" . $row['name']. "</td>
										 <td>" .'<a href="createcmr.php?id=' . $row['assignid'] . '" target="_blank">Create CMR</a>'. "</td>
										 
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
								<div class="tab-pane fade" id="currentcoursecmr">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<?php 
											$sql = "SELECT a.courseid,y.year,c.name FROM assigntbl a ,academicyear y ,coursestbl c where a.courseid = c.courseid  and a.courseleader = $uid and a.academicyear=y.acyearid and a.academicyear and a.assignid in (select distinct assignid from cmrtbl)";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												   echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Course ID</th><th>Academic Year</th><th>Course Name</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
										 <td>" . $row['courseid']. "</td>
										 <td>" . $row['year']. "</td>
										 <td>" . $row['name']. "</td>
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
                                <div class="tab-pane fade" id="prevcourses">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<?php 
											$sql = "SELECT c.cmrid,y.year,cc.name,c.studentcount,c.status FROM cmrtbl c,assigntbl a,academicyear y,coursestbl cc WHERE c.STATUS='Approved'and a.courseid = cc.courseid and a.assignid=c.assignid and y.acyearid=a.academicyear ";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Academic Year</th><th>Course Name</th><th>Student Count</th><th>Status</th><th>View</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
										 <td>" . $row['year']."</td>
										 <td>" . $row['name']."</td>
										 <td>" . $row['studentcount']."</td>
										 <td>" . $row['status']."</td>
										 <td>" . '<a href="ccmrdetails.php?id=' . $row['cmrid'] . '" target="_blank">View CMR Details</a>'."</td>
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
					<div class="tab-pane fade" id="cmrcomment">
								<p></p>
									<div class="panel-body">
                            <div class="table-responsive">
								<?php 
											$sql = "SELECT c.cmrid,y.year,cc.name,c.studentcount,c.status FROM cmrtbl c,assigntbl a,academicyear y,coursestbl cc WHERE a.assignid=c.assignid and y.acyearid=a.academicyear and a.courseid = cc.courseid and c.cmrid in (select distinct cmrid from commenttbl)";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Academic Year</th><th>Course Name</th><th>Student Count</th><th>Status</th><th>Action</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
										 <td>" . $row['year']."</td>
										 <td>" . $row['name']."</td>
										 <td>" . $row['studentcount']."</td>
										 <td>" . $row['status']."</td>
										 <td>" . '<a href="csgc.php?id=' . $row['cmrid'] . '" target="_blank">Complete CMR Details</a>'."</td>
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
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
