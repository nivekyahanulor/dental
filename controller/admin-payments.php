<?php
include('database.php');
error_reporting(0);

date_default_timezone_set('Asia/Singapore');

$status = $_GET['data'];

if($status == 'record'){
	if(isset($_POST['filter-appointments'])){
	$datefrom = $_POST['datefrom'];
	$dateend  = $_POST['dateend'];
	$tbl_payment = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id FROM tbl_payment a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									where (DATE(date_added) between '$datefrom' and '$dateend')order by date_added ");	
	} else {
	$tbl_payment = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id FROM tbl_payment a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id order by date_added ");	
	}
}  else {
	if(isset($_POST['filter-appointments'])){
	$datefrom = $_POST['datefrom'];
	$dateend  = $_POST['dateend'];
	$tbl_payment = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id FROM tbl_payment a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id where a.balance !=0  and a.is_paid=0 and (DATE(date_added) between '$datefrom' and '$dateend') group by a.user_id order by date_added desc " );	
	} else {
	$tbl_payment = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id , a.service_id as s_id FROM tbl_payment a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id where a.balance !=0  and a.is_paid=0  group by a.user_id order by date_added ");	
	
	}
}

								
if(isset($_POST['done-schedule'])){
	
	$id         =  $_POST['id'];
	$user_id    =  $_POST['user_id'];
	$service_id =  $_POST['service_id'];
	$date       =  $_POST['date'];
	$balance    =  $_POST['balance'];
	$charge     =  $_POST['charge'];
	$payment    =  $_POST['payment'];
	$name       =  $_POST['name'];
	$installment       =  $_POST['installment'];
	if($balance !=0){
	$mysqli->query("UPDATE tbl_signup set is_balance = 1 where id='$user_id'");
	} else {
	$mysqli->query("UPDATE tbl_signup set is_balance = 0 where id='$user_id'");
	}
	$mysqli->query("UPDATE tbl_payment set is_paid = 1 where id='$id'");
	$mysqli->query("INSERT INTO tbl_payment (user_id,service_id,payment_date,service_charge,pay_amount,balance,payment_status,admin_name,installment) 
									VALUES ('$user_id','$service_id','$date','$charge','$payment','$balance','Balance Payment','$name','$installment')");
	if($_GET['data'] == 'balance'){
		echo "<script> window.location.href='payments.php?data=balance&done'; </script>";
	} else {
		echo "<script> window.location.href='payments.php?data=record&done'; </script>";
	}
}		
						
if(isset($_POST['add-payment'])){
	
	$id         =  $_POST['id'];
	$user_id    =  $_POST['user_id'];
	$service_id =  json_encode($_POST['service_id']);
	$date       =  $_POST['date'];
	$balance    =  $_POST['balance'];
	$charge     =  $_POST['charge'];
	$payment    =  $_POST['payment'];
	$name       =  $_SESSION['name'];
	if($balance !=0){
	$mysqli->query("UPDATE tbl_signup set is_balance = 1 where id='$user_id'");
	} else {
	$mysqli->query("UPDATE tbl_signup set is_balance = 0 where id='$user_id'");
	}
		
	if(isset($_POST['is_installment'])){
		$installment     =  $_POST['installment'];
		$is_installment  =  1;
	} else {
		$is_installment  =  '';
	}
	
	$time =  date("h:i A", time());
	
	$mysqli->query("INSERT INTO tbl_payment (user_id,service_id,payment_date,service_charge,pay_amount,balance,payment_status,installment,is_installment,admin_name) 
									VALUES ('$user_id','$service_id','$date','$charge','$payment','$balance','Add Payment','$installment','$is_installment','$name')");
	
	$mysqli->query("INSERT INTO tbl_appointments (user_id,request_date,request_time,service_id,approved,is_payment) 
									VALUES ('$user_id','$date','$time','$service_id','2','1')");
									
	if($_GET['data'] == 'balance'){
		echo "<script> window.location.href='payments.php?data=balance&done'; </script>";
	} else {
		echo "<script> window.location.href='payments.php?data=record&done'; </script>";
	}
}