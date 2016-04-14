<?php 
include("connect.php");
$course_id = $_GET['id']; 
$query = "select courseid,name,description,aim from coursestbl  WHERE courseid='$course_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result); 

$query1="SELECT  username FROM userstbl u, assigntbl a WHERE u.userid = a.courseleader && a.courseid='$course_id'";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($result1);

$query2="SELECT  username FROM userstbl u, assigntbl a WHERE  u.userid = a.coursemoderator && a.courseid='$course_id'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);

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
   <title><?php echo $row['name']; ?></title>
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
						<h2>Course Information <a style="float:right" class="btn btn-danger" onclick="window.close()">Close</a></h2> 
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-10 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading">Complete Course Description</div>
                        <div class="panel-body">
                                <div class="tab-pane fade in" id="">
									<div>
	<hr></hr><table>
                                  <tr> 
								  <td><strong>Course ID &nbsp;</strong></td>
								  <td><?php echo $row['courseid']; ?> <br></td>
								  </tr>
								  <tr> 
								  <td><strong>Course Name &nbsp;</strong></td>
								  <td><?php echo $row['name']; ?><br></td>
								  </tr>
								  <tr>
								  <td><strong>Course Leader &nbsp;</strong></td>
                                  <td><?php echo $row1['username']; ?><br></td>
								  </tr>
								  <tr>
								  <td><strong>Course Moderator &nbsp;</strong></td>
                                  <td><?php echo $row2['username']; ?><br></td>
								  </tr>
						</table>
						<hr></hr>
						<strong>Course Description &nbsp;</strong><br>
						<?php echo $row['description']; ?><br><br>
						<strong>Course Aim &nbsp;</strong><br>
						<?php echo $row['aim']; ?><br></td>
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
