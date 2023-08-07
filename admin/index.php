<?php include('header.php'); include('nav.php'); include('../controller/admin-dashboard.php');?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row justify-content-center">

        <div class="col-lg-8">
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Appointment <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?php echo $today;?></h1>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Patients <span></span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                     <h1><?php echo $signups;?></h1>
                    </div>
                  </div>

                </div>
              </div>

            </div>
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Appointments</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?php echo $appointments;?></h1>
                    </div>
                  </div>

                </div>
              </div>
            </div>

			<div class="col-xxl-4 col-xl-12">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Approved Appointments </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?php echo $approveds;?></h1>
                    </div>
                  </div>

                </div>
              </div>
            </div>
			
			<div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Cancelled Appointments </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="bi bi-journal-x"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?php echo $cancelled;?></h1>
                    </div>
                  </div>

                </div>
              </div>
            </div>
			
			<div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Declined Appointments </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                     <i class="bi bi-journal-minus"></i>
                    </div>
                    <div class="ps-3">
                      <h1><?php echo $declined;?></h1>
                    </div>
                  </div>

                </div>
              </div>
            </div>

           	<div class="col-xxl-12 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  
                        <div id="container"></div>


                </div>
              </div>
            </div>

           
			<!---<div class="col-xxl-12 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  
                        <div id="container-pie"></div>


                </div>
              </div>
            </div>-->

           

      </div>
    </section>

  </main><!-- End #main -->
<?php include('footer.php');?>
