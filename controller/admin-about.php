<?php
include('database.php');

error_reporting(0);


$tbl_about = $mysqli->query("SELECT * from tbl_about");
	
if(isset($_POST['update-information'])){
	$id       	   =  $_POST['about_id'];
	$information   =  $_POST['information'];
	$mysqli->query("UPDATE tbl_about set content = '$information' where about_id='$id'");
	echo "<script> window.location.href='about.php?updated'; </script>";
}