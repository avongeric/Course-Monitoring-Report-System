<?php
error_reporting(0);
	include('connect.php');
    session_start();
    $role = $_SESSION['sess_userrole'];
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
?>
        </nav>
                <nav class="navbar-default navbar-side" role="navigation">
            
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Compelete CMR  Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['sess_username'];?> , Love to see you back. <a style="float:right"class="btn btn-danger" onclick="window.close()">Close</a></h5>
						
				
                    </div>
                </div>
                  <hr />
            <div class="row">
                <div class="col-md-12 col-sm-6" id="updatecoursediv" >
                    <div class="panel panel-default">
                        <div class="panel-heading"> CMR Details </div>
                        <div class="panel-body">
						<ul class="nav nav-tabs">
                                <li class="active"><a href="#cmr" data-toggle="tab">CMR</a>
                                </li>
                                <li class=""><a href="#sdata" data-toggle="tab">Statistical Data</a>
                                </li>
								<li class=""><a href="#gddata" data-toggle="tab">Grade Distribution Data</a>
                                </li>
								<li class=""><a href="#cm" data-toggle="tab">Comment</a>
                                </li>
                            </ul>
							<div class="tab-content">
							<?php 
								$cmr_id = $_GET['id'];
								
								/* $results = mysql_query("select id,academicyear,courseid,coursename,courseleader,studentcount,status,approvedate,meancw1,meancw2,meancw3,meanexam,mediancw1,mediancw2,mediancw3,medianexam,sdcw1,sdcw2,sdcw3,sdexam,cw1039,cw14059,cw16079,cw180above,cw2039,cw24059,cw26079,cw280above,cw3039,cw34059,cw36079,cw380above,exam039,exam4059,exam6079,exam80above,cm.comment,cm.dateofcomment from cmrtbl,commenttbl cm WHERE cm.cmrid='$cmr_id'"); */
								$query = "select c.cmrid,c.studentcount,sum(c.meancw1+c.meancw2+c.meancw3+c.meanexam) as mnoverall,sum(c.mediancw1+c.mediancw2+c.mediancw3+c.medianexam) as mdoverall,sum(c.sdcw1+c.sdcw2+c.sdcw3+c.sdexam) as sdoverall,sum(c.cw1039+c.cw2039+c.cw3039+c.exam039) as overall039,sum(c.cw14059+c.cw24059+c.cw34059+c.exam4059) as overall4059,sum(c.cw16079+c.cw26079+c.cw36079+c.exam6079) as overall6079,sum(cw180above+cw280above+cw380above+exam80above) as overall80above,c.status,c.meancw1,c.meancw2,c.meancw3,c.meanexam,c.mediancw1,c.mediancw2,c.mediancw3,c.medianexam,c.sdcw1,c.sdcw2,c.sdcw3,c.sdexam,c.cw1039,c.cw14059,c.cw16079,c.cw180above,c.cw2039,c.cw24059,c.cw26079,c.cw280above,c.cw3039,c.cw34059,c.cw36079,c.cw380above,c.exam039,c.exam4059,c.exam6079,c.exam80above,c.filename,c.approvedate,y.year,a.courseid,u.username,cm.comment,cm.dateofcomment from cmrtbl c,commenttbl cm,academicyear y, assigntbl a,userstbl u WHERE c.cmrid='$cmr_id' and c.assignid=a.assignid and a.courseleader = u.userid and cm.cmrid=c.cmrid and y.acyearid=a.academicyear"; 
							$result = mysqli_query($conn, $query);
							$row = mysqli_fetch_assoc($result);
							?>
                                <div class="tab-pane fade active in" id="cmr">
                                    <p></p>
									<table class='table table-striped table-bordered table-hover'>
										  <tr> 
											  <td width="20%"><strong>CMR ID &nbsp;</strong></td>
											  <td colspan="2"><?php echo $row['cmrid']; ?> <br></td>
										  </tr>
										  <tr> 
											  <td><strong>Academic Year &nbsp;</strong></td>
											  <td><?php echo $row['year']; ?><br></td>
										  </tr>
										  <tr> 
										  <tr> 
											  <td width="20%"><strong>Course ID &nbsp;</strong></td>
											  <td colspan="2"><?php echo $row['courseid']; ?> <br></td>
										  <tr>
											  <td><strong>Course Leader &nbsp;</strong></td>
											  <td><?php echo $row['username']; ?><br></td>
										  </tr>
										  <tr>
											  <td><strong>Student Count &nbsp;</strong></td>
											  <td><?php echo $row['studentcount']; ?><br></td>
										  </tr>
										  <tr>
											  <td><strong>Status &nbsp;</strong></td>
											  <td><?php echo $row['status']; ?><br></td>
										  </tr>
										  <tr>
											  <td><strong>Approval Data &nbsp;</strong></td>
											  <td><?php echo $row['approvedate']; ?><br></td>
										  </tr>
										  <tr>
										  <td><strong>Attachment &nbsp;</strong></td>
                                  <td><?php echo $row['path']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="download.php?id=<?php echo $cmr_id;?>"><span class='glyphicon glyphicon-download'></span> Download</a><br></td>
										</tr>
									</table>
								</div>
								<div class="tab-pane fade" id="sdata">
                                    <p></p>
									<table class="table table-striped table-bordered table-hover">
									<tr>
									<th>Statistical Data</th>
									<th>Cousrework 1</th>
									<th>Cousrework 2</th>
									<th>Cousrework 3</th>
									<th>Exam</th>
									<th>Overall</th>
									</tr>
									<tr>
									<td>Mean</td>
									<td><?php echo $row['meancw1']; ?></td>
									<td><?php echo $row['meancw2']; ?></td>
									<td><?php echo $row['meancw3']; ?></td>
									<td><?php echo $row['meanexam']; ?></td>
									<td><?php echo $row['mnoverall']; ?></td>
									</tr>
									<tr>
									<td>Median</td>
									<td><?php echo $row['mediancw1']; ?></td>
									<td><?php echo $row['mediancw2']; ?></td>
									<td><?php echo $row['mediancw3']; ?></td>
									<td><?php echo $row['medianexam']; ?></td>
									<td><?php echo $row['mdoverall']; ?></td>
									</tr>
									<tr>
									<td>Standard Deviation</td>
									<td><?php echo $row['sdcw1']; ?></td>
									<td><?php echo $row['sdcw2']; ?></td>
									<td><?php echo $row['sdcw3']; ?></td>
									<td><?php echo $row['sdexam']; ?></td>
									<td><?php echo $row['sdoverall']; ?></td>
									</tr>
									</table>
								</div>
								<div class="tab-pane fade" id="gddata">
                                    <p></p>
									<table class="table table-striped table-bordered table-hover">
									<tr>
									<th>Grade Distribution Data</th>
									<th style="text-align:center">0 - 39</th>
									<th style="text-align:center">40 - 59</th>
									<th style="text-align:center">60 - 79</th>
									<th style="text-align:center">80 above</th>
									</tr>
									<tr>
									<td>Cousrework 1</td>
									<td><?php echo $row['cw1039']; ?></td>
									<td><?php echo $row['cw14059']; ?></td>
									<td><?php echo $row['cw16079']; ?></td>
									<td><?php echo $row['cw180above']; ?></td>
									</tr>
									<tr>
									<td>Coursework 2</td>
									<td><?php echo $row['cw2039']; ?></td>
									<td><?php echo $row['cw24059']; ?></td>
									<td><?php echo $row['cw26079']; ?></td>
									<td><?php echo $row['cw280above']; ?></td>
									</tr>
									<tr>
									<td>Coursework 3</td>
									<td><?php echo $row['cw3039']; ?></td>
									<td><?php echo $row['cw34059']; ?></td>
									<td><?php echo $row['cw36079']; ?></td>
									<td><?php echo $row['cw380above']; ?></td>
									</tr>
									<tr>
									<td>Exam</td>
									<td><?php echo $row['exam039']; ?></td>
									<td><?php echo $row['exam4059']; ?></td>
									<td><?php echo $row['exam6079']; ?></td>
									<td><?php echo $row['exam80above'];?></td>
									</tr>
									<tr>
									<td>Overall</td>
									<td><?php echo $row['overall039']; ?></td>
									<td><?php echo $row['overall4059']; ?></td>
									<td><?php echo $row['overall6079']; ?></td>
									<td><?php echo $row['overall80above'];?></td>
									</tr>
								</table>
								</div>
								<div class="tab-pane fade " id="cm">
                                    <p></p>
									<strong>Date of Comment &nbsp;</strong><br>
									<?php echo $row['dateofcomment']; ?><br><br>
									<hr/>
									<strong>Comment &nbsp;</strong><br>
									<?php echo $row['comment']; ?><br><br>
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
