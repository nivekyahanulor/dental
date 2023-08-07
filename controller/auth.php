<?php

	ob_start();
	session_start();
	include('database.php');

	$email    = mysqli_real_escape_string($mysqli,$_POST['user']);
	$password = mysqli_real_escape_string($mysqli,md5($_POST['password']));

	$sql      = "SELECT * FROM tbl_signup WHERE email='$email' AND BINARY password='$password' AND is_confirm= 1";
	$result   = mysqli_query($mysqli, $sql);

	$row      = mysqli_fetch_assoc($result);

	if($row["type"]=="patient") {
		$_SESSION['email'] = $row['email'];
		$_SESSION['name']  = $row['firstname'] .' '. $row['lastname'];
		$_SESSION['type']  = $row['type'];
		$_SESSION['type']  = "patient";
		$_SESSION['id']    = $row['id'];
		header("location:../user/index.php");
	}
	else if($row["type"]=="admin") {
		$_SESSION['email'] = $row['email'];
		$_SESSION['name']  = $row['firstname'] .' '. $row['lastname'];
		$_SESSION['type']  = "admin";
		$_SESSION['id']    = $row['id'];
		header("location:../admin/index.php");
	}
	else {
		header("location:../login.php?error");
	}
