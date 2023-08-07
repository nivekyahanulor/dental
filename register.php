<!DOCTYPE html>
<html lang="en">
<?php
	include('controller/register.php');
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>REGISTER</title>
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
						 if(isset($_GET['duplicate'])){
							echo '<br> <div class="alert alert-warning alert-dismissible fade show" role="alert"> <center><i class="bi  bi-exclamation-circle me-1"></i> EMAIL ALREADY REGISTERED! <br> LOGIN USING YOUR ACCOUNT!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} 
					?>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST"  >
                    <div class="col-12">
                      <label for="yourName" class="form-label">First Name</label>
                      <input type="text" name="fname" class="form-control" id="yourName" autocomplete="off" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>
					<div class="col-12">
                      <label for="yourName" class="form-label">Last Name</label>
                      <input type="text" name="lname" class="form-control" id="yourName"  autocomplete="off" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>
					<div class="col-12">
                      <label for="yourName" class="form-label">Sex</label>
					  <br>
					  <input class="form-check-input" name="sex" value="Male" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
					  <label class="form-check-label" for="flexRadioDefault1">
						Male
					  </label>
					  <input class="form-check-input"  name="sex" value="Female" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
					  <label class="form-check-label" for="flexRadioDefault2">
						Female
					  </label>
                      <div class="invalid-feedback">Please, enter your sex!</div>
                    </div>
					<div class="col-12">
                      <label for="yourName" class="form-label">Birthday</label>
                      <input type="date" name="bday" class="form-control" id="yourName"  max="<?php echo date('Y-m-d');?>" autocomplete="off" required>
                      <div class="invalid-feedback">Please, enter your birthday!</div>
                    </div>
					<div class="col-12">
                      <label for="yourName" class="form-label">Address</label>
                      <input type="text" name="address" class="form-control" id="yourName"  autocomplete="off" required>
                      <div class="invalid-feedback">Please, enter your address!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail"  autocomplete="off" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
					<div class="col-12">
                      <label for="yourMobile" class="form-label">Mobile Number</label>
                      <input type="text" name="number" class="form-control" id="yourMobile" maxlength="11" onkeypress='validate(event)'  autocomplete="off" required>
                      <div class="invalid-feedback">Please enter a Mobile Number!</div>
                    </div>

                    <div class="col-12 pass_show">
                      <label for="yourPassword" class="form-label">Password</label>
					  <div class="input-group mb-3 " >
                        <input type="password" name="password" id="password" class="form-control" required>
						   <span class="input-group-text" onclick="password_show_hide();">
							  <i class="bi bi-eye" id="show_eye"></i>
							  <i class="bi bi-eye-slash d-none" id="hide_eye"></i>
							</span>
						</div>
					   
						
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                   <div class="col-12 pass_show">
                      <label for="yourPassword" class="form-label">Confirm Password</label>
					  <div class="input-group mb-3 " >
                        <input type="password" id="password1" class="form-control"  required>
						   <span class="input-group-text" onclick="password_show_hide1();">
							  <i class="bi bi-eye" id="show_eye1"></i>
							  <i class="bi bi-eye-slash d-none" id="hide_eye1"></i>
							</span>
						</div>
					   
						
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
					<span id='message'></span>
                  
                    <div class="col-12">
					   <input type="checkbox" required> I Agree to the <a href="" type="button" data-bs-toggle="modal" data-bs-target="#squarespaceModal"> Terms and Condition </a>
					   <div class="invalid-feedback">Agree to the Terms and Condition</div>

					   <br> <br>
                      <button class="btn btn-primary w-100" type="submit" name="create-account" id="create-btn" style="display:none;">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            
            </div>
          </div>
        </div>

      </section>

    </div>
	
			<!-- line modal -->
			<div class="modal fade" id="squarespaceModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">TERMS AND CONDITION</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <?php 
						$tbl_about = $mysqli->query("SELECT * from tbl_about where page='Terms and Condition'");
						$info1     = $tbl_about->fetch_assoc();
						echo $info1['content'];
						?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
  <script>
  
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
  </script>
  <script>
 function password_show_hide() {
  var x = document.getElementById("password");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
  
  </script> 
  <script>
 function password_show_hide1() {
  var x = document.getElementById("password1");
  var show_eye = document.getElementById("show_eye1");
  var hide_eye = document.getElementById("hide_eye1");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
  
  </script>
  <script>
  $('#password1').on('keyup', function () {
  if ($('#password').val() == $('#password1').val()) {
	$("#create-btn").show();
    $('#message').html('Password Match').css('color', 'green');
  } else {
	$("#create-btn").hide();
    $('#message').html('Not Password Match').css('color', 'red');
  }
});
  </script>
</body>

</html>