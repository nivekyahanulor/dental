

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center"  style="background-color:#0d279c;">

     <div class="d-flex align-items-center justify-content-between">
        <!--<a href="../index.php"> <img src="../page/front/img/logo.jpg" width="50px" alt=""> </a>-->
      <i class="bi bi-list toggle-sidebar-btn"  style="color:#fff !important;"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
	  <li class="nav-item dropdown pe-3">
			<?php 
			include('../controller/database.php');
			$session_id = $_SESSION['id'];

			$isnew = $mysqli->query("SELECT a.*,b.* FROM tbl_appointments a left join tbl_signup b on b.id = a.user_id where a.is_new=1 and a.is_admin=1 and b.id = '$session_id'");
			$row_cnt = $isnew->num_rows;

			$ispromo = $mysqli->query("SELECT * from tbl_event where is_promo = 1");
			$row_cnt1 = $ispromo->num_rows;

			?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"  style="color:#fff !important;">
            <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-bell"></i> <b> <?php echo $row_cnt +  $row_cnt1;?> </b></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
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
              <a class="dropdown-item d-flex align-items-center" href="index.php?data=pending">
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

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
	  WELCOME : <?php echo $_SESSION['name'];?>
	  <hr>
    <?php
			error_reporting(0);
			$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		    $uri_segments = explode('/', $uri_path);
			$page =  $uri_segments[3];
			if($page =='index.php')  { $a = 'active'; $b = 'collapsed'; $c = 'collapsed';}
			else if($page =='calendar.php'){ $a = 'collapsed'; $b = 'active';  $c = 'collapsed'; }
			else if($page =='profile.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'active';  }
			?>
	  <li class="nav-item">
        <a class="nav-link " href="../index.php">
         <i class="bi bi-house"></i>
          <span>Home </span>
        </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link <?php echo $a;?> " href="index.php">
         <i class="bi bi-book"></i>
          <span>Appointments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $b;?>" href="calendar.php">
          <i class="bi bi-calendar2-check"></i>
          <span>Calendar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $c;?>" href="profile.php">
          <i class="bi bi-file-person"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Sign Out</span>
        </a>
      </li><!-- End Login Page Nav -->

     
    </ul>

  </aside><!-- End Sidebar-->
