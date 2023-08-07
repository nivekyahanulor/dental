<?php include('header.php'); include('nav.php'); include('../controller/user-appointments.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">My Appointments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
	
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
		  
            <div class="card-body">
			<h5 class="card-title">List of Appointments  
				<?php
					if(isset($_GET['data']) == 'pending'){
					$mysqli->query("UPDATE tbl_appointments set is_new = 2 , is_admin = 1 ");
					}  if(isset($_GET['data']) == 'cancelled'){
					$mysqli->query("UPDATE tbl_appointments set is_new = 2, is_admin = 1 where approved='4' OR approved='3'");
					}
					$check_balance  = $mysqli->query("SELECT * FROM tbl_signup where is_balance = '1' and id = '$user'");
					$balance        = $check_balance->fetch_assoc();
					if($balance['is_balance']==0){
				?>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addappointment">  <i class="bi bi-calendar2-plus"></i> NEW APPOINTMENT </button>
				<?php }  else {?>
				<small style="color:red">(Please Pay Balance before to set new appointments)</small>
				<?php } ?>
			</h5>
				  <?php if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> APPOINTMENT ADDED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['cancelled'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT CANCELLED <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
				  ?>
			 <?php
			  $count = $tbl_appointments->num_rows;
			  ?>
			  <b>TOTAL APPOINTMENTS : <?php echo $count;?></b>
			  <hr>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col"> SERVICE</th>
                    <th scope="col"  class="text-center">DENTIST NAME</th>
                    <th scope="col"  class="text-center"> DATE OF APPOINTMENT</th>
                    <th scope="col"  class="text-center"> TIME OF APPOINTMENT</th>
                    <th scope="col"> STATUS </th>
                    <th scope="col"> REASON </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_appointments->fetch_object()){ ?>
                  <tr>
                    <td>
					<?php 
					$services =  str_replace( array('[',']') , ''  ,$val->service_id );
					$res_ser = $mysqli->query("SELECT * FROM tbl_offer where id IN ($services)");
					while($val1 = $res_ser->fetch_object()){ 
						echo "-".$val1->service."<br>";
					}
					?>
					</td>
                    <td class="text-center"><?php echo $val->name;?></td>
                    <td class="text-center"><?php echo $val->request_date;?></td>
					<td  class="text-center"><?php echo date("g:i A", strtotime($val->request_time));?></td>
                    <td>
						<?php   
						
						$from=date_create(date('Y-m-d'));
						$to=date_create($val->request_date);
						$diff=date_diff($to,$from);
						$date1 = new DateTime($val->request_date);
						$diff1  = $date1->diff($from);				
						
						$dd = $diff->days;
													
						
						
						if($val->approved == 1){ ?>
						<?php if( $dd <= 2) { ?>
								<a href="" data-bs-toggle="modal" data-bs-target="#cancel-no<?php echo $val->id;?>"> APPROVED </a> 
						<?php } else { ?>
								<a href="" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $val->id;?>"> APPROVED </a> 
						<?php } ?>

								<?php } else if($val->approved == 1){
									echo "<font color='green'>APPROVED</a>";
								} else if($val->approved == 2){
									echo "<font color='green'>DONE</a>";
								} else if($val->approved == 3){
									echo "<font color='red'>DECLINED</font>";
								} else if($val->approved == 4){
									echo "<font color='orange'>CANCELLED</a>";
								}
						?>
					</td>
					 <td>
					 <?php 
					 if($val->approved == 4 || $val->approved == 3){
						 echo $val->cancel_reason; 
					  } ?>
					 </td>
                  </tr>
                 	<div class="modal fade" id="cancel<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">CANCEL APPOINTMENT </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">Reason : </label>
							  <textarea class="form-control" name="reason" required></textarea>
							  <input type="hidden" value="<?php echo $val->id;?>" name="id">
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							</div>
						</div>
					
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="cancel-schedule">Confirm</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
					
					<div class="modal fade" id="cancel-no<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">CANCEL APPOINTMENT </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							You are not allowed to cancel appointments.
						</div>
					
						<div class="modal-footer">
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
					</div>
				<?php } ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
	        <div class="col-lg-12">
            <div class="info">
              <div class="address">
				<h3> CONTACT US : </h3>
                <h5>Location:</h5>
                <p>
				<?php 
				$tbl_loc = $mysqli->query("SELECT * from tbl_about where page='Location'");
				$info2   = $tbl_loc->fetch_assoc();
				echo $info2['content'];
				?>
				</p>
              </div>

              <div class="email">
             
                <h5>Email:</h5>
                <p>
				<?php 
				$tbl_email = $mysqli->query("SELECT * from tbl_about where page='Email'");
				$info3     = $tbl_email->fetch_assoc();
				echo $info3['content'];
				?>
				</p>
              </div>
				<div class="email">
               
                <h5>Facebook:</h5>
                <p>
				<?php 
				$tbl_email = $mysqli->query("SELECT * from tbl_about where page='Facebook'");
				$info3     = $tbl_email->fetch_assoc();
				echo $info3['content'];
				?>
				</p>
              </div>

              <div class="phone">
              
                <h5>Call:</h5>
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
    </section>
  </main>
  
			<div class="modal " id="addappointment" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">APPOINTMENT DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST">
					  	<div class="col-md-12">
						  <label for="inputName5" class="form-label">Dentist : </label>
						  <select type="time" class="form-control" name="doc_id" id="get-doc-time" required>
						  	<option value=""> - Select Dentist -</option>
							   <?php 
							  $tbl_doctors = $mysqli->query("SELECT * FROM tbl_doctors");
							  while($doc = $tbl_doctors->fetch_object()){ ?>
								<option value="<?php echo $doc->doctor_id;?>"><?php echo $doc->name;?></option>
							  <?php } ?>
								
						  </select>
						  <div id="dc-res"> Time: </div>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Services : </label><br>
						  <?php 
						  $tbl_offer = $mysqli->query("SELECT * FROM tbl_offer");
						  while($serv = $tbl_offer->fetch_object()){ ?>
						    <input type='checkbox' name='services[]' value="<?php echo $serv->id;?>"><?php echo $serv->service;?><br>
						  <?php } ?>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Date : </label>
						  <input type="date" class="form-control" name="date" id="date_appointment" min='<?php echo date('Y-m-d', strtotime( date('Y-m-d')));?>' required>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Time : </label>
						  <select type="time" class="form-control" name="time" id="time-appointments" required>
								<option value=""> - Select Time -</option>
								<option> 8:00 AM</option>
								<option> 9:00 AM</option>
								<option> 10:00 AM</option>
								<option> 11:00 AM</option> 
								<option> 1:00 PM</option>
								<option> 2:00 PM</option>
								<option> 3:00 PM</option>
								<option> 4:00 PM</option>
								<option> 5:00 PM</option>
								<option> 6:00 PM</option>
								<option> 7:00 PM</option>
						  </select>
						</div>
						  <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="userid">
						<div class="col-12">
						   <input type="checkbox" required> I Agree to the <a href="terms.php" target="_blank"> Terms and Condition </a>
						   <div class="invalid-feedback">Agree to the Terms and Condition</div>

						</div>
					</div>
						
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="submit-schedule" style="display:none;">Process</button>
					  <div id="not-available" clas="text-center" style="display:none;"> Sorry , This Date / Time is not available! </div>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
              </div>
			  <!-- line modal -->
			<div class="modal " id="squarespaceModal"  data-backdrop="static" style="z-index:1055">
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
<?php include('footer.php');?>
