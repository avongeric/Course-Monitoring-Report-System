<?php
	include('connect.php');
    session_start();
    $user_role=$_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username'])|| $user_role!="1"){
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
        </nav>
                <nav class="navbar-default navbar-side" role="navigation">
            
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. <a style="float:right"class="btn btn-danger" onclick="window.close()">Close</a></h5>
						
				
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading"> User Details </div>
                        <div class="panel-body">
							<div class="tab-content">
							<?php 
								$userid = $_GET['id']; 
											$query = "select userid, username,email,password from userstbl  WHERE userid='$userid'"; 
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
											$password=$row['password'];
											$password = md5($password);
							?>
                                <div class="tab-pane fade active in" id="cmr">
                                    <p></p>
									<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<input class="form-control" type="" name="txtuserid" id="txtuserid" value="<?php echo $row['userid']; ?>" /> 
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name="txtusername" id="txtusername" type="text" value="<?php echo $row['username']; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="txtpassword" id="txtpassword" value="<?php echo  $password?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Role</label>
                                            <select class="form-control" name="txtselectrole" id="txtselectrole">
                                                <option value="pvc">PVC</option>
                                                <option value="dlt">DLT</option>
                                                <option value="staff">Staff</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="txtemail" id="txtemail" value="<?php echo $row['email']; ?>"/>
                                        </div>
                                        <button type="submit" name="btninsert" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-success">Reset Button</button>

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
