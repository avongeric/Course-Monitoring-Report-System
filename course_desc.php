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
<html>
<head>
<title><?php echo $row['1']; ?></title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
		<div>
<h1>Programme (Computing) - Course Monitoring Report </h1>
<h2>COURSE SPECIFICATION (2016/2017)		</h2>
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
</body></html>
