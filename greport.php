<?php 
	error_reporting(0);
	include('connect.php');
    session_start();
   // $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username'])){
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
?> <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
</div>
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Report Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back.</h5>
                    </div>
                </div>
                  <hr />
				<div class="col-md-12 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Report Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#e_report" data-toggle="tab">Exception Report</a>
                                </li>
                                <li class=""><a href="#s_report" data-toggle="tab">Statistics Report</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="e_report">
                                    <p></p>
									<div class="row"> 
									   <div class="col-md-6 col-sm-12 col-xs-12">                     
											<div class="panel panel-default">
												<div class="panel-heading">
													Courses Without CL & CM
												</div>
												<div class="panel-body">
													<div class="panel-body">
                            <div class="table-responsive">
							<?php 
									$sql ="SELECT  name FROM coursestbl where courseid not in (select courseid from assigntbl)";
									$result = $conn->query($sql) or trigger_error($conn->error);
									if ($result->num_rows > 0) {
									 echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Course Name</th></tr>";
									  while($row = $result->fetch_assoc()) {
										 echo "<tr>
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
											</div>            
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">                     
											<div class="panel panel-default">
												<div class="panel-heading">
												   Courses Without CMR
												</div>
												<div class="panel-body">
													<div class="table-responsive">
														<?php
																$sql = "select name from coursestbl where courseid not in (select courseid from assigntbl where assignid in(select assignid from cmrtbl))";
																$result = $conn->query($sql) or trigger_error($conn->error);
																if ($result->num_rows > 0) {
																 echo "<table class='table table-striped table-bordered table-hover'>
																<tr><th>Course Name</th></tr>";
																 while($row = $result->fetch_assoc()) {
																	 echo "<tr>
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
										</div> 
										</div><div class="row">
										   <div class="col-md-6 col-sm-12 col-xs-12">                     
												<div class="panel panel-default">
													<div class="panel-heading">
													   CMR Without Comment
													</div>
													<div class="panel-body">
														<div class="table-responsive">
														<?php 
																$ql = "select distinct concat(c.name,y.year)as name from coursestbl c,academicyear y,assigntbl t where c.courseid not in (select distinct a.courseid from assigntbl a where a.assignid in(select cm.assignid from cmrtbl cm where cm.cmrid not in(select cc.cmrid from commenttbl cc)))and y.acyearid=t.academicyear";
																$result = $conn->query($sql) or trigger_error($conn->error);
																if ($result->num_rows > 0) {
																 echo "<table class='table table-striped table-bordered table-hover'>
																 <tr><th>CMR Title</th></tr>";
																 while($row = $result->fetch_assoc()) {
																	 echo "<tr>
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
											</div>
										</div>
                                </div>
                                <div class="tab-pane fade" id="s_report">
                                    <p></p>
									<div class="row"> 
									   <div class="col-md-6 col-sm-12 col-xs-12">                     
											<div class="panel panel-default">
												<div class="panel-heading">
													Completed CMR
												</div>
												<div class="panel-body">
													<?php
													$query = "SELECT count(*) as complete from cmrtbl where status='approved'";
													$result = mysqli_query($conn, $query);
													$row = mysqli_fetch_assoc($result);
													?>
													<?=$row['complete']?>&nbsp;<span style="color:green">CMR successfully completed</span><br />
													
												</div>
											</div>            
										</div>
										<div class="col-md-6 col-sm-12 col-xs-12">                     
											<div class="panel panel-default">
												<div class="panel-heading">
												  Percentage of Completed CMR
												</div>
												<div class="panel-body">
												<?php
													$query = "SELECT count(*)*100/(select count(*) from cmrtbl) as complete from cmrtbl where status='approved'";
													$result = mysqli_query($conn, $query);
													$row = mysqli_fetch_assoc($result);
													?>
													<span style="color:green"><?=$row['complete']+"";echo " % Completed";?></span>
													<br />
												</div>
											</div>            
										</div>
									</div>
									<div class="row">  	  
										<div class="col-md-6 col-sm-12 col-xs-12">                     
											<div class="panel panel-default">
												<div class="panel-heading">
												   Percentage of CMR With Comment
												</div>
												<div class="panel-body">
												<?php
													$query = "SELECT count(*)*100/(select count(*) from cmrtbl where status='approved' and cmrid in (select cmrid in commenttbl)) as complete from cmrtbl ";
													$result = mysqli_query($conn, $query);
													$row = mysqli_fetch_assoc($result);
													?>
													<span style="color:green"><?=$row['complete']+"";echo " % Completed";?></span>
													<br />
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
