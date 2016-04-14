<?php 
error_reporting("0");
    include("connect.php");
	session_start();
    $user_role=$_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username']) || $user_role!="4"){
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
				<?php
					echo "Today is " . date("l"); echo "&nbsp;&nbsp;". date("Y-M-d") ;
				?>
			</div>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
						<h2>Director of Learning & Quality Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. 
						<a style="float:right" class="btn btn-danger" onclick="window.close()">Close</a></h5>
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-8 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading">Comment on CMR</div>
                        <div class="panel-body">
                                <div class="tab-pane fade in" id="">
										<?php 
											$cmr_id = $_GET['id']; 
											$query = "select cmrid from cmrtbl  WHERE cmrid='$cmr_id'"; 
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);

											?>
											<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
													<?php
														if(isset($_POST['btninsert'])){
														$date = date("Y-m-d h:i:s");
														$cmrid = $_POST['txtcmrid'];
														$comment = $_POST['txtcomment'];
														if($comment==""){	
														echo "<span style='color:red'>Comment field is required.<span>";
																}else{
														$sql = "INSERT INTO commenttbl (cmrid, comment, dateofcomment) VALUES ('$cmrid', '$comment', '$date')";
														if($conn->query($sql) === TRUE){
															echo "<p class='text-success'>Records added successfully.</p>";
														} else{
															echo "<p class='text-success'> Could not able to execute.</p>";
														}}}
													?>
											   <div class="form-group">
												   <input class="form-control" type="hidden" name="txtcmrid" id="txtcmrid" value="<?php echo $row['cmrid']; ?>" /> 
												</div>
												<div class="form-group">
													<label> Comment</label>
													<textarea rows="4"  class="form-control" name="txtcomment" id="txtcomment"></textarea>
												</div><br>
											<button type="submit" class="btn btn-danger" name="btninsert">Submit Button</button>
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
