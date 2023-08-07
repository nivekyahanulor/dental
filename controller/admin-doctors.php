<?php
include('database.php');
error_reporting(0);


	
$tbl_doctors = $mysqli->query("SELECT * from tbl_doctors");	

$ids = $_GET['id'];
$tbl_doctors_ap = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.email, b.id as user_id , c.service, a.service_id as s_id , c.id as service_id , c.price, d.name  FROM tbl_appointments a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									LEFT JOIN tbl_doctors d on a.doctor_id = d.doctor_id
									WHERE a.doctor_id ='$ids'");	



if(isset($_POST['update-doctor'])){
	$name      = $_POST['name'];
	$logo      = $_POST['logo'];
	$id        = $_POST['id'];
	$times      = $_POST['times'];
	$timee      = $_POST['timee'];
	$details    = $_POST['details'];
	$monday     = $_POST['monday'];
	$tuesday    = $_POST['tuesday'];
	$wednesday  = $_POST['wednesday'];
	$thursday   = $_POST['thursday'];
	$friday     = $_POST['friday'];
	$saturday   = $_POST['saturday'];
	$sunday     = $_POST['sunday'];
	
	if($logo ==""){
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/services/" . $_FILES["image"]["name"]);
			$location   =  $_FILES["image"]["name"];
		} else{
			if( $_FILES["image"]["name"] == ""){
					$location = $logo;
				} else {
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name = addslashes($_FILES['image']['name']);
					$image_size = getimagesize($_FILES['image']['tmp_name']);
				    move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/doctor/" . $_FILES["image"]["name"]);
					$location   =  $_FILES["image"]["name"];
			}
	}
	
	$mysqli->query("UPDATE tbl_doctors set name = '$name',photo = '$location',times = '$times',timee = '$timee',details = '$details' , 
	monday='$monday' ,
	tuesday='$tuesday' ,
	wednesday='$wednesday' ,
	thursday='$thursday' ,
	friday='$friday' ,
	saturday='$saturday' ,
	sunday='$sunday'
	where doctor_id='$id'");
	echo "<script> window.location.href='doctors.php?updated'; </script>";
}

if(isset($_POST['delete-doctor'])){
	$id      = $_POST['id'];
	
	$mysqli->query("DELETE FROM tbl_doctors  where doctor_id='$id'");
	echo "<script> window.location.href='doctors.php?deleted'; </script>";
}

if(isset($_POST['add-doctor'])){
	$name       = $_POST['name'];
	$times      = $_POST['times'];
	$timee      = $_POST['timee'];
	$details    = $_POST['details'];
	$monday     = $_POST['monday'];
	$tuesday    = $_POST['tuesday'];
	$wednesday  = $_POST['wednesday'];
	$thursday   = $_POST['thursday'];
	$friday     = $_POST['friday'];
	$saturday   = $_POST['saturday'];
	$sunday     = $_POST['sunday'];
	
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_FILES['image']['name']);
    $image_size = getimagesize($_FILES['image']['tmp_name']);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/doctor/" . $_FILES["image"]["name"]);
	$location   =  $_FILES["image"]["name"];
	
	$mysqli->query("INSERT INTO tbl_doctors (name,times,timee, photo, details, monday, tuesday, wednesday, thursday, friday, saturday, sunday)
				VALUES ('$name','$times','$timee','$location','$details','$monday','$tuesday','$wednesday','$thursday','$friday','$saturday','$sunday')");
	echo "<script> window.location.href='doctors.php?added'; </script>";
}

