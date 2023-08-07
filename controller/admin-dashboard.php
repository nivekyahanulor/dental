<?php
include('database.php');

error_reporting(0);
date_default_timezone_set('Asia/Manila');
$date				    = date('Y-m-d');
$tbl_appointments_today = $mysqli->query("SELECT * from tbl_appointments where request_date='$date' and approved=1");
$today                  = $tbl_appointments_today->num_rows;

$tbl_appointments	    = $mysqli->query("SELECT * from tbl_appointments ");
$appointments        	= $tbl_appointments->num_rows;

$approved	            = $mysqli->query("SELECT * from tbl_appointments where approved=1");
$approveds        	    = $approved->num_rows;

$cancel 	            = $mysqli->query("SELECT * from tbl_appointments where approved=4");
$cancelled        	    = $cancel->num_rows;

$decline 	            = $mysqli->query("SELECT * from tbl_appointments where approved=3");
$declined        	    = $decline->num_rows;

$tbl_signup_all			= $mysqli->query("SELECT * from tbl_signup where type='patient'");
$signups                = $tbl_signup_all->num_rows;