<?php 
	error_reporting(0);
	include('connect.php');
    session_start();
    $user_role=$_SESSION['sess_userrole'];
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
                        <a  href="admin-users.php"><i class="fa fa-desktop fa-3x"></i> Users Account</a>
                    </li><li>
                        <a  class="active-menu" href="faculty.php"><i class="fa fa-qrcode fa-3x"></i> Faculty</a>
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
                            Basic Faculty Task
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
							
                                <li class="active"><a href="#addfaculty" data-toggle="tab">Add Faculty </a>
                                </li>
                                <li class=""><a href="#viewfaculty" data-toggle="tab">View Faculty</a>
                                </li>
                            </ul>

                            <div class="tab-content">
							
                                <div class="tab-pane fade active in" id="addfaculty">
								<?php
								if(isset($_POST['btninsert'])){
									$name = $_POST['txtname'];
									$contact =  $_POST['txtcontact'];
									$address = $_POST['txtaddress'];
									$pvc =  $_POST['selectpvc'];
									$dlt = $_POST['selectdlt'];
									if($name == "" ||$contact=="" || $address== "" || $pvc== ""|| $dlt== ""){	
									echo "<span style='color:red'>All fields are required.<span>";
											}else{
									$sql = "INSERT INTO facultytbl (facultyname, contact, address, pvc, dlt) 
									VALUES ('$name','$contact','$address','$pvc','$dlt')";
									if($conn->query($sql) === TRUE){
										echo "<p class='text-success'>Records added successfully.</p>";
									} else{
										echo "<p class='text-danger'> Could not able to execute</p>";
										 echo "Error: " . $sql . "<br>" . $conn->error;
											}}
								}
								?>
                                    <p></p>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
										
                                        <div class="form-group">
                                            <label>Faculty Name</label>
                                            <input class="form-control" name="txtname" id="txtname"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Faculty Contact </label>
                                            <input class="form-control"  name="txtcontact" id="txtcontact"/>
                                        </div>
										<div class="form-group">
                                            <label>Faculty Address </label>
                                            <input class="form-control" name="txtaddress" id="txtaddress"/>
                                        </div>
										<div class="form-group">
									<label>Select PVC</label>
									<?php
										 $result = mysqli_query($conn, "SELECT userid,username FROM userstbl where roleid='5'");
										 echo '<select  class="form-control" name="selectpvc" id="selectpvc">';
										 echo "<option value=''></option>";
										 while($r = mysqli_fetch_array($result))
										 { 
										 echo "<option value='" .$r['userid'] ."'>".$r['username']. "</option>";
										 }
										 echo "</select>";
										?>
									</div>
									<div class="form-group">
									<label>Select DLT</label>
									<?php
										 $result = mysqli_query($conn, "SELECT userid,username FROM userstbl where roleid='4'");
										 echo '<select  class="form-control" name="selectdlt" id="selectdlt">';
										 echo "<option value=''></option>";
										 while($r = mysqli_fetch_array($result))
										 { 
										 echo "<option value='" .$r['userid'] ."'>".$r['username']. "</option>";
										 }
										 echo "</select>";
										?>
									</div>
                                        <button type="submit" name="btninsert" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="viewfaculty">
                                    <p></p>
									<div class="panel-body">
                            <div class="table-responsive">
							<?php 
											
												$sql = "SELECT facultyid,facultyname,contact,address,pvc,dlt FROM facultytbl  GROUP BY facultyid";
												$result = $conn->query($sql) or trigger_error($conn->error);
												if ($result->num_rows > 0) {
												  echo "<table class='table table-striped table-bordered table-hover'>
									 <tr><th>Faculty Name</th><th>Contact</th><th>Address</th></tr>";
												 while($row = $result->fetch_assoc()) {
													 echo "<tr>
													 <td>" . $row['facultyname']. "</td>
												<td>" .'<a href="mailto:'.$row['contact'].'">'. $row['contact'].'</a>'. "</td>
													 
													 <td>". $row['address']. "</td>
													 <!--td>" . $row['pvc']. "</td>
													 <td>" . $row['dlt']. "</td-->
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
