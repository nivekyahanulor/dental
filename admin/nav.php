

<body>
 
  <?php
  	include('../controller/database.php');
  ?>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center"  style="background-color:#0d279c;">

    <div class="d-flex align-items-center justify-content-between">
       <!-- <img src="../page/front/img/logo.jpg" width="50px" alt="">-->
      <i class="bi bi-list toggle-sidebar-btn"  style="color:#fff !important;"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto" >
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3" >
			<?php 
			$isnew = $mysqli->query("SELECT a.*,b.* FROM tbl_appointments a left join tbl_signup b on b.id = a.user_id where a.is_new=0");
			$row_cnt = $isnew->num_rows;

			?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown" style="color:#fff !important;">
            <span class="d-none d-md-block dropdown-toggle ps-2"><i class="bi bi-bell"></i> <b> <?php echo $row_cnt;?> </b></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" >
             <?php 
					
					while($valnew = $isnew->fetch_object()){ 
			?>
            <li>
			<?php if($valnew->approved == 0){?>
              <a class="dropdown-item d-flex align-items-center" href="appointments.php?data=pending">
                <span> <?php echo $valnew->firstname. ' '. $valnew->lastname;?> Scheduled Appointment <br> <small>
				<?php 
					$datess = new DateTime($valnew->date_added);
					echo $datess->format('F d , Y');
				?></small>  </span>
              </a>
			<?php } if($valnew->approved == 4){?>
              <a class="dropdown-item d-flex align-items-center" href="appointments.php?data=cancelled">
                <span> <?php echo $valnew->firstname. ' '. $valnew->lastname;?> Cancelled Appointment  <br> <small> <?php 
					$datess = new DateTime($valnew->date_added);
					echo $datess->format('F d , Y');
				?></small> </span>
              </a>
			<?php } ?>
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
			if($page =='index.php')  { $a = 'active'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; $j = 'collapsed'; $z ="collapsed";  }
			else if($page =='appointments.php'){ $a = 'collapsed'; $b = 'active'; $bshow ='show'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $i = 'collapsed';$h = 'collapsed'; $j = 'collapsed';  $z ="collapsed"; }
			else if($page =='calendar.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'active'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed';  $j = 'collapsed'; $z ="collapsed"; }
			else if($page =='patients.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'active'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; $j = 'collapsed';  $z ="collapsed"; }
			else if($page=='patients-records.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'active'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed';  $j = 'collapsed'; $z ="collapsed"; }
			else if($page=='patients.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'active'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; $j = 'collapsed'; }
			else if($page =='dental-history.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'active'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'collapsed'; $j = 'collapsed'; $z ="collapsed"; }
			else if($page =='payments.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'active'; $fshow = 'show'; $g = 'collapsed'; $h = 'collapsed';$i = 'collapsed'; $j = 'collapsed';  $z ="collapsed"; }
			else if($page =='services.php' || $page == 'installment.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'active'; $h = 'collapsed'; $i = 'collapsed'; $j = 'collapsed';  $z ="collapsed"; }
			else if($page =='about.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'active'; $i = 'collapsed'; $j = 'collapsed';}
			else if($page =='users.php' || $page=='edit-user.php' ){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'active'; $j = 'collapsed'; $z ="collapsed";  }
			else if($page =='transaction.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'collapsed'; $j = 'active'; }
			else if($page =='doctors.php'){ $a = 'collapsed'; $b = 'collapsed'; $c = 'collapsed'; $d = 'collapsed'; $e= 'collapsed'; $f = 'collapsed'; $g = 'collapsed'; $h = 'collapsed'; $i = 'collapsed'; $j = 'collapsed'; $z ="active"; }
			
		?>
      <li class="nav-item">
        <a class="nav-link <?php echo $a;?>" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

	    <li class="nav-item">
        <a class="nav-link <?php echo $b;?>" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
         <i class="bi bi-book"></i><span>Appointments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse <?php echo $bshow;?>" data-bs-parent="#sidebar-nav">
		  <li>
            <a href="appointments.php?data=approved">
              <i class="bi bi-circle"></i><span>Approved</span>
            </a>
          </li>
		
		   <li>
            <a href="appointments.php?data=done">
              <i class="bi bi-circle"></i><span>Done</span>
            </a>
          </li> 
          <li>
            <a href="appointments.php?data=declined">
              <i class="bi bi-circle"></i><span>Declined</span>
            </a>
          </li>
          <li>
            <a href="appointments.php?data=cancelled">
              <i class="bi bi-circle"></i><span>Cancelled</span>
            </a>
          </li>
        </ul>
      </li>
	   <li class="nav-item">
        <a class="nav-link <?php echo $j;?> " href="transaction.php?data=transaction">
          <i class="bi bi-calendar2-check"></i>
          <span>Transaction</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $c;?> " href="calendar.php">
          <i class="bi bi-calendar2-check"></i>
          <span>Calendar</span>
        </a>
      </li>
		<li class="nav-item">
        <a class="nav-link <?php echo $z;?>" href="doctors.php">
          <i class="bi bi-person"></i>
          <span>Dentist</span>
        </a>
      </li>
	
      <li class="nav-item">
        <a class="nav-link <?php echo $d;?>" href="patients.php">
          <i class="bi bi-file-person"></i>
          <span>Patients</span>
        </a>
      </li>
		<li class="nav-item">
        <a class="nav-link <?php echo $e;?>" href="dental-history.php">
          <i class="bi bi-journal-check"></i>
          <span>Dental History</span>
        </a>
      </li>

		<li class="nav-item">
        <a class="nav-link <?php echo $f;?>" data-bs-target="#forms1-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash"></i><span>Payments</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms1-nav" class="nav-content collapse <?php echo $fshow;?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="payments.php?data=record">
              <i class="bi bi-circle"></i><span>Record</span>
            </a>
          </li>
		  <li>
            <a href="payments.php?data=balance">
              <i class="bi bi-circle"></i><span>Balance</span>
            </a>
          </li>
		  
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $g;?>" href="services.php">
          <i class="bi bi-clipboard"></i>
          <span>Services</span>
        </a>
      </li>
	
		
      </li>
		<li class="nav-item">
        <a class="nav-link <?php echo $h;?>" href="about.php">
          <i class="bi bi-exclamation-circle"></i>
          <span>About</span>
        </a>
      </li>
		<li class="nav-item">
        <a class="nav-link <?php echo $i;?>" href="users.php">
         <i class="bi bi-person-badge-fill"></i>
          <span>System Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Sign Out</span>
        </a>
      </li>

     
    </ul>

  </aside><!-- End Sidebar-->
