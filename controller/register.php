<?php
include('database.php');

	// error_reporting(0);
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
	require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
	
	if(isset($_POST['create-account'])){
		$fname    = $_POST['fname'];
		$lname    = $_POST['lname'];
		$email    = $_POST['email'];
		$address  = $_POST['address'];
		$sex 	  = $_POST['sex'];
		$bday 	  = $_POST['bday'];
		$mobile   = $_POST['number'];
		$password = md5($_POST['password']);
		$name     = $fname .' '.$lname;
		$check    = $mysqli->query("SELECT * from tbl_signup where email='$email'");
		$count    = $check->num_rows;
		
		if($count !=0){
			echo "<script> window.location.href='register.php?duplicate'; </script>";
		} else {
			
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'support@donesdentalclinic.online';
			$mail->Password = '@Programmer2013';
			$mail->SMTPSecure = 'ssl'; // tls
			$mail->Port     = 465; // 587
			$mail->setFrom('support@donesdentalclinic.online', 'AA DONES');
			$mail->addAddress($email);
			$mail->Subject = 'Account Confirmation';
			$mail->isHTML(true);


			$mail->Body = "<html>
								<body>
									<h1>Hello , " .$name ." </h1>
									<p> Thank you for registering to AA DONES Dental Clinic</p>
									<p> Kindly confirm your email address via the link below in order to start using your profile</p>
									<p> <a href='https://donesdentalclinic.online/confirm.php?name=$name&email=$email'> Link Here </a> </p>
								</body>
							</html>";

			if ($mail->send()) {
				$message = 'success';
			} else {
				$message = 'failed';
			}
			
		$mysqli->query("INSERT INTO tbl_signup (firstname,lastname,email,address,sex,birthday,password,type,mobile) 
								VALUES ('$fname','$lname','$email','$address','$sex','$bday','$password','patient','$mobile')");
		echo "<script> window.location.href='login.php?registered'; </script>";
		
	}
	}
