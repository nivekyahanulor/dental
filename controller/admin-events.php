<?php
include('database.php');
error_reporting(0);


	
$tbl_event  = $mysqli->query("SELECT * from tbl_event");	

$tbl_event1 = $mysqli->query("SELECT * from tbl_event");	


if(isset($_POST['update-event'])){
	$title 			= $_POST['title'];
	$start 			= $_POST['start'];
	$end   			= $_POST['end'];
	$description    = $_POST['description'];
	$id    		    = $_POST['id'];
	$discount       = $_POST['discount'];
	$service        = json_encode($_POST['service']);
	
	$mysqli->query("UPDATE tbl_event set title = '$title',start = '$start',end = '$end' ,description='$description',discount='$discount' ,services = '$service' where id='$id'");
	$mysqli->query("UPDATE  tbl_promo set percentage = '$discount',title = '$title' where event_id ='$id'");
	echo "<script> window.location.href='calendar.php?updated'; </script>";
}

if(isset($_POST['delete-event'])){
	$id      = $_POST['id'];
	
	$mysqli->query("DELETE FROM tbl_event  where id='$id'");
	$mysqli->query("DELETE FROM tbl_promo  where event_id='$id'");
	echo "<script> window.location.href='calendar.php?deleted'; </script>";
}

if(isset($_POST['add-event'])){
	$title       = $_POST['title'];
	$description = $_POST['description'];
	$start       = $_POST['start'];
	$end         = $_POST['end'];
	$discount    = $_POST['discount'];
	if(isset($_POST['promo'])){
		$is_promo = 1;
		$services = json_encode($_POST['services']);
	} else {
		$is_promo = 2;
	}
	$mysqli->query("INSERT INTO tbl_event (title,start,end,description,is_promo,discount,services) VALUES ('$title','$start','$end','$description','$is_promo','$discount','$services')");
	$event_id = $mysqli->insert_id;
	
	if(isset($_POST['promo'])){
		
		
		foreach ($_POST['services'] as $value) {
			$mysqli->query("INSERT INTO tbl_promo (event_id,title,service_id,percentage) VALUES ('$event_id','$title','$value','$discount')");
        }
	}
	
	echo "<script> window.location.href='calendar.php?added'; </script>";
}