<?php include('header.php'); include('nav.php'); include('../controller/admin-appointments.php');?>
  <main id="main" class="main">
	<?php
	if(isset($_GET['data']) == 'pending'){
	$mysqli->query("UPDATE tbl_appointments set is_new = 1 where approved='0'");
	}  if(isset($_GET['data']) == 'cancelled'){
	$mysqli->query("UPDATE tbl_appointments set is_new = 1 where approved='4'");
	}
	?>
    <div class="pagetitle">
      <h1>Appointments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Appointments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Appointments (<?php echo ucfirst($_GET['data']);?>)</h5>
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
							<button type="submit" class="btn btn-primary" name="filter-appointments"><i class="bi bi-filter-circle"></i> Filter Date </button>
							</div>
					</form>
			  <br>
			  <div id="printbar" style="float:right"></div>
			  <br>
			  <?php
			  $count = $tbl_appointments->num_rows;
			  ?>
			  <b>TOTAL <?php echo strtoupper($_GET['data']);?> : <?php echo $count;?></b>
			  <hr>
              <table class="table " id="table-3">
                <thead>
                  <tr>
                    <th scope="col" class="text-center"> TRANSACTION NO. </th>
                    <th scope="col" class="text-start"> NAME OF PATIENTS </th>
                    <th scope="col" class="text-start"> NAME OF DENTIST </th>
                    <th scope="col" class="text-start"> SERVICE</th>
					
                    <th scope="col" class="text-center"> DATE OF APPOINTMENT</th>
                    <th scope="col" class="text-center"> TIME OF APPOINTMENT</th>
					<?php if($_GET['data']=='cancelled' || $_GET['data']=='declined'){?>
						<th scope="col" class="text-start"> REASON </th>
					<?php } ?>
						<?php if($_GET['data'] != 'done' && $_GET['data'] !='declined' && $_GET['data'] !='cancelled'){?>
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
                    <td class="text-center"><?php echo $val->name;?></td>
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
					<?php if($_GET['data']=='cancelled' || $_GET['data']=='declined'){?>
						<td class="text-text"><?php echo $val->cancel_reason;?></td>
					<?php } ?>
					<?php if($_GET['data'] != 'done' && $_GET['data'] !='declined' && $_GET['data'] !='cancelled'){?>
                    <td class="text-center">
					<?php if($_GET['data'] == 'approved'){?>
						<!--<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#approve<?php echo $val->id;?>"><i class="bi bi-check"></i> Approve </button>-->
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reject<?php echo $val->id;?>"><i class="bi bi-x"></i> Decline </button> 
					<?php } else if($_GET['data'] == 'transaction'){?>
						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#done<?php echo $val->id;?>" data-id="<?php echo $val->id;?>"><i class="bi bi-check"></i> Make Payment </button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cancel<?php echo $val->id;?>"><i class="bi bi-x"></i> Cancel </button> 
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
						  <h5 class="modal-title">CANCEL APPOINTMENT </h5>
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
						  <button type="submit" class="btn btn-warning" name="cancel-schedule">Cancel </button>
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
								<b>PATIENTS NAME : <?php echo $val->firstname .' '. $val->lastname;?></b>
								<br>
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
