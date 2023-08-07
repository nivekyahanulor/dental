<?php include('header.php'); include('nav.php'); include('../controller/admin-doctors.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Services </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Dr. <?php echo strtoupper($_GET['name']);?> APPOINTMENTS</h5>
				
              <!-- Table with stripped rows -->
              <table class="table " id="table-3">
                <thead>
                  <tr>
                    <th scope="col" class="text-center"> TRANSACTION NO. </th>
                    <th scope="col" class="text-start"> NAME OF PATIENTS </th>
                    <th scope="col" class="text-start"> SERVICE</th>
					
                    <th scope="col" class="text-center"> DATE OF APPOINTMENT</th>
                    <th scope="col" class="text-center"> TIME OF APPOINTMENT</th>
					
                  </tr>
                </thead>
                <tbody>
				<?php 
				$count = 1;
				while($val = $tbl_doctors_ap->fetch_object()){ 
				$date = new DateTime($val->request_date);
				$now = new DateTime();			
				$srrv = $val->service_id;
				if($date < $now) {
				
				if($_GET['data'] == 'pending'){
				?>
				
                <tr bgcolor="">
				  
				<?php }} else { ?>
				 <tr>
				<?php } ?>
                    <td class="text-center"><?php echo $val->id;?></td>
                    <td class="text-start"><?php echo $val->firstname .' '. $val->lastname;?></td>
                    <td class="text-start">
					<?php $services =  str_replace( array('[',']') , ''  ,$val->s_id );
					$res_ser = $mysqli->query("SELECT * FROM tbl_offer where id IN ($services)");
					while($val1 = $res_ser->fetch_object()){ 
						echo "-".$val1->service."<br>";
					}
					?>
					</td>
				
                    <td class="text-center"><?php echo $val->request_date;?></td>
                    <td class="text-center"><?php echo date("g:i A", strtotime($val->request_time));?></td>
				
				
                  </tr>
				 
				<?php } ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
			
<?php include('footer.php');?>
