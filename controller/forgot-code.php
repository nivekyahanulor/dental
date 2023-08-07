<?php

	ob_start();
	session_start();
	include('database.php');

	$is_code    = mysqli_real_escape_string($mysqli,$_POST['user']);

	$sql      = "SELECT * FROM tbl_signup WHERE is_code='$is_code'";
	$result   = mysqli_query($mysqli, $sql);

	$row      = mysqli_fetch_assoc($result);

	if($row["type"]=="patient") {
		$_SESSION['email'] = $row['email'];
		$_SESSION['name']  = $row['firstname'] .' '. $row['lastname'];
		$_SESSION['type']  = $row['type'];
		$_SESSION['type']  = "patient";
		$_SESSION['id']    = $row['id'];
		header("location:../user/index.php");
	} else {
		header("location:../forgot-code.php?error");
	}
