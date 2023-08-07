<?php include('header.php'); include('nav.php'); include('../controller/admin-patients.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dental History </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dental History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Dental Record  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addservice">  <i class="bi bi-calendar2-plus"></i> ADD RECORD </button></h5>
					<?php 
						if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> RECORD DATA ADDED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> RECORD DATA UPDATED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['deleted'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> RECORD DATA DELETED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
			  <?php
			  $count = $tbl_history->num_rows;
			  ?>
			  <b>TOTAL DENTAL HISTORY : <?php echo $count;?></b>
			  <hr>
              <table class="table" id="table-4">
                <thead> 
                  <tr>
                    <th scope="col" class="text-start"> NAME OF PATIENT</th>
                    <th scope="col" class="text-center"> DATE CHECKUP</th>
                    <th scope="col" class="text-start"> FINDINGS</th>
                    <th scope="col" class="text-start"> BEFORE (IMAGE)</th>
                    <th scope="col" class="text-start"> AFTER (IMAGE)</th>
                    <th scope="col" class="text-start"> REMARKS</th>
                    <th scope="col" class="text-center"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_history->fetch_object()){ ?>
                  <tr>
                    <td class="text-start"><?php echo $val->firstname . ' ' . $val->lastname;?></td>
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
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $val->id;?>"> <i class="bi bi-pencil-square"></i></button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $val->id;?>"> <i class="bi bi-trash"></i></button>
					</td>
                  </tr>
				   <div class="modal fade done" id="edit<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">EDIT DETAILS</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						<form class="row g-3" method="POST"  enctype="multipart/form-data">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Patient Name : </label>
						   <select class="form-control" name="name" required>
							  <option value=""> - Select Name -</option>
							  <?php 
							   $tbl_signup = $mysqli->query("SELECT * FROM tbl_signup where type='patient'");
							   while($serv = $tbl_signup->fetch_object()){ 
							   if($val->user_id == $serv->id){
							   ?>
								<option value="<?php echo $serv->id;?>" selected> <?php echo $serv->firstname. ' '. $serv->lastname;?></option>
							  <?php } else {?>
								<option value="<?php echo $serv->id;?>" > <?php echo $serv->firstname. ' '. $serv->lastname;?></option>
							   <?php } } ?>
						  </select>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Date Check-up: </label>
						  <input type="date" class="form-control" name="dcu" value="<?php echo $val->dcu;?>"  required>
						  <input type="hidden" class="form-control" name="id" value="<?php echo $val->id;?>"  required>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Findings: </label>
						  <input type="text" class="form-control" name="findings" value="<?php echo $val->findings;?>"required>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Before (Photo): </label>
						  <input type="file" class="form-control" name="image" >
						  <input type="hidden" class="form-control" name="image_1"  value="<?php echo $val->before_photo;?>">
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">After (Photo): </label>
						  <input type="file" class="form-control" name="image1" >
						  <input type="hidden" class="form-control" name="image_2"  value="<?php echo $val->after_photo;?>">
						</div>
						<br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Remarks: </label>
						  <select class="form-control" name="remarks" >
						  <?php if($val->remarks =='Done'){?>
							<option selected>Done</option>
							<option>Not Finished</option>
						  <?php } else { ?>
						  <option >Done</option>
							<option selected>Not Finished</option>
						  <?php } ?>
						  </select>
						</div>
						</div>
						<div class="modal-footer">
                      <button type="submit" class="btn btn-success" id="process" name="update-record" >Update</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>	
					
					 <div class="modal fade done" id="delete<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">DELETE RECORD</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							  ARE YOU SURE TO DELETE THIS DATA ? 
							  <input type="hidden" value="<?php echo $val->id;?>" name="id" >
							</div>
							<br>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-record">Delete</button>
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
  </main>
			<div class="modal fade" id="addservice" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">DENTAL DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Patient Name : </label>
						   <select class="form-control" name="name" required>
							  <option value=""> - Select Name -</option>
							  <?php 
							  $tbl_signup = $mysqli->query("SELECT * FROM tbl_signup where type='patient'");
							   while($serv = $tbl_signup->fetch_object()){ ?>
								<option value="<?php echo $serv->id;?>"> <?php echo $serv->firstname. ' '. $serv->lastname;?></option>
							  <?php } ?>
						  </select>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Date Check-up: </label>
						  <input type="date" class="form-control" name="dcu" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Findings: </label>
						  <input type="text" class="form-control" name="findings" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Before (Photo): </label>
						  <input type="file" class="form-control" name="image" >
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">After (Photo): </label>
						  <input type="file" class="form-control" name="image1" >
						</div>
						<br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Remarks: </label>
						  <select class="form-control" name="remarks" >
							<option></option>
							<option>Done</option>
							<option>Not Finished</option>
						  </select>
						</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="add-record" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
