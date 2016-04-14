	<?php
	include("connect.php");
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
	echo "All fields are Required";
	}else{$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {		
			$file_size=(filesize($full_path));
	
    $sql = "INSERT INTO CMRTBL (assignid ,studentcount,meancw1,meancw2,meancw3,meanexam,mediancw1,mediancw2,mediancw3,medianexam,sdcw1,sdcw2,sdcw3,sdexam,cw1039,cw14059,cw16079,cw180above,cw2039,cw24059,cw26079,cw280above,cw3039,cw34059,cw36079,cw380above,exam039,exam4059,exam6079,exam80above,filename,path,size) VALUES ('$assignid', '$studentcount','$meancw1','$meancw2','$meancw3','$meanexam','$mediancw1','$mediancw2','$mediancw3','$medianexam','$sdcw1','$sdcw2','$sdcw3','$sdexam','$cw1039','$cw14059','$cw16079','$cw180above','$cw2039','$cw24059','$cw26079','$cw280above','$cw3039','$cw34059','$cw36079','$cw380above','$exam039','$exam4059','$exam6079','$exam80above','$file_name','$full_path','$file_size')";
    if($conn->query($sql) === TRUE){
        echo "<p class='text-success'>Records added successfully.</p>";
		$file_name="";
		header('Location:staffcl_home.php');
    } else{
        echo "<p class='text-danger'>Could not able to execute </p> ";
    }} else{
			echo "<p class='text-danger'>Sorry, there was a problem uploading your file</p>";
	}}
    
									?>