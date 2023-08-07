<?php include('header.php'); include('nav.php'); include('../controller/admin-patients.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Patients : (<?php echo $_GET['name'];?>) </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="patients.php">Patients</a></li>
          <li class="breadcrumb-item active">Records</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
		  <div class="card-body">
              <h5 class="card-title">Record</h5>

              <!-- Default Tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">APPOINTMENTS</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PAYMENTS</button>
                </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="profile" aria-selected="false">DENTAL HISTORY</button>
                </li>
              
              </ul>
              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
				  <table class="table datatable">
					<thead>
					  <tr>
						<th scope="col" class="text-center"> TRANSACTION NO. </th>
						<th scope="col" class="text-start"> SERVICE</th>
						<th scope="col" class="text-center"> DATE OF APPOINTMENT</th>
						<th scope="col" class="text-center"> TIME OF APPOINTMENT</th>
						<th scope="col" class="text-start"> STATUS </th>
					  </tr>
					</thead>
					<tbody>
					<?php while($val = $tbl_appointments->fetch_object()){ ?>
					  <tr>
						<td class="text-end"><?php echo $val->id;?></td>
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
						<td class="text-start" >
							<?php   if($val->approved == 0){
										echo "<a href='appointments.php?data=pending'> PENDING </a>";
									} else if($val->approved == 1){
										echo "APPROVED";
									} else if($val->approved == 2){
										echo "DONE";
									} else if($val->approved == 3){
										echo "REJECTED";
									} else if($val->approved == 4){
										echo "CANCELLED";
									}
							?>
						</td>
					  </tr>
					<?php } ?>
					</tbody>
				  </table>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  <table class="table datatable">
						<thead>
						  <tr>
							<th scope="col" class="text-center"> TRANSACTION NO. </th>
							<th scope="col" class="text-start"> SERVICE</th>
							<th scope="col" class="text-start">CHARGE (₱)</th>
							<th scope="col" class="text-end">  AMOUNT (₱)</th>
							<th scope="col" class="text-end"> INSTALLMENT(₱) </th>
							<th scope="col" class="text-start"> TRANSACTION </th>
							<th scope="col" class="text-end">BALANCE (₱)</th>
							<th scope="col" class="text-center">  DATE  </th>
							<th scope="col" class="text-start"> ADMIN NAME  </th>
						  </tr>
						</thead>
						<tbody>
						<?php while($val = $tbl_payment->fetch_object()){ ?>
						  <tr>
							<td class="text-center"><?php echo $val->id;?></td>
							<td class="text-start">
							<?php $services1 =  str_replace( array('[',']') , ''  ,$val->s_id );
							$res_ser1 = $mysqli->query("SELECT * FROM tbl_offer where id IN ($services1)");
							while($val11 = $res_ser1->fetch_object()){ 
								echo "-".$val11->service."<br>";
							}
							?>
							</td>
							<td class="text-start"><?php echo number_format($val->service_charge,2);?></td>
							<td class="text-end"><?php echo number_format($val->pay_amount,2);?></td>
							<td class="text-end"> <?php if($val->installment!=""){ echo "₱ ". number_format($val->installment,2);} else { echo  "Not Installment";}?></td>
							<td class="text-start"><?php echo $val->payment_status;?></td>
							<td class="text-end">₱ <?php if($val->balance !=0){echo number_format($val->balance,2);} else { echo number_format(0,2);}?></td>
							<td class="text-center"><?php echo  date('Y-m-d', strtotime($val->date_added));?></td>
							<td class="text-start"><?php echo $val->admin_name;?></td>
						 </tr>
						
						<?php } ?>
						</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
					  <table class="table datatable">
						<thead>
						  <tr>
							<th scope="col" class="text-center"> DATE CHECKUP</th>
							<th scope="col" class="text-start"> FINDINGS</th>
							<th scope="col" class="text-start"> BEFORE (IMAGE)</th>
							<th scope="col" class="text-start"> AFTER (IMAGE)</th>
							<th scope="col" class="text-start"> REMARKS</th>
						  </tr>
						</thead>
						<tbody>
						<?php while($val = $tbl_history_patient->fetch_object()){ ?>
						  <tr>
							<td class="text-center"><?php echo $val->dcu;?></td>
							<td class="text-start"><?php echo $val->findings;?></td>
							<td class="text-start">
								<?php if($val->before_photo !=""){?>
									<img src="../page/back/history/<?php echo $val->before_photo;?>" width="200px">
								<?php } ?>
							</td>
							<td class="text-start">
								<?php if($val->after_photo !=""){?>
									<img src="../page/back/history/<?php echo $val->after_photo;?>" width="200px">
								<?php } ?>
							</td>
							<td class="text-start"><?php echo $val->remarks;?></td>
							
						  </tr>
						
						<?php } ?>
						</tbody>
						</table>
					</div>
				  </div><!-- End Default Tabs -->

				</div>
            <div class="card-body">
          
            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
<?php include('footer.php');?>
<?php if(isset($_GET['click'])){?>
<script type="text/javascript">
$(document).ready(function(){
    $("#profile-tab").click(); 
});
</script>
<?php } ?>
