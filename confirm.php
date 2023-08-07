<?php
include('controller/database.php');

$email = $_GET['email'];
$name  = $_GET['name'];

$mysqli->query("UPDATE tbl_signup set is_confirm = 1 where email='$email'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LOGIN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="page/back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="page/back/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="page/back/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="page/back/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="page/back/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="page/back/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="page/back/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="page/back/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="">

        <div class="">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-4 justify-content-center">

              <div class="d-flex justify-content-center py-4">
                  <!--<img src="page/front/img/logo.jpg" width="250px" alt="">-->
              </div><!-- End Logo -->

              <div class="card">

                <div class="card-body">
					<br><br>
					Your Account is confirmed!
					<br>
					<br>
					Login using your account details!
					<br>
					<br>
					
					Thank You!
					
					<br>
					<br>
					<a href="login.php"> LOGIN </a>
					<br>

                </div>
              </div>

             

            </div>
          </div>
        </div>


    </div>
  </main><!-- End #main -->

</body>

</html>