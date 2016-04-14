<?php 
    include("connect.php");
	session_start();
    $user_role=$_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) || $user_role!="1"){
      header('Location: index.php?err=2');
    }
?>
<?php
if(!isset($_GET['id'])){
	header('Location:admin_course.php');
}?>
	
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
?> </div>
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
                <div class="col-md-8 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Course
                        </div>
                        <div class="panel-body">
                                <div class="tab-pane fade in" id="updatecourse1">
											<?php 
											$course_id = $_GET['id']; 
											$query = "select courseid,name,description,aim from coursestbl  WHERE courseid ='$course_id'"; 
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
											?>
											
											<?php
											if(isset($_POST['btnupdate'])){
											$id = mysql_real_escape_string( $_POST['txtid']);
											$name = mysql_real_escape_string( $_POST['txtcoursename']);
											$description = mysql_real_escape_string( $_POST['txtdescription']);
											$aim = mysql_real_escape_string( $_POST['txtaim']);
											if($name=="" || $description== "" || $aim== ""){	
											echo "All fields are required";
											}else{
											$sql = "UPDATE CoursesTBL SET name ='$name',description ='$description',aim='$aim' WHERE courseid='$id'";
											if(mysql_query($sql)){
												echo "Records added successfully.";
											}else{
												echo "ERROR: Could not able to execute ";
											}
											}
											}?>
									<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<input class="form-control"  name="txtid" id="txtid" type="hidden" value="<?php echo $row['courseid']; ?>"/>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input class="form-control"  name="txtcoursename" id="txtcoursename" value="<?php echo $row['name']; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Description</label>
                                            <textarea rows="4"  class="form-control" name="txtdescription" id="txtdescription"><?php echo $row['description']; ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label >Course Aim</label>
                                            <textarea rows="6"  class="form-control" name="txtaim" id="txtaim"><?php echo $row['aim']; ?></textarea>
                                        </div><br>
                                        <button type="submit" name="btnupdate" class="btn btn-danger">Submit Button</button>
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
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script> 
	
</body>
</html>
