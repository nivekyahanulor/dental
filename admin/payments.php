<?php include('header.php'); include('nav.php'); include('../controller/admin-payments.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Payments </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="payments.php">Payments</a></li>
          <li class="breadcrumb-item active"><?php echo strtoupper($_GET['data']);?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Payments 
			  <?php if($_GET['data'] =='record'){?>
				<!--<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addpayment">  <i class="bi bi-cash"></i> ADD PAYMENT </button>-->
			  <?php } ?>
			  </h5>
					<?php if(isset($_GET['approved'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> APPOINTMENT APPROVED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['rejected'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT REJECTED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
					<form class="row g-3" method="post">
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date From: </label>
							   <input type="date" class="form-control" name="datefrom"  value="<?php echo $_POST['datefrom'];?>" required>
							</div>
							<div class="col-4">
							  <label for="inputNanme4" class="form-label">Date End: </label>
							 <input type="date" class="form-control" name="dateend" value="<?php echo $_POST['dateend'];?>" required>
							</div>
							<div class="col-4">
							<div style="height:30px;"></div>
							<button type="submit" class="btn btn-primary" name="filter-appointments"><i class="bi bi-filter-circle"></i> Filter Date</button>
							</div>
					</form>
					<br>
		 	    <div id="printbar" style="float:right"></div>
				<?php
				  $count = $tbl_payment->num_rows;
				  ?>
				  <b>TOTAL PAYMENTS : <?php echo $count;?></b>
				  <hr>
				<table class="table" id="table-2">
                <thead>
                  <tr>
                    <th scope="col" class="text-center"> TRANSACTION NO. </th>
                    <th scope="col" class="text-start"> NAME OF PATIENT  </th>
                    <th scope="col" class="text-start"> SERVICE</th>
					<?php if($_GET['data'] =='record'){?>
						<th scope="col" class="text-end">  CHARGE (₱) </th>
                    <th scope="col" class="text-end">  AMOUNT (₱)</th>
					 <?php } else { ?>
                    <th scope="col" class="text-end">  PAY AMOUNT (₱)</th>
					 <?php } ?>
                    <th scope="col" class="text-end"> INSTALLMENT(₱) </th>
                    <th scope="col" class="text-start"> TRANSACTION </th>
					<?php if($_GET['data'] =='record'){?>
                    <th scope="col" class="text-end"> BALANCE (₱)</th>
					<?php } ?>
                    <th scope="col" class="text-center">  DATE  </th>
                    <th scope="col" class="text-start">  ADMIN NAME  </th>
					<?php if($_GET['data'] =='balance'){?>
                    <th scope="col" class="text-center"> ACTION </th>
					<?php } ?>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_payment->fetch_object()){ ?>
                  <tr>
                    <td class="text-center"><?php echo $val->id;?></td>
					<?php if($_GET['data'] =='record'){?>
                    <td class="text-start"><?php echo $val->firstname .' '. $val->lastname;?></td>
					<?php } else {?>
				    <td class="text-start"><a href="patients-records.php?data=<?php echo $val->user_id;?>&name=<?php echo $val->firstname .' '. $val->lastname;?>&click" target="_blank"><?php echo $val->firstname .' '. $val->lastname;?></a></td>
					<?php } ?>
				    <td class="text-start">
							<?php 
							$services1 =  str_replace( array('[',']') , ''  ,$val->s_id );
							$res_ser = $mysqli->query("SELECT * FROM tbl_offer where id IN ($services1)");
							while($val1 = $res_ser->fetch_object()){ 
								echo "-".$val1->service."<br>";
							}
							?>
					</td>
					<?php if($_GET['data'] =='record'){?>
                    <td class="text-end">₱ <?php echo number_format($val->service_charge,2);?></td>
					<?php } ?>
                    <td class="text-end">₱ <?php echo number_format($val->pay_amount,2);?></td>
                    <td class="text-end"> <?php if($val->installment!=""){ echo "₱ ". number_format($val->installment,2);} else { echo  "Not Installment";}?></td>
                    <td class="text-start"><?php echo $val->payment_status;?></td>
					<?php if($_GET['data'] =='record'){?>
                    <td class="text-end">₱ <?php if($val->balance !=0){echo number_format($val->balance,2);} else { echo number_format(0,2);}?></td>
					<?php } ?>
                    <td class="text-center"><?php echo  date('Y-m-d', strtotime($val->date_added));?></td>
                    <td class="text-start"><?php echo $val->admin_name;?></td>
					<?php if($_GET['data'] =='balance'){?>
					<td class="text-center">
					<?php if($val->balance !=0 && $val->is_paid!=1){?>
						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#done<?php echo $val->id;?>"> <i class="bi bi-check"></i> Make Payment </button>
					<?php } ?>
					</td>
					<?php } ?>
                  </tr>
				 <div class="modal fade done" id="done<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">PAYMENT</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> Service Charge : </label>
							  <input class="form-control service-charge<?php echo $val->id;?>" value="<?php echo $val->balance;?>" name="charge" id="service-charge<?php echo $val->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  readonly required>
							  <input type="hidden" value="<?php echo $val->id;?>" name="id" id="app-id">
							  <input type="hidden" value="<?php echo $val->user_id;?>" name="user_id">
							  <textarea  name="service_id" hidden><?php echo $val->s_id;?></textarea>
							  <input type="hidden" value="<?php echo $val->installment;?>" name="installment">
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							  <input type="hidden" value="<?php echo $_SESSION['name'];?>" name="name">
							  <input type="hidden" name="balance" class="balance">
							</div>
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> Patient's Payment : </label>
							  <input class="form-control customer-payment2" name="payment" data-id="<?php echo $val->id;?>" id="customer-payment" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  required>
							</div>
							<br><br>
							<div class="col-md-12">
							  <div class="payment-result"></div>
							</div>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success done-schedule" name="done-schedule" style="display:none;">PROCESS</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
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
    </section>
  </main><!-- End #main -->
			<div class="modal fade" id="addpayment" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PAYMENT DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
					  
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Patient Name : </label>
						   <select class="form-control" name="user_id" required>
							  <option value=""> - Select Name -</option>
							  <?php 
							  $tbl_signup = $mysqli->query("SELECT * FROM tbl_signup where type='patient'");
							   while($serv = $tbl_signup->fetch_object()){ ?>
								<option value="<?php echo $serv->id;?>"> <?php echo $serv->firstname. ' '. $serv->lastname;?></option>
							  <?php } ?>
						  </select>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Service  : </label>
						   <select class="form-control" name="service_id" id="service_id" required>
							  <option value=""> - Select Service -</option>
							  <?php 
							  $tbl_signup = $mysqli->query("SELECT * FROM tbl_offer");
							   while($serv = $tbl_signup->fetch_object()){ ?>
								<option value="<?php echo $serv->id;?>"> <?php echo $serv->service;?></option>
							  <?php } ?>
						  </select>
						</div><br>
						
					
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Service Charge: </label>
						   <input class="form-control" id="service-fee" name="charge"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  required>
						</div><br>
						
							<div class="col-md-12" id="inss" style="display:none;">
								<input type="checkbox"  name="is_installment" value="1" id="is_installments" onclick="validates2(<?php echo $val->id;?>)" >  Is Installment ?
							</div>
							<div class="col-md-12" id="yes_installment1" style="display:none;">
							  <label for="inputName5" class="form-label"> Installment Monthly : </label>
								  <select class="form-control" name="installment" id="res_installment" >
								  </select>
								</div>
							<br>
							<div class="col-md-12" id="pro">
							  <label for="inputName5" class="form-label"> Promo : </label>
								<select class="form-control" name="promo" id="res_promos" data-id="<?php echo $val->id;?>"  >
								</select>
							</div>
							<br>
						<div class="col-md-12" id="payres">
						  <label for="inputName5" class="form-label">Patient's Payment: </label>
							 <input class="form-control customer-payment1" name="payment"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  >
						</div><br>
						<div class="col-md-12">
							  <div class="payment-result1"></div>
							  <input type="hidden" name="balance" class="balance1">
						</div>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Date: </label>
						  <input type="date" class="form-control" name="date" required>
						</div><br>
					
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary process-pay" name="add-payment" >Process</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
