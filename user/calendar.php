<?php include('header.php'); include('nav.php'); include('../controller/admin-events.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Calendar  </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Calendar Record</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
			<br>
			 <h5> Legends : </h5>
				<p>  
				<button style="background-color:red;withd:2px !important;" > &nbsp; &nbsp; </button> Red - Full Schedules 
		        <button style="background-color:blue;" > &nbsp; &nbsp; </button> Blue - Events and Promos 
			    <button  style="background-color:green;" > &nbsp; &nbsp; </button> Green - Approved Appointments</p>
				<hr>
				<div id="calendar"></div>
            </div>
          </div>
		
		

        </div> 
      </div>
    </section>
  </main>
		
<?php include('footer.php');?>
