<?php
include('database.php');

error_reporting(0);

$data = $_GET['data'];

// ** GET PATIENTS APPOINTMENTS **//
$tbl_appointments = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id FROM tbl_appointments a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									WHERE b.id='$data'
									");
									
//** GET PATIENTS PAYMENTS **//

$tbl_payment = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id FROM tbl_payment a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id WHERE b.id='$data'");	

$tbl_signup = $mysqli->query("SELECT * from tbl_signup where type='patient'");
if(isset($_POST['filter-appointments'])){
$datefrom = $_POST['datefrom'];
$dateend  = $_POST['dateend'];
$tbl_history = $mysqli->query("SELECT a.* ,b.firstname , b.lastname FROM tbl_history a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									where  (DATE(dcu) between '$datefrom' and '$dateend')");										
} else {
$tbl_history = $mysqli->query("SELECT a.* ,b.firstname , b.lastname FROM tbl_history a 
									LEFT JOIN tbl_signup b on b.id = a.user_id");	
}
$tbl_history_patient = $mysqli->query("SELECT a.* ,b.firstname , b.lastname FROM tbl_history a 
									LEFT JOIN tbl_signup b on b.id = a.user_id WHERE b.id='$data'");	
if(isset($_POST['add-patients'])){
	$fname    = $_POST['fname'];
	$lname    = $_POST['lname'];
	$email    = $_POST['email'];
	$address  = $_POST['address'];
	$sex 	  = $_POST['gender'];
	$bday 	  = $_POST['bday'];
	$password = md5($_POST['password']);
	
	$check    = $mysqli->query("SELECT * from tbl_signup where email='$email'");
	$count    = $check->num_rows;
	
	if($count !=0){
		echo "<script> window.location.href='patients.php?duplicate'; </script>";
	} else {
	$mysqli->query("INSERT INTO tbl_signup (firstname,lastname,email,address,sex,birthday,password,type) 
							VALUES ('$fname','$lname','$email','$address','$sex','$bday','$password','patient')");
		echo "<script> window.location.href='patients.php?registered'; </script>";
	
	}
	
	
}
if(isset($_POST['add-record'])){
	$name     = $_POST['name'];
	$dcu      = $_POST['dcu'];
	$findings = $_POST['findings'];
	$remarks = $_POST['remarks'];
		
		if( $_FILES["image"]["name"] == ""){
			
			$location   = "";

		} else{
			
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], "../page/back/history/" . $_FILES["image"]["name"]);
			$location   =  $_FILES["image"]["name"];
			
		}
		
		if( $_FILES["image1"]["name"] == ""){
			
			$location1   = "";

		} else {
	
			$image1 = addslashes(file_get_contents($_FILES['image1']['tmp_name']));
			$image_name = addslashes($_FILES['image1']['name']);
			$image_size = getimagesize($_FILES['image1']['tmp_name']);
			move_uploaded_file($_FILES["image1"]["tmp_name"], "../page/back/history/" . $_FILES["image1"]["name"]);
			$location1   =  $_FILES["image1"]["name"];
		}
			
		
	
	$mysqli->query("INSERT INTO tbl_history (user_id,dcu,findings,before_photo,after_photo,remarks) VALUES ('$name','$dcu','$findings','$location','$location1','$remarks')");
	echo "<script> window.location.href='dental-history.php?added'; </script>";
}

if(isset($_POST['update-record'])){
	
	$name     = $_POST['name'];
	$dcu      = $_POST['dcu'];
	$findings = $_POST['findings'];
	$id       = $_POST['id'];
	$remarks  = $_POST['remarks'];
	
	if( $_FILES["image"]["name"] == ""){
			
			$location   = $_POST['image_1'];

		} else{
			
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], "../page/back/history/" . $_FILES["image"]["name"]);
			$location   =  $_FILES["image"]["name"];
			
		}
		
		if( $_FILES["image1"]["name"] == ""){
			
			$location1   = $_POST['image_2'];

		} else {
	
			$image1 = addslashes(file_get_contents($_FILES['image1']['tmp_name']));
			$image_name = addslashes($_FILES['image1']['name']);
			$image_size = getimagesize($_FILES['image1']['tmp_name']);
			move_uploaded_file($_FILES["image1"]["tmp_name"], "../page/back/history/" . $_FILES["image1"]["name"]);
			$location1   =  $_FILES["image1"]["name"];
		}
	
	$mysqli->query("UPDATE tbl_history set  user_id ='$name' ,dcu = '$dcu',findings='$findings',remarks='$remarks',before_photo='$location',after_photo='$location1' where id='$id'");
	echo "<script> window.location.href='dental-history.php?updated'; </script>";
}

if(isset($_POST['delete-record'])){
	
	$id       = $_POST['id'];
	
	$mysqli->query("DELETE FROM tbl_history where id='$id'");
	echo "<script> window.location.href='dental-history.php?deleted'; </script>";
}


if(isset($_POST['submit-schedule'])){
	$services =  $_POST['services'];
	$date     =  $_POST['date'];
	$time     =  $_POST['time'];
	$userid   =  $_POST['userid'];
	$mysqli->query("INSERT INTO tbl_appointments (user_id , request_date,request_time,service_id,is_calendar,approved) VALUES ('$userid', '$date' , '$time' , '$services',1,1) ");
	echo "<script> window.location.href='patients.php?added'; </script>";
}
