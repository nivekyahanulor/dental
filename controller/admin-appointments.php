<?php
include('database.php');

error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

$status = $_GET['data'];

if($status == 'pending'){
	$stat = 0;
} else if($status == 'approved' || $status == 'transaction'){
	$stat = 1;
}else if($status == 'done'){
	$stat = 2;
}else if($status == 'declined'){
	$stat = 3;
} else if($status == 'cancelled'){
	$stat = 4;
}
if(isset($_POST['filter-appointments'])){
$datefrom = $_POST['datefrom'];
$dateend  = $_POST['dateend'];
$tbl_appointments = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.email, b.id as user_id , c.service, c.id as service_id, a.service_id as s_id ,c.price , d.name FROM tbl_appointments a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									LEFT JOIN tbl_doctors d on a.doctor_id = d.doctor_id
									WHERE a.approved ='$stat' and (DATE(request_date) between '$datefrom' and '$dateend')
									");	
} else {
$tbl_appointments = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.email, b.id as user_id , c.service, a.service_id as s_id , c.id as service_id , c.price, d.name  FROM tbl_appointments a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									LEFT JOIN tbl_doctors d on a.doctor_id = d.doctor_id
									WHERE a.approved ='$stat'
									");
}
if(isset($_POST['reject-schedule'])){
	
	$reason   =  $_POST['reason'];
	$date     =  $_POST['date'];
	$id       =  $_POST['id'];
	$email    =  $_POST['email'];
	$name     =  $_POST['name'];
			
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'administrator@mlorense.com';
			$mail->Password = '@Mlorense2021';
			$mail->SMTPSecure = 'ssl'; // tls
			$mail->Port     = 465; // 587
			$mail->setFrom('administrator@mlorense.com', 'ML ORENSE');
			$mail->addAddress($email);
			$mail->Subject = 'Appointment Schedule';
			$mail->isHTML(true);


			$mail->Body = "<html>
								<body>
									<h1>Hello , " .$name ." </h1>
									<p>Your Schedule appointment has been declined!
									<br><br>
									REASON : " .$reason. "
									<br><br>
									Thank You for choosing ML ORENSE Dental Clinic
									<br><br> Login now to your account <a href='http://mlorense.com/' target='_blank'> Here </a>
									</p>
								</body>
							</html>";

			if ($mail->send()) {
				$message = 'success';
			} else {
				$message = 'failed';
			}
	
	$mysqli->query("UPDATE tbl_appointments set approved = 3 , cancel_reason ='$reason' , cancel_date = '$date' , is_admin = 1 where id='$id'");
	echo "<script> window.location.href='appointments.php?data=pending&rejected'; </script>";
}

if(isset($_POST['cancel-schedule'])){
	
	$reason   =  $_POST['reason'];
	$date     =  $_POST['date'];
	$id       =  $_POST['id'];
	$email    =  $_POST['email'];
	$name     =  $_POST['name'];
			
			
	$mysqli->query("UPDATE tbl_appointments set approved = 4, cancel_by=1 , cancel_reason ='$reason' , cancel_date = '$date', is_admin = 1 where id='$id'");
	echo "<script> window.location.href='appointments.php?data=cancelled&cancelled'; </script>";
}
if(isset($_POST['restore-schedule'])){
	
	$date     =  $_POST['date'];
	$id       =  $_POST['id'];
	$email    =  $_POST['email'];
	$name     =  $_POST['name'];
			
			
	$mysqli->query("UPDATE tbl_appointments set approved = 1, cancel_by=1  where id='$id'");
	echo "<script> window.location.href='transaction.php?data=transaction&restored'; </script>";
}

if(isset($_POST['approve-schedule'])){
		 $id       =  $_POST['id'];
		 $email    =  $_POST['email'];
		 $name     =  $_POST['name'];
	
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'administrator@mlorense.com';
			$mail->Password = '@Mlorense2021';
			$mail->SMTPSecure = 'ssl'; // tls
			$mail->Port     = 465; // 587
			$mail->setFrom('administrator@mlorense.com', 'ML ORENSE');
			$mail->addAddress($email);
			$mail->Subject = 'Appointment Schedule';
			$mail->isHTML(true);


			$mail->Body = "<html>
								<body>
									<h1>Hello , " .$name ." </h1>
									<p>Your Schedule appointment has been approved!
									<br>
									Please be on your Scheduled date!
									<br><br>
									Thank You for choosing ML ORENSE Dental Clinic
									<br><br> Login now to your account <a href='http://mlorense.com/' target='_blank'> Here </a>
									</p>
								</body>
							</html>";

			if ($mail->send()) {
				$message = 'success';
			} else {
				$message = 'failed';
			}
		 
	$mysqli->query("UPDATE tbl_appointments set approved = 1, is_admin = 1 where id='$id'");
	echo "<script> window.location.href='appointments.php?data=pending&approved'; </script>";
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
	if(isset($_POST['is_installment'])){
		$installment     =  $_POST['installment'];
		$is_installment  =  1;
	} else {
		$is_installment  =  '';
	}
	if($balance !=0){
	$mysqli->query("UPDATE tbl_signup set is_balance = 1 where id='$user_id'");
	}
	$mysqli->query("UPDATE tbl_appointments set approved = 2 where id='$id'");
	$mysqli->query("INSERT INTO tbl_payment (user_id,service_id,payment_date,service_charge,pay_amount,balance,payment_status,installment,is_installment,admin_name) 
									VALUES ('$user_id','$service_id','$date','$charge','$payment','$balance','Service Payment','$installment','$is_installment','$name')");
	echo "<script> window.location.href='transaction.php?data=transaction&done'; </script>";
}