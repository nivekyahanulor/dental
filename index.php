<?php
session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<?php
	  include('controller/database.php');
	  $tbl_offer = $mysqli->query("SELECT * from tbl_offer");
	  $tbl_doctors = $mysqli->query("SELECT * from tbl_doctors");
?>
<style>


.card {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top {
    display: block;
    width: 100%;
    height: auto;
}

.card-title {
    font-size: 1.28571429em;
    font-weight: 700;
    line-height: 1.2857em;
}

.card-text {
    clear: both;
    margin-top: .5em;
    color: rgba(0, 0, 0, .68);
}

.card-footer {
    font-size: 1em;
    position: static;
    top: 0;
    left: 0;
    max-width: 100%;
    padding: .75em 1em;
    color: rgba(0, 0, 0, .4);
    border-top: 1px solid rgba(0, 0, 0, .05) !important;
    background: #fff;
}

.card-inverse .btn {
    border: 1px solid rgba(0, 0, 0, .05);
}

.profile {
    position: absolute;
    top: -12px;
    display: inline-block;
    overflow: hidden;
    box-sizing: border-box;
    width: 25px;
    height: 25px;
    margin: 0;
    border: 1px solid #fff;
    border-radius: 50%;
}

.profile-avatar {
    display: block;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.profile-inline {
    position: relative;
    top: 0;
    display: inline-block;
}

.profile-inline ~ .card-title {
    display: inline-block;
    margin-left: 4px;
    vertical-align: top;
}

.text-bold {
    font-weight: 700;
}

.meta {
    font-size: 1em;
    color: rgba(0, 0, 0, .4);
}

.meta a {
    text-decoration: none;
    color: rgba(0, 0, 0, .4);
}

.meta a:hover {
    color: rgba(0, 0, 0, .87);
}
</style>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DENTAL CLINIC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="page/front/vendor/aos/aos.css" rel="stylesheet">
  <link href="page/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="page/front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="page/front/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="page/front/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="page/front/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="page/front/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="page/back/css/fullcalendar.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="page/front/css/style.css" rel="stylesheet">
	 <style>
		.modal-backdrop {
			 height: 100%;
			display: none;    
		}
	 </style>
	 <style>
#slider	{ 
    position:relative;
    margin:0;
    padding:0;
    list-style-type:none;
    width:100%;
    height:730px;
    border: 1px solid #008000;     
    overflow:hidden; 
}
#slider li { 
}
#slider img {
    width:100%;
    height:730px;
}
#slider p { 
    position:absolute;
    bottom:0;
    padding:20px;
    color:#ffffff;
    margin:10%;
    left:0;
    right:0; 
	font-size :30px;
}

