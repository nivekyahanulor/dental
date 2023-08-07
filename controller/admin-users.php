<?php
include('database.php');

// error_reporting(0);

$tbl_signup = $mysqli->query("SELECT * from tbl_signup where type='admin'");

$data       =  $_GET['data'];
$account    = $mysqli->query("SELECT * FROM tbl_signup where id = '$data'");
$val        = $account->fetch_assoc();	

if(isset($_POST['add-user'])){
	
	$fname    = $_POST['fname'];
	$lname    = $_POST['lname'];
	$email    = $_POST['email'];
	$address  = $_POST['address'];
	$password = md5($_POST['password']);
	
	$mysqli->query("INSERT INTO tbl_signup (firstname,lastname,email,address,password,type,is_confirm) VALUES ('$fname','$lname','$email','$address','$password','admin',1)");
	echo "<script> window.location.href='users.php?added'; </script>";
	
	
}
if(isset($_POST['update-user'])){
	
	$fname    = $_POST['fname'];
	$lname    = $_POST['lname'];
	$email    = $_POST['email'];
	$address  = $_POST['address'];
	$password = md5($_POST['password']);
	$id       = $_POST['id'];
	
	$mysqli->query("UPDATE  tbl_signup set firstname = '$fname' ,lastname = '$lname',email= '$email',address='$address' where id='$id' ");
	echo "<script> window.location.href='users.php?updated'; </script>";
	
	
}

if(isset($_POST['update-password'])){
	
	$password = md5($_POST['password']);
	$id       = $_POST['id'];
	
	$mysqli->query("UPDATE  tbl_signup set password='$password' where id='$id' ");
	echo "<script> window.location.href='users.php?updated'; </script>";
	
	
}
if(isset($_POST['remove-user'])){
	
	$id       = $_POST['id'];
	
	$mysqli->query("DELETE  from tbl_signup where id='$id' ");
	echo "<script> window.location.href='users.php?removed'; </script>";
	
	
}


