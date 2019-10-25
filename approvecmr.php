
<?php
error_reporting(0);
include("connect.php");
							
									$cmrid = $_GET['id'];
										$date = date("Y-m-d h:i:s");
										$duedate = date('Y-m-d h:i:s', strtotime($date. ' + 14 days'));
										$sql ="Update cmrtbl SET STATUS='Approved', approvedate='$date',duedate='$duedate' where cmrid='$cmrid'";
										if($conn->query($sql) === TRUE){
											$send_notification=mail("email@gmail.com", "CMR Comment Notice", "CMR has been sent to you for comment. <br/>Thanks", "your@gmail.com");
												if($send_notification){
													echo "<p class='text-success'>Email sent successfully</p>";
												}else{
													echo "<p class='text-danger'>Erro while sending email</p>";
												}
											header('Refresh:0; staffcm_home.php'); /* Redirect browser */
												exit();
											
											//echo "<p class='text-success'> CMR approve successfully.</p>";
										} else{
											echo "<p class='text-danger'>  Could not able to execute</p> " ;
											 echo "Error: " . $sql . "<br>" . $conn->error;
										}	
										
									?>

