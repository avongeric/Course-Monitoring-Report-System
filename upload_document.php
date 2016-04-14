<?php 
    session_start();
    $role = $_SESSION['sess_userrole'];
	$user = $_SESSION['sess_username'];
	$id = $_SESSION['sess_user_id'] ;
    if(!isset($role) || $user!="staff1"){
      header('Location: index.php?err=2');
    }
?>	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
	<meta charset="UTF-8">
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
  <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
                <nav class="navbar-default navbar-side" role="navigation">
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. 
						<a style="float:right" class="btn btn-danger" onclick="window.close()">Close</a></h5>
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload CMR Document
                        </div>
                        <div class="panel-body">
                                 <div class="tab-pane fade active in" id="">
																				
									
                                    <form role="form" action="upload_document.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
									
										<div class="form-group">
											<label class="btn btn-info" for="my-file-selector" style="width:100%">
											<input name="uploadedfile" id="my-file-selector" type="file" >
											</label>
										</div>
										<button type="submit" name="btnUpload"  class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-info">Reset Button</button>
                                    </form>
									<?php 
									 $link = mysqli_connect("localhost", "root", "localhost", "cmsdatabase");
										if($link === false){
										   die("ERROR: Could not connect. " . mysqli_connect_error());
										}
										$cmrid = $_GET['id']; 
										//echo $_FILES['uploadedfile']['name'];
										if(isset($_POST['btnUpload'])){ 
										$date = date("Y-m-d h:i:s");
										$target_path = "upload/";
										$file_name=$_FILES['uploadedfile']['name'];
										$full_path=$target_path."".$file_name;
										if($file_name==""){
											echo "Please select a file";
										}else{
											$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
												if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {		$file_size=(filesize($full_path));
													$insert="INSERT INTO DOCUMENTTBL(filename,path,cmrid,date,size)values('$file_name','$full_path','$cmrid','$date','$file_size')";
												   if(mysqli_query($link, $insert)){
												   echo "Document uploaded successfully";
												   $file_name="";
												   header('Location:upload_document.php');
												   }else{
												   echo "Error while trying to upload file 1";
												   } 
													} else{
														echo "Error while trying to upload file 2";
													}
													}}?>
									
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
