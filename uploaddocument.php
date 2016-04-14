<?php
									
									 $link = mysqli_connect("localhost", "root", "localhost", "cmsdatabase");
										if($link === false){
										   die("ERROR: Could not connect. " . mysqli_connect_error());
										}
										//echo $_FILES['uploadedfile']['name'];
										
										$cmrid = mysqli_real_escape_string($link, $_POST['txtcmrid']);
										$date = date("Y-m-d h:i:s");
										$target_path = "upload/";
										$file_name=$_FILES['uploadedfile']['name'];
										$full_path=$target_path."".$file_name;
										if($file_name==""){
											echo "Please select a file";
										}else{
											$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
												if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {		$file_size=(filesize($full_path));
													$insert=mysql_query("INSERT INTO DOCUMENTTBL(filename,path,cmrid,date,size)values('$file_name','$full_path','$cmrid','$date','$file_size')");
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
													}?>