<?php include('header.php'); include('nav.php'); include('../controller/admin-patients.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Patients </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Patients</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Patients <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addpatient">  <i class="bi bi-file-person"></i> ADD PATIENT </button></h5>
					<?php if(isset($_GET['approved'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> APPOINTMENT APPROVED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['rejected'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> APPOINTMENT REJECTED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['duplicate'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> DATA ALREADY REGISTERED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  else if(isset($_GET['registered'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> DATA ADDED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
              <!-- Table with stripped rows -->
		 	 <div id="printbar" style="float:right"></div>
			  <?php
			  $count = $tbl_signup->num_rows;
			  ?>
			  <b>TOTAL PATIENTS : <?php echo $count;?></b>
			  <hr>
              <table class="table " id="table-1">
                <thead>
                  <tr>
                    <th scope="col"> NAME OF PATIENTS </th>
                    <th scope="col"> SEX</th>
                    <th scope="col"> EMAIL</th>
                    <th scope="col"> ADDRESS </th>
                    <th scope="col"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_signup->fetch_object()){ ?>
                  <tr>
                    <td><?php echo $val->firstname .' '. $val->lastname;?></td>
                    <td><?php echo $val->sex;?></td>
                    <td><?php echo $val->email;?></td>
                    <td><?php echo $val->address;?></td>
                    <td>
					<a href="patients-records.php?data=<?php echo $val->id;?>&name=<?php echo $val->firstname .' '. $val->lastname;?>"><button class="btn btn-primary btn-sm"> <i class="bi bi-exclamation-circle"></i> View  Records</button></a>
					<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addappointment<?php echo $val->id;?>"> <i class="bi bi-plus-circle"></i> Add Transaction</button>
					</td>
                  </tr>
				  <div class="modal " id="addappointment<?php echo $val->id;?>" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">TRANSACTION DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Services : </label>
						  <select class="form-control" name="services" required>
						  <option value=""> - Select Service -</option>
						  <?php 
						  $tbl_offer = $mysqli->query("SELECT * FROM tbl_offer");
						  while($serv = $tbl_offer->fetch_object()){ ?>
							<option value="<?php echo $serv->id;?>"> <?php echo $serv->service;?></option>
						  <?php } ?>
						  </select>
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
						  <input type="hidden" value="<?php echo $val->id;?>" name="userid">
					
					</div>
						
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="submit-schedule" >Process</button>
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
  
			<div class="modal fade" id="addpatient" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PATIENT DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
					  
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">First Name : </label>
						    <input type="text" class="form-control" name="fname" required>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Last Name : </label>
						    <input type="text" class="form-control" name="lname" required>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Sex :</label>
						  <select class="form-control" name="gender" required>
							<option value=""> - Select Sex - </option>
							<option>Male</option>
							<option>Female</option>
						  </select>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Birthday  : </label>
						    <input type="date" class="form-control" name="bday" required>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Email: </label>
						  <input type="email" class="form-control" name="email" required>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Address: </label>
						  <textarea type="text" class="form-control" name="address" required></textarea>
						</div><br>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Password: </label>
						  <input type="password" class="form-control" name="password" required>
						</div><br>
					
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-patients" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
