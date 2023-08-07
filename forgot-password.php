<?php
session_start();
if(isset($_SESSION['type'])){
	if($_SESSION['type'] == 'patient'){
		header("location:user/index.php");
	} else{
		header("location:admin/index.php");
	}
}
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
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                  <!--<img src="page/front/img/logo.jpg" width="100px" alt="">-->
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">
					<?php 
						 if(isset($_GET['registered'])){
							echo '<br> <div class="alert alert-success alert-dismissible fade show" role="alert"> <center><i class="bi bi-check-circle me-1"></i> REGISTRATION SUCCESS ! <br> LOGIN USING YOUR ACCOUNT!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} 
					?>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Enter your Email Address</h5>
					<?php if(isset($_GET['error'])){?>
						<p class="text-center small" style="color:red;">Error! Email not found!</p>
					<?php } ?>
                  </div>

                  <form class="row g-3 needs-validation" method="post" action="controller/forgot-password.php" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email Address : </label>
                      <div class="input-group has-validation">
                        <input type="text" name="user" class="form-control" id="yourUsername" autocomplete="off" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

             
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Send Code</button>
                    </div>
                  
                  </form>

                </div>
              </div>

             

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="page/back/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="page/back/vendor/php-email-form/validate.js"></script>
  <script src="page/back/vendor/quill/quill.min.js"></script>
  <script src="page/back/vendor/tinymce/tinymce.min.js"></script>
  <script src="page/back/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="page/back/vendor/chart.js/chart.min.js"></script>
  <script src="page/back/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="page/back/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="page/back/js/main.js"></script>

</body>

</html>