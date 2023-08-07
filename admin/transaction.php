<?php include('header.php'); include('nav.php'); include('../controller/admin-appointments.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Transaction</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Transaction</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Transaction </h5>
					<?php if(isset($_GET['approved'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> APPOINTMENT APPROVED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['rejected'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT DECLINED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  else if(isset($_GET['cancelled'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT CANCELLED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}   else if(isset($_GET['restored'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT RESTORED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
			  $count = $tbl_appointments->num_rows;
			  ?>
			  <b>TOTAL TRANSACTION : <?php echo $count;?></b>
			  <hr>
              <table class="table datatable" id="table-3">
                <thead>
                  <tr>
                    <th scope="col" class="text-center"> TRANSACTION NO. </th>
                    <th scope="col" class="text-start"> NAME OF PATIENTS </th>
                    <th scope="col" class="text-start"> SERVICE</th>
					
                    <th scope="col" class="text-center"> DATE OF APPOINTMENT</th>
                    <th scope="col" class="text-center"> TIME OF APPOINTMENT</th>
					<?php if($_GET['data']=='cancelled' || $_GET['data']=='declined'){?>
						<th scope="col" class="text-start"> REASON </th>
					<?php } ?>
						<?php if($_GET['data'] != 'done' && $_GET['data'] !='declined' && $_GET['data'] !='approved'){?>
						<th scope="col" class="text-center"> ACTION </th>
					<?php } ?>
                  </tr>
                </thead>
                <tbody>
				<?php 
				$count = 1;
				while($val = $tbl_appointments->fetch_object()){ 
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
					$totalprice = 0;
					$res_ser = $mysqli->query("SELECT * FROM tbl_offer where id IN ($services)");
					while($val1 = $res_ser->fetch_object()){ 
						echo "-".$val1->service."<br>";
						$totalprice += $val1->price;
					}
					?>
					</td>
				
                    <td class="text-center"><?php echo $val->request_date;?></td>
                    <td class="text-center"><?php echo date("g:i A", strtotime($val->request_time));?></td>
					<?php if($_GET['data']=='cancelled' || $_GET['data']=='declined'){?>
						<td class="text-start"><?php echo $val->cancel_reason;?></td>
					<?php } ?>
					<?php if($_GET['data'] != 'done' && $_GET['data'] !='declined'&& $_GET['data'] !='approved'){?>
                    <td class="text-center">
					<?php if($_GET['data'] == 'pending'){?>
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#approve<?php echo $val->id;?>"><i class="bi bi-check"></i> Approve </button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reject<?php echo $val->id;?>"><i class="bi bi-x"></i> Decline </button> 
					<?php } else if($_GET['data'] == 'transaction'){?>
						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#done<?php echo $val->id;?>" data-id="<?php echo $val->id;?>"><i class="bi bi-check"></i> Make Payment </button>
						<!--<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $val->id;?>"><i class="bi bi-x"></i> Cancel </button> -->
					<?php } else if($_GET['data'] == 'cancelled'){?>
						<!--<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#restore<?php echo $val->id;?>" data-id="<?php echo $val->id;?>"><i class="bi bi-check"></i>Restore</button>-->
					<?php } else { ?>
					<?php } ?>
					</td>
					<?php } ?>
				
                  </tr>
				  <div class="modal fade" id="restore<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">RESTORE APPOINTMENT </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<div class="col-md-12">
								<br>
								ARE YOU SURE TO RESTORE THIS APPOINTMENT? 
							  <input type="hidden" value="<?php echo $val->id;?>" name="id">
							  <input type="hidden" value="<?php echo $val->email;?>" name="email">
							  <input type="hidden" value="<?php echo $val->firstname .' '. $val->lastname;?>" name="name">
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="restore-schedule">Restore </button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
				  	<div class="modal fade" id="cancel<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">CANCEL TRANSACTION </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<div class="col-md-12">
								<br>
							  
							 REASON : 
							 
							   <textarea class="form-control"  name="reason"></textarea> 
							  <input type="hidden" value="<?php echo $val->id;?>" name="id">
							  <input type="hidden" value="<?php echo $val->email;?>" name="email">
							  <input type="hidden" value="<?php echo $val->firstname .' '. $val->lastname;?>" name="name">
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="cancel-schedule">Confirm </button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
				  	<div class="modal fade" id="reject<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">DECLINE APPOINTMENT </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<div class="col-md-12">
								<br>
							  
							 REASON : 
							 
							   <textarea class="form-control"  name="reason"></textarea> 
							  <input type="hidden" value="<?php echo $val->id;?>" name="id">
							  <input type="hidden" value="<?php echo $val->email;?>" name="email">
							  <input type="hidden" value="<?php echo $val->firstname .' '. $val->lastname;?>" name="name">
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="reject-schedule">Decline</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
					<div class="modal fade" id="approve<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">APPROVE APPOINTMENT </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							ARE YOU SURE TO APPROVE THIS APPOINTMENT ?
							<div class="col-md-12">
							  <input type="hidden" value="<?php echo $val->id;?>" name="id">
							  <input type="hidden" value="<?php echo $val->email;?>" name="email">
							  <input type="hidden" value="<?php echo $val->firstname .' '. $val->lastname;?>" name="name">
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="approve-schedule">Approve</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
					<div class="modal fade done" id="done<?php echo $val->id;?>" tabindex="-1">
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
							  <input class="form-control service-charge<?php echo $val->id;?>" value="<?php echo  $totalprice;;?>" name="charge" id="service-charge<?php echo $val->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly required>
							  <input type="hidden" value="<?php echo $val->id;?>" name="id" id="app-id">
							  <input type="hidden" value="<?php echo $val->user_id;?>" name="user_id">
							  <textarea name="service_id" hidden> <?php echo $val->s_id;?></textarea>
							 
							  <input type="hidden" value="<?php echo date('Y-m-d');?>" name="date">
							  <input type="hidden" value="<?php echo $_SESSION['name'];?>" name="name">
							  <input type="hidden" name="balance" class="balance">
							</div>
							<br>
							<div class="col-md-12">
								<input type="checkbox"  name="is_installment" value="1" id="is_installments<?php echo $val->id;?>" onclick="validates(<?php echo $val->id;?>)" >  Is Installment ?
							</div>
							<div class="yes_installment<?php echo $val->id;?>" style="display:none;">
							  <label for="inputName5" class="form-label"> Installment Monthly : </label>
								<select class="form-control" name="installment" >
								  <option value=""> - Select Installment -</option>
								  <?php 
								  $tbl_offer = $mysqli->query("SELECT * FROM tbl_installment where service_id IN ($services)");
								  while($serv = $tbl_offer->fetch_object()){ ?>
									<option value="<?php echo $serv->amount;?>"> <?php echo $serv->amount;?></option>
								  <?php } ?>
								  </select>
								</div>
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> Promo : </label>
							 
								<select class="form-control" name="promo" id="promos<?php echo $val->id;?>" data-id="<?php echo $val->id;?>"  >
								  <option value=""> - Select Promo -</option>
								  <?php 
								  $tbl_offer = $mysqli->query("SELECT a.* ,b.*FROM tbl_promo a left join tbl_offer b on a.service_id  = b.service where b.id  IN ($services)");
								  while($serv = $tbl_offer->fetch_object()){ ?>
								  <option value="<?php echo $serv->percentage;?>"> <?php echo $serv->service .' | '. $serv->title .' - '.$serv->percentage;?>%</option>
								  <?php } ?>
								  </select>
							</div>
							<br>
							<div class="col-md-12" id="ppay<?php echo $val->id;?>">
							  <label for="inputName5" class="form-label"> Patient's Payment : </label>
							  <input class="form-control customer-payment" name="payment" data-id="<?php echo $val->id;?>" id="customer-payment<?php echo $val->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  required>
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
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
<?php include('footer.php');?>
