<?php 
	error_reporting(0);
	include("connect.php");
    session_start();
    $user_role=$_SESSION['sess_userrole'];
	$user = $_SESSION['sess_username'];
	$uid = $_SESSION['sess_user_id'] ;
    if(!isset($_SESSION['sess_username']) || $user_role!="2"){
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
?></div>
        </nav>
                <nav class="navbar-default navbar-side" role="navigation">
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Course Leader Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. 
						<a style="float:right" class="btn btn-danger" onclick="window.close()">Close</a></h5>
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading">Create on CMR
                        </div>
                        <div class="panel-body">
                                 <div class="tab-pane fade active in">
									<?php 
											$assign_id = $_GET['id'];
											$query = "SELECT * FROM assigntbl  where assignid = '$assign_id'"; 
											$result = mysqli_query($conn, $query);
											$row = mysqli_fetch_assoc($result);
											
											
											?>
											<?php
	//include("connect.php");
	if(isset($_POST['btninsert'])){
    $assignid = $_POST['txtassignid'];
    $studentcount =  $_POST['txtstudentcount'];
	$meancw1 = $_POST['txtmeancw1'];
    $meancw2 = $_POST['txtmeancw2'];
    $meancw3 =$_POST['txtmeancw3'];
    $meanexam =  $_POST['txtmeanexam'];
    $mediancw1 =  $_POST['txtmediancw1'];
	$mediancw2 =  $_POST['txtmediancw2'];
    $mediancw3 = $_POST['txtmediancw3'];
    $medianexam = $_POST['txtmedianexam'];
    $sdcw1 = $_POST['txtsdcw1'];
    $sdcw2 = $_POST['txtsdcw2'];
	$sdcw3 = $_POST['txtsdcw3'];
    $sdexam = $_POST['txtsdexam'];
    $cw1039 = $_POST['txtcw1039'];
    $cw14059 = $_POST['txtcw14059'];
    $cw16079 = $_POST['txtcw16079'];
    $cw180above = $_POST['txtcw180above'];
    $cw2039 = $_POST['txtcw2039'];
    $cw24059 = $_POST['txtcw24059'];
    $cw26079 = $_POST['txtcw26079'];
    $cw280above = $_POST['txtcw280above'];
	$cw3039 = $_POST['txtcw3039'];
    $cw34059 = $_POST['txtcw34059'];
    $cw36079 = $_POST['txtcw36079'];
    $cw380above = $_POST['txtcw380above'];
	$exam039 = $_POST['txtexam039'];
    $exam4059 = $_POST['txtexam4059'];
    $exam6079 = $_POST['txtexam6079'];
    $exam80above = $_POST['txtexam80above'];
	$date = date("Y-m-d h:i:s");
	$target_path = "upload/";
	$file_name=$_FILES['uploadedfile']['name'];
	$full_path=$target_path."".$file_name;
	if($file_name==""  || $assignid =="" || $studentcount =="" || $meancw1 =="" ||$meancw2=="" || $meancw3 =="" || $meanexam=="" || $mediancw1 =="" || $mediancw2=="" || $mediancw3 =="" || $medianexam=="" || $sdcw1 =="" || $sdcw2=="" || $sdcw3 =="" || $sdexam=="" || $cw1039 =="" || $cw14059=="" || $cw16079 =="" || $cw180above=="" || $cw2039 =="" || $cw24059=="" || $cw26079 =="" || $cw280above=="" || $cw3039 =="" || $cw34059=="" || $cw16079 =="" ||$cw36079=="" || $cw380above =="" || $exam039=="" || $exam4059 =="" || $exam6079=="" || $exam80above =="" ){
	echo "<p class='text-danger'>All fields are Required</p>";
	//										
	}else{$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {		
			$file_size=(filesize($full_path));
	
    $sql = "INSERT INTO cmrtbl (assignid ,studentcount,meancw1,meancw2,meancw3,meanexam,mediancw1,mediancw2,mediancw3,medianexam,sdcw1,sdcw2,sdcw3,sdexam,cw1039,cw14059,cw16079,cw180above,cw2039,cw24059,cw26079,cw280above,cw3039,cw34059,cw36079,cw380above,exam039,exam4059,exam6079,exam80above,filename,path,size) VALUES ('$assignid', '$studentcount','$meancw1','$meancw2','$meancw3','$meanexam','$mediancw1','$mediancw2','$mediancw3','$medianexam','$sdcw1','$sdcw2','$sdcw3','$sdexam','$cw1039','$cw14059','$cw16079','$cw180above','$cw2039','$cw24059','$cw26079','$cw280above','$cw3039','$cw34059','$cw36079','$cw380above','$exam039','$exam4059','$exam6079','$exam80above','$file_name','$full_path','$file_size')";
    if($conn->query($sql) === TRUE){
        echo "<p class='text-success'>Records added successfully.</p>";
		$file_name="";
		//header('Location:staffcl_home.php');
		$send_notification=mail("eeavong@gmail.com", "CMR Notification", "CMR has been sent to you for approval", "avvonggt00517@fpt.edu.vn");
			if($send_notification){
				echo "<p class='text-success'>Email sent successfully</p>";
				}else{
					echo "<p class='text-danger'>Error while sending email</p>";
					}
			//header('Location:staffcl_home.php');
    } else{
        echo "<p class='text-danger'>Could not able to execute </p> ";
    }} else{
			echo "<p class='text-danger'>Sorry, there was a problem uploading your file</p>";
			 
	}}
    }
									?>
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
									
                                            <input class="form-control" type="hidden" name="txtassignid" id="txtassignid" value="<?php echo $row['assignid']; ?> "/>
										<div class="form-group">
                                            <label>Student Count</label>
                                            <input class="form-control"  name="txtstudentcount" id="txtstudentcount"/>
                                        </div>
										<table class="table table-striped table-bordered table-hover">
									<tr>
									<th>Statistical Data</th>
									<th>Cousrework 1</th>
									<th>Cousrework 2</th>
									<th>Cousrework 3</th>
									<th>Exam</th>
									</tr>
									<tr>
									<td>Mean</td>
									<td><input class="form-control" type="text" name="txtmeancw1" id="txtmeancw1"/></td>
									<td><input class="form-control" type="text" name="txtmeancw2" id="txtmeancw2"/></td>
									<td><input class="form-control" type="text" name="txtmeancw3" id="txtmeancw3"/></td>
									<td><input class="form-control" type="text" name="txtmeanexam" id="txtmeanexam"/></td>
									</tr>
									<tr>
									<td>Median</td>
									<td><input class="form-control" type="text" name="txtmediancw1" id="txtmediancw1"/></td>
									<td><input class="form-control" type="text" name="txtmediancw2" id="txtmediancw2"/></td>
									<td><input class="form-control" type="text" name="txtmediancw3" id="txtmediancw3"/></td>
									<td><input class="form-control" type="text" name="txtmedianexam" id="txtmedianexam"/></td>
									</tr>
									<tr>
									<td>Standard Deviation</td>
									<td><input class="form-control" type="text" name="txtsdcw1" id="txtsdcw1"/></td>
									<td><input class="form-control" type="text" name="txtsdcw2" id="txtsdcw2"/></td>
									<td><input class="form-control" type="text" name="txtsdcw3" id="txtsdcw3"/></td>
									<td><input class="form-control" type="text" name="txtsdexam" id="txtsdexam"/></td>
									</tr>
									<tr>
									<th>Grade Distribution Data</th>
									<th style="text-align:center">0 - 39</th>
									<th style="text-align:center">40 - 59</th>
									<th style="text-align:center">60 - 79</th>
									<th style="text-align:center">80 above</th>
									</tr>
									<tr>
									<td>Cousrework 1</td>
									<td><input class="form-control" type="text" name="txtcw1039" id="txtcw1039"/></td>
									<td><input class="form-control" type="text" name="txtcw14059" id="txtcw14059"/></td>
									<td><input class="form-control" type="text" name="txtcw16079" id="txtcw16079"/></td>
									<td><input class="form-control" type="text" name="txtcw180above" id="txtcw180above"/></td>
									</tr>
									<tr>
									<td>Coursework 2</td>
									<td><input class="form-control" type="text" name="txtcw2039" id="txtcw2039"/></td>
									<td><input class="form-control" type="text" name="txtcw24059" id="txtcw24059"/></td>
									<td><input class="form-control" type="text" name="txtcw26079" id="txtcw26079"/></td>
									<td><input class="form-control" type="text" name="txtcw280above" id="txtcw280above"/></td>
									</tr>
									<tr>
									<td>Coursework 3</td>
									<td><input class="form-control" type="text" name="txtcw3039" id="txtcw3039"/></td>
									<td><input class="form-control" type="text" name="txtcw34059" id="txtcw34059"/></td>
									<td><input class="form-control" type="text" name="txtcw36079" id="txtcw36079"/></td>
									<td><input class="form-control" type="text" name="txtcw380above" id="txtcw380above"/></td>
									</tr>
									<tr>
									<td>Exam</td>
									<td><input class="form-control" type="text" name="txtexam039" id="txtexam039"/></td>
									<td><input class="form-control" type="text" name="txtexam4059" id="txtexam4059"/></td>
									<td><input class="form-control" type="text" name="txtexam6079" id="txtexam6079"/></td>
									<td><input class="form-control" type="text" name="txtexam80above" id="txtexam80above"/></td>
									</tr>
									<tr>
									<td>Attachment</td>
									<td colspan="5">
									<label class="btn btn-info" for="my-file-selector" style="width:100%">
									<input type="file" name="uploadedfile" id="my-file-selector"/>
									</label>
									</td>
									</tr>
								</table>
                                        <button type="submit" name="btninsert" class="btn btn-danger">Submit Button</button>
                                        <button type="reset" class="btn btn-info">Reset Button</button>

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