.maintxt {position: relative;}
.maintxt > img, .overlay-text {position: absolute;}
#cardhover:hover {
  background: #ADD8E6;
}
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" style="background-color:#0d279c;">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php"  style="color:#fff;"> <!--<img src="page/front/img/logo.jpg" alt="" class="img-fluid">--> DENTAL CLINIC</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" style="color:#fff;" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto"  style="color:#fff;" href="#services">Services</a></li>
          <li><a class="nav-link scrollto"  style="color:#fff;" href="#doctors">Dentist</a></li>
		  <li><a class="nav-link scrollto"  style="color:#fff;" href="#about">About</a></li>
		  <?php
			if(isset($_SESSION['type'])){
				if($_SESSION['type'] == 'patient'){
			?>
			 <li><a class="nav-link scrollto"  style="color:#fff;" href="user/index.php">Appointment</a></li>
			   <li class="nav-item dropdown pe-3">
			<?php 
			include('controller/database.php');
			$session_id = $_SESSION['id'];

			$isnew = $mysqli->query("SELECT a.*,b.* FROM tbl_appointments a left join tbl_signup b on b.id = a.user_id where a.is_new=1 and a.is_admin=1 and b.id = '$session_id'");
			$row_cnt = $isnew->num_rows;

			$ispromo = $mysqli->query("SELECT * from tbl_event where is_promo = 1");
			$row_cnt1 = $ispromo->num_rows;

			?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"  style="color:#fff !important;">
            <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-bell"></i> <b> <?php echo $row_cnt +  $row_cnt1;?> </b></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="">
             <?php 
					
					while($valnew = $isnew->fetch_object()){ 
			?>
            <li>
			<?php if($valnew->approved == 1){?>
              <a class="dropdown-item d-flex align-items-center" href="index.php?data=pending">
                <span> Administrator approved your appointment <br> <small> 
				<?php 
					$date = new DateTime($valnew->date_added);
					echo $date->format('F d , Y');
				?>
				</small> </span>
              </a>
			<?php } if($valnew->approved == 4 ||  $valnew->approved == 3){?>
              <a class="dropdown-item d-flex align-items-center" href="index.php?data=cancelled">
                <span> Administrator decline your Appointment <br> <small> 
				<?php 
					$date = new DateTime($valnew->date_added);
					echo $date->format('F d , Y');
				?>
				</small> </span>
              </a>
			<?php } ?>
            </li>
			<?php } ?>
			<?php 
				while($valpro = $ispromo->fetch_object()){ 
			?>
			<li>
              <a class="dropdown-item d-flex align-items-center" href="user/index.php?data=pending">
                <span> Promo <?php echo $valpro->title;?><br><small>Date <?php echo $valpro->start.' - '.$valpro->start;?> </small></span>
              </a>
            </li>
			<?php } ?>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="color:#fff !important;">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name'];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="">
          
            <li style="color:#0000;">
              <a class="dropdown-item d-flex align-items-center" href="user/profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            
            <li>
              <a class="dropdown-item d-flex align-items-center" href="user/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

			<?php } else{ ?>
			 <li><a class="nav-link scrollto"  style="color:#fff;" href="admin/index.php">Dashboard</a></li>
			<?php	}
			} else { 
			?>
          <li><a class="nav-link scrollto"  style="color:#fff;" href="login.php">Login</a></li>
          <li><a class="nav-link scrollto"  style="color:#fff;" href="register.php">Register</a></li>
		<?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
<ul id="slider">
	<li>
		<a href="#">
			<img src="page/front/img/1.jpg" alt="Alter Apfelbaum"/>
		</a>
	</li>
	<li>
    	<a href="#">
			<img src="page/front/img/1.jpg" alt="Alter Apfelbaum"/>
    	</a>
	</li>
	    
     
         <p>
          <b> DENTAL CLINIC </b> <br>
		  General Dentristry  & Orthodontics <br>
		  We Take your Smile to Heart <br>
		  <?php if(isset($_SESSION['type'])){
				if($_SESSION['type'] == 'patient'){
			?>
			<a href="user/index.php" class="btn btn-md btn-info"> Schedule an Appointment </a>
		  <?php } } else { ?>
		  	<a href="register.php" class="btn btn-md btn-primary"> Schedule an Appointment </a>
		  <?php } ?>
         </p>
    
</ul>
<br>
	
  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
        </div>
        <div class="row">
		
		<?php while($val = $tbl_offer->fetch_object()){ ?>
		
			  <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
			  <a href=""  data-bs-toggle="modal" data-bs-target="#servicesdetails<?php echo $val->id;?>">
				<div class="icon-box iconbox-blue"  id="cardhover">
				  <h4><?php echo $val->service;?></h4>
				  <h4> ₱ <?php echo number_format($val->price,2);?></h4>
				</div>
				</a>
			  </div>
				<div class="modal fade" id="servicesdetails<?php echo $val->id;?>" tabindex="-1"  data-backdrop="false">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo $val->service;?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <center><img src="page/front/services/<?php echo $val->photo;?>" width="700px"></center>
					  <br>
					  <p> <h4> ₱ <?php echo number_format($val->price,2);?></h4></p>
					  <p> <?php echo $val->description;?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
             </div>
			
		<?php  } ?>
        </div>

      </div>
    </section>
	<!-- ======= Services Section ======= -->
    <section id="doctors" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Dentist</h2>
        </div>
		
		  <div class="row">
		<?php while($val1 = $tbl_doctors->fetch_object()){ ?>
		
			  <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
			  <a href=""  data-bs-toggle="modal" data-bs-target="#servicesdetails1<?php echo $val1->doctor_id;?>">
				<div class="icon-box iconbox-blue"  id="cardhover">
                    <img class=""  src="page/front/doctor/<?php echo $val1->photo;?>" width="250px" height="250px;">
					<h4><?php echo $val1->name;?></h4>
				</div>
				</a>
			  </div>
				<div class="modal fade" id="servicesdetails1<?php echo $val1->doctor_id;?>" tabindex="-1"  data-backdrop="false">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"> <?php echo $val1->name;?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
					  <p>Dentist Time : <br> <br><?php echo $val1->times .' - '.  $val1->timee;?></p>
					  <p>Dentist Details : <br> <br><?php echo $val1->details;?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
             </div>
			  
		<?php  } ?>
        </div>
     

      </div>
    </section>

   
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-12">
            <p align="justify">
				<?php 
				$tbl_about = $mysqli->query("SELECT * from tbl_about where page='About'");
				$info1     = $tbl_about->fetch_assoc();
				echo $info1['content'];
				?>
            </p>
            
          </div>
             <div class="col-lg-12">
            <p align="justify">
			        <div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3864.5507479823505!2d120.85772041152127!3d14.395385082008195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33962c8e09f6a129%3A0x17cf71d160d9a1a5!2sDones%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1684535998780!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-12">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>
				<?php 
				$tbl_loc = $mysqli->query("SELECT * from tbl_about where page='Location'");
				$info2   = $tbl_loc->fetch_assoc();
				echo $info2['content'];
				?>
				</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>
				<?php 
				$tbl_email = $mysqli->query("SELECT * from tbl_about where page='Email'");
				$info3     = $tbl_email->fetch_assoc();
				echo $info3['content'];
				?>
				</p>
              </div>
				<div class="email">
                <i class="bi bi-facebook"></i>
                <h4>Facebook:</h4>
                <p>
				<?php 
				$tbl_email = $mysqli->query("SELECT * from tbl_about where page='Facebook'");
				$info3     = $tbl_email->fetch_assoc();
				?>
				<a href="<?php echo $info3['content'];?>" target="_blank"> <?php echo $info3['content'];?></a>
				</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
               <p>
				<?php 
				$tbl_con = $mysqli->query("SELECT * from tbl_about where page='Contact'");
				$info3   = $tbl_con->fetch_assoc();
				echo $info3['content'];
				?>
				</p>
              </div>

            </div>

          </div>

        
        </div>

            </p>
            
          </div>
          
        </div>

      </div>
    </section><!-- End About Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container  justify-content-center">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          <center> &copy; Copyright <strong><span> DENTAL CLINIC</span></strong>. All Rights Reserved | <a href="" data-bs-toggle="modal" data-bs-target="#squarespaceModal"> Terms and Condition </a> | <a href="" data-bs-toggle="modal" data-bs-target="#squarespaceModal1"> Privacy Policy </a>
        </div>
       
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	
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
			 
			 <div class="modal fade" id="squarespaceModal1" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PRIVACY POLICY</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <?php 
						$tbl_about = $mysqli->query("SELECT * from tbl_about where page='Privacy Policy'");
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
	
  <!-- Vendor JS Files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="page/front/vendor/aos/aos.js"></script>
  <script src="page/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="page/front/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="page/front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="page/front/vendor/php-email-form/validate.js"></script>
  <script src="page/front/vendor/purecounter/purecounter.js"></script>
  <script src="page/front/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="page/back/js/moment.js"></script>
  <script src="page/back/js/fullcalendar.js"></script>
  <!-- Template Main JS File -->
  <script src="page/front/js/main.js"></script>
  <?php 
  
		include('controller/admin-calendar.php');
		$calendar = array();
		$appointments = array();
	
			
			while($res = $tbl_event->fetch_object()){ 
				 $start = $res->start;
				 $startDate  = date("Y-m-d", strtotime($start));
				 $end = $res->end;
				 $endDate  = date("Y-m-d", strtotime($end));
				 $calendar[] = array( 
									  "title" => $res->title,
									  "description" => $res->description,
									  "percentage" => $res->discount,
									  "services" => str_replace('"', '',str_replace( array('[',']') , ''  ,$res->services )),
									  "start" => $startDate."T00:00:00.000",
									  "end"   => $endDate."T23:59:00",
									  "backgroundColor" => "blue",
									  "status" => "event",
									  "count" => "0",
									);
			}
			
			
			
				
				while($res1 = $tbl_appointments->fetch_object()){ 
				
					 $start = $res1->request_date;
					 
					 $tbl_date = $mysqli->query("SELECT count(request_date)dc, request_date FROM `tbl_appointments` where request_date='$start' and  approved !=0 and approved !=4");
					 $dr       = $tbl_date->fetch_assoc();
					 
					 if($dr['dc'] >=11){
						$count = 1;
					 } else {
						$count = 0;
					 }
					 
					 $startDate  = date("Y-m-d", strtotime($start));
					 
						 $appointments[] = array( "title" =>date("g:i A", strtotime($res1->request_time)),
										  "start" => $startDate,
										  "time" => date("g:i A", strtotime($res1->request_time)),
										  "backgroundColor" => "green",
										  "status" => "schedule",
										  "count" => $count
										);
				}
				

	?>
  <script>
  $(document).ready(function() {
	  
		$('#closecalendar').click(function() {
			$('#calendarmodal').modal('hide');
		});
		
		
		$('#calendars').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultView: 'month',
			events: <?php echo json_encode(array_merge($calendar,$appointments));?>,
			eventClick:  function(event, jsEvent, view) {
			   if(event.status=='event'){
					$('#calendarmodal').modal('show');
				    $('#calendarmodal').modal('show');
				    $('.modal').find('#name').html(''); 
					$('.modal').find('#appointments').html('');
					$('.modal').find('#time').html(''); 
					
					$('.modal').find('#title').html('Title : <br>' + event.title + '<br><br>');
					$('.modal').find('#description').html('Description : <br>' + event.description+ '<br><br>');
					$('.modal').find('#percentage').html('Discount : <br>' + event.percentage+ '% <br><br>');
					$('.modal').find('#services').html('Services : <br>' + event.services+ ' <br><br>');
					$('.modal').find('#starts1').html('Start : <br>' +$.fullCalendar.moment(event.start).format('YYYY/MM/DD')+ '<br><br>');
					$('.modal').find('#ends1').html('End : <br>' +$.fullCalendar.moment(event.end).format('YYYY/MM/DD')+ '<br><br>');
			   } else {
				 $('.modal').find('#name').html('Patient Name : <br>' + event.title + '<br><br>'); 
			     $('.modal').find('#appointments').html('Appointment Date : <br>' +$.fullCalendar.moment(event.start).format('YYYY/MM/DD')+ '<br><br>');
				 $('.modal').find('#time').html('Appointment Time : <br>' + event.time + '<br><br>'); 
				 
				 
				 $('.modal').find('#title').html('');
				 $('.modal').find('#description').html('');
				 $('.modal').find('#starts1').html('');
				 $('.modal').find('#ends1').html('');
			   }
        },eventRender: function(info,cell) {
			if(info.count ==1){
				$('.fc-day[data-date="'+$.fullCalendar.moment(info.start).format()+'"]').css('background', "red");
				$('.fc-title').css('visibility', "hidden");
			}
		  }
		});
		
	});

  
  </script>
</body>

</body>
<div class="modal" id="calendarmodal" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Calendar Details</h5>
              
              </div>
              <div class="modal-body">
											
						 <div id="name"></div>
						 <div id="appointments"></div>
						 <div id="time"></div>
						 <div id="title"></div>
						 <div id="description"></div>
						 <div id="services"></div>
						 <div id="percentage"></div>
						 <div id="starts1"></div>
						 <div id="ends1"></div>
					
											
              </div>
			   <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" id="closecalendar" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
		
</html>


<script>
$(function(){
	$('#slider li').hide().filter(':first').show();
	setInterval(slideshow, 3000);
});

function slideshow() {
	$('#slider li:first').fadeOut('slow').next().fadeIn('slow').end().appendTo('#slider');
}

</script>

