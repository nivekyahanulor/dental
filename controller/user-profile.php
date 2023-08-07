<?php
include('database.php');
error_reporting(0);
$session_id = $_SESSION['id'];

$account    = $mysqli->query("SELECT * FROM tbl_signup where id = '$session_id'");
$val        = $account->fetch_assoc();


if(isset($_POST['update-profile'])){
	
	$fname    = $_POST['fname'];
	$lname    = $_POST['lname'];
	$email    = $_POST['email'];
	$address  = $_POST['address'];
	$sex 	  = $_POST['sex'];
	$bday 	  = $_POST['birthday'];
	
	$mysqli->query("UPDATE  tbl_signup SET firstname = '$fname',lastname = '$lname' ,
										   email= '$email',address= '$address',sex= '$sex',
										   birthday='$bday'
										   WHERE id='$session_id'");
	echo "<script> window.location.href='profile.php?updated'; </script>";

}
if(isset($_POST['update-password'])){
	

	$password = md5($_POST['password']);
	
	$mysqli->query("UPDATE  tbl_signup SET password='$password'	
										   WHERE id='$session_id'");
	echo "<script> window.location.href='profile.php?password-updated'; </script>";

}