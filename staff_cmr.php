<?php 
    session_start();
    $role = $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) || $role!="staff"){
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
  <div style="color: white; padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
  <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav> 
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li>
                        <a  href="courseleader_home.php"><i class="fa fa-dashboard fa-3x"></i> Courses</a>
                    </li>					                   
                  <li >
                        <a  class="active-menu" href="cl_cmr.php"><i class="fa fa-square-o fa-3x"></i> CMR Page</a>
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
                            Basic CMR Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#createcmr" data-toggle="tab">Create CMR</a>
                                </li>
                                <li class=""><a href="#profile" data-toggle="tab">Statistical Data</a>
                                </li>
                                <li class=""><a href="#messages" data-toggle="tab">Grade Distribution Data</a>
                                </li>
                                <li class=""><a href="#settings" data-toggle="tab">Assign Course</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="createcmr">
                                    <p></p>
                                    <form role="form" action="insertcourse.php" method="post">
									
                                        <div class="form-group">
                                            <label>Course ID</label>
                                            <input class="form-control" name="txtcourseid" id="txtcourseid"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input class="form-control"  name="txtcoursename" id="txtcoursename"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Description</label>
                                            <textarea class="form-control" name="txtdescription" id="txtdescription" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-defaults">Reset Button</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							 <table class="table table-striped table-bordered table-hover">
                                    <?php
											$link = mysqli_connect("localhost", "root", "localhost", "cmsdatabase");
											if($link === false){
												die("ERROR: Could not connect. " . mysqli_connect_error());
											}    
											$sql = "SELECT * FROM Courses";
											if($result = mysqli_query($link, $sql)){
												if(mysqli_num_rows($result) > 0){
														echo "<tr>";
															echo "<th>Course ID</th>";
															echo "<th>Course Name</th>";
															echo "<th>Description</th>";
															echo "<th>Update</th>";
															echo "<th>Action</th>";
														echo "</tr>";
													while($row = mysqli_fetch_array($result)){
														echo "<tr>";
															echo "<td>" . $row['0'] . "</td>";
															echo "<td>" . $row['1'] . "</td>";
															echo "<td>" . $row['2'] . "</td>";
															echo "<td>" . '<button type="submit" class="btn btn-success">Click</button>'. "</td>";
															echo "<td>" . '<form action="delete.php" method="post">
														<input type="hidden" name="name" value="">
														<input type="submit" name="submit" class="btn btn-danger" value="Delete">'. "</td>";
														echo "</tr>";
												   }
												   mysqli_free_result($result);
												} else{
													echo "No records matching your query were found.";
												}
											} else{
												echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
											}  
											mysqli_close($link);
									?>
						</table>
						</div>
						</div>
	
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Messages Tab</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <h4>Settings Tab</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
