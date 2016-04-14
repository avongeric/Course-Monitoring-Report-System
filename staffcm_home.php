<?php 
	error_reporting(0);
    include('connect.php');
	session_start();
    $user_role=$_SESSION['sess_userrole'];
	$user = $_SESSION['sess_username'];
	//$email = $_SESSION['sess_useremail']; 
	$uid = $_SESSION['sess_user_id'] ;
     if(!isset($_SESSION['sess_username']) || $user_role!="3"){
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
                        <a class="active-menu" href="staffcm_home.php"><i class="fa fa-square-o fa-3x"></i> CMR</a>
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
                     <h2>Course Moderator Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. </h5>
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic  Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#unapprovecmr" data-toggle="tab">Unapprove CMR</a>
                                </li>
                                <li class=""><a href="#approvedcmr" data-toggle="tab">Approved CMRs</a>
                                </li>
								<li class=""><a href="#cmrcomment" data-toggle="tab">CMR Comment</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="unapprovecmr">
								<?php
								if(isset($_POST['btninsert'])){
									if(empty($_POST['action']) ) {
										$date = date("Y-m-d h:i:s");
										$duedate = date('Y-m-d h:i:s', strtotime($date. ' + 14 days'));
										$sql ="Update cmrtbl SET STATUS='Approved', approvedate='$date',duedate='$duedate' ";
										if($conn->query($sql) === TRUE){
											echo "<p class='text-success'> Records added successfully.</p>";
											$send_notification=mail("eavong@ymail.com", "CMR Comment Notice", "CMR has been sent to you for comment.Thanks", "avvonggt00517@fpt.edu.vn");
												if($send_notification){
													echo "<p class='text-success'>Email sent successfully</p>";
												}else{
													echo "<p class='text-danger'>Error while sending email</p>";
												}
										} else{
											echo "<p class='text-danger'>  Could not able to execute</p> " ;
											 echo "Error: " . $sql . "<br>" . $conn->error;
										}	
										}else { 
										echo "<p class='text-danger'>Please select CMR to Approve.</p>"; 
											// echo "Error: " . $sql . "<br>" . $conn->error;
										}
										}
									?>
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
							<?php 
											
												$sql = "SELECT c.cmrid, c.studentcount,cc.name, y.year,a.courseid FROM cmrtbl c,assigntbl a,academicyear y,coursestbl cc WHERE c.STATUS='CREATED' and y.acyearid=a.academicyear and a.courseid = cc.courseid and a.assignid=c.assignid and a.coursemoderator = $uid ";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Academic Year</th><th>Course Name</th><th>Student Count</th><th>Check to Approve</th></tr>";
												 while($row = $result->fetch_assoc()) {
													  echo "<tr>
										 <td>" . $row['year']."</td>
										 <td>" . $row['name']."</td>
										 <td>" . $row['studentcount']."</td>
										 <td>" .'<input value="" type="checkbox" name="action">'."</td>
										 <!--td>".'<a  name="btninsert" class="btn btn-danger">Approve</a>'."</td-->
										 </tr>";
												 }
												 echo "</table>";
												 echo "<button type='submit' name='btninsert' class='btn btn-success'>Submit Button</button>&nbsp;";
                                    
												} else {
													 echo "0 results";
												}
										?> 
											</form>
							
					</div>
				</div>
                                </div>
                                <div class="tab-pane fade" id="approvedcmr">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<?php 
											
												$sql = "SELECT c.cmrid,y.year,cc.name,c.studentcount,c.status FROM cmrtbl c,assigntbl a,coursestbl cc, academicyear y WHERE c.STATUS='Approved'and a.courseid = cc.courseid and a.assignid=c.assignid and y.acyearid=a.academicyear";
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
								<?php 
											
												$sql = "SELECT c.cmrid,y.year,cc.name,c.studentcount,c.status FROM cmrtbl c,assigntbl a,coursestbl cc,academicyear y WHERE a.assignid=c.assignid and a.courseid = cc.courseid  and y.acyearid=a.academicyear and c.cmrid in (select distinct cmrid from commenttbl)";
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
										 <td>" . '<a href="csgc.php?id=' . $row['cmrid'] . '" target="_blank">Complete CMR Details</a>'."</td>
										 </tr>";
												 }
												 echo "</table>";
												} else {
													 echo "0 results";
												}
										?> 
											
									
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
