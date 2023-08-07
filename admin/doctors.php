<?php include('header.php'); include('nav.php'); include('../controller/admin-doctors.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dentist </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dentist</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Dentist <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addservice">  <i class="bi bi-calendar2-plus"></i> ADD DENTIST </button></h5>
					<?php 
						if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> DOCTOR DATA ADDED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> DOCTOR DATA UPDATED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['deleted'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> DOCTOR DATA DELETED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="text-start"> NAME</th>
                    <th scope="col" class="text-start"> TIME</th>
                    <th scope="col" class="text-start"> DETAILS</th>
                    <th scope="col" class="text-start"> DAY OFF</th>
                    <th scope="col" class="text-start"> PHOTO</th>
                    <th scope="col" class="text-center"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_doctors->fetch_object()){ ?>
                  <tr>
                    <td class="text-start"><a href="doctor-appointments.php?id=<?php echo $val->doctor_id;?>&name=<?php echo $val->name;?>"><?php echo $val->name;?></a></td>
                    <td class="text-start"><?php echo $val->times .' - ' .  $val->timee;?></td>
                    <td class="text-start"><?php echo $val->details ;?></td>
                    <td class="text-start">
						<?php 
						if($val->monday == 1) { echo "Monday <br>";}
						if($val->tuesday == 1) { echo "Tuesday <br>";}
						if($val->wednesday == 1) { echo "Wednesday <br>";}
						if($val->thursday == 1) { echo "Thursday <br>";}
						if($val->friday == 1) { echo "Friday <br>";}
						if($val->saturday == 1) { echo "Saturday<br>";}
						if($val->sunday == 1) { echo "Sunday <br>";}
						?>
					</td>
                    <td class="text-start"><img src="../page/front/doctor/<?php echo $val->photo;?>" width="200px"></td>
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $val->doctor_id;?>"> <i class="bi bi-pencil-square"></i></button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $val->doctor_id;?>"> <i class="bi bi-trash"></i></button>
					</td>
                  </tr>
				   <div class="modal fade done" id="edit<?php echo $val->doctor_id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">EDIT DOCTOR</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST"  enctype="multipart/form-data">
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">  Name : </label>
							  <input class="form-control" value="<?php echo $val->name;?>" name="name"  required>
							  <input type="hidden" value="<?php echo $val->doctor_id;?>" name="id" >
							</div>
							
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Time Start : </label>
						  <select type="time" class="form-control" name="times" required>
								<option value=""> - Select Time -</option>
								<option <?php if($val->times =='8:00 AM') { echo "selected"; } else {}?> > 8:00 AM</option>
								<option <?php if($val->times =='9:00 AM') { echo "selected"; } else {}?> > 9:00 AM</option>
								<option <?php if($val->times =='10:00 AM') { echo "selected"; } else {}?> > 10:00 AM</option>
								<option <?php if($val->times =='11:00 AM') { echo "selected"; } else {}?> > 11:00 AM</option> 
								<option <?php if($val->times =='1:00 PM') { echo "selected"; } else {}?> > 1:00 PM</option>
								<option <?php if($val->times =='2:00 PM') { echo "selected"; } else {}?> > 2:00 PM</option>
								<option <?php if($val->times =='3:00 PM') { echo "selected"; } else {}?> > 3:00 PM</option>
								<option <?php if($val->times =='4:00 PM') { echo "selected"; } else {}?> > 4:00 PM</option>
								<option <?php if($val->times =='5:00 PM') { echo "selected"; } else {}?> > 5:00 PM</option>
								<option <?php if($val->times =='6:00 PM') { echo "selected"; } else {}?> > 6:00 PM</option>
								<option <?php if($val->times =='7:00 PM') { echo "selected"; } else {}?> > 7:00 PM</option>
						  </select>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Time End : </label>
						 <select type="time" class="form-control" name="timee" required>
								<option value=""> - Select Time -</option>
								<option <?php if($val->timee =='8:00 AM') { echo "selected"; } else {}?> > 8:00 AM</option>
								<option <?php if($val->timee =='9:00 AM') { echo "selected"; } else {}?> > 9:00 AM</option>
								<option <?php if($val->timee =='10:00 AM') { echo "selected"; } else {}?> > 10:00 AM</option>
								<option <?php if($val->timee =='11:00 AM') { echo "selected"; } else {}?> > 11:00 AM</option> 
								<option <?php if($val->timee =='1:00 PM') { echo "selected"; } else {}?> > 1:00 PM</option>
								<option <?php if($val->timee =='2:00 PM') { echo "selected"; } else {}?> > 2:00 PM</option>
								<option <?php if($val->timee =='3:00 PM') { echo "selected"; } else {}?> > 3:00 PM</option>
								<option <?php if($val->timee =='4:00 PM') { echo "selected"; } else {}?> > 4:00 PM</option>
								<option <?php if($val->timee =='5:00 PM') { echo "selected"; } else {}?> > 5:00 PM</option>
								<option <?php if($val->timee =='6:00 PM') { echo "selected"; } else {}?> > 6:00 PM</option>
								<option <?php if($val->timee =='7:00 PM') { echo "selected"; } else {}?> > 7:00 PM</option>
						  </select>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Dentist Details : </label>
						  <textarea type="text" class="form-control" name="details" required><?php echo $val->details;?></textarea>
						</div>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">Photo : </label>
							  <input type="file" class="form-control" name="image" >
							  <input type="hidden" class="form-control" name="logo" value="<?php echo $val->photo;?>" >
							</div>
							
							<div class="col-md-12">
								  <label for="inputName5" class="form-label">Day Off : </label><br>
								  <input type="checkbox" class="" name="monday" <?php if($val->monday == 1){ echo "checked";} else {}?> value="1"> Monday<br>
								  <input type="checkbox" class="" name="tuesday" <?php if($val->tuesday == 1){ echo "checked";} else {}?> value="1"> Tuesday<br>
								  <input type="checkbox" class="" name="wednesday" <?php if($val->wednesday == 1){ echo "checked";} else {}?> value="1"> Wednesday<br>
								  <input type="checkbox" class="" name="thursday" <?php if($val->thursday == 1){ echo "checked";} else {}?> value="1"> Thursday<br>
								  <input type="checkbox" class="" name="friday" <?php if($val->friday == 1){ echo "checked";} else {}?> value="1"> Friday<br>
								  <input type="checkbox" class="" name="saturday" <?php if($val->saturday == 1){ echo "checked";} else {}?> value="1"> Saturday<br>
								  <input type="checkbox" class="" name="sunday" <?php if($val->sunday == 1){ echo "checked";} else {}?>  value="1"> Sunday <br>
							</div>
							</div>
							
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-doctor">Update</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>	
					
					 <div class="modal fade done" id="delete<?php echo $val->doctor_id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">DELETE DOCTOR</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							  ARE YOU SURE TO DELETE THIS DATA ? 
							  <input type="hidden" value="<?php echo $val->doctor_id;?>" name="id" >
							</div>
							<br>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-doctor">Delete</button>
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
                      <h5 class="modal-title">DOCTOR DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Dentist Name : </label>
						  <input type="text" class="form-control" name="name" required>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Time Start : </label>
						  <select type="time" class="form-control" name="times" required>
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
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Time End : </label>
						 <select type="time" class="form-control" name="timee" required>
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
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Dentist Details : </label>
						  <textarea type="text" class="form-control" name="details" required></textarea>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Photo : </label>
						  <input type="file" class="form-control" name="image" required>
						</div>
						<div class="col-md-12">
							  <label for="inputName5" class="form-label">Day Off : </label><br>
							  <input type="checkbox" class="" name="monday" value="1"> Monday<br>
							  <input type="checkbox" class="" name="tuesday" value="1"> Tuesday<br>
							  <input type="checkbox" class="" name="wednesday" value="1"> Wednesday<br>
							  <input type="checkbox" class="" name="thursday" value="1"> Thursday<br>
							  <input type="checkbox" class="" name="friday" value="1"> Friday<br>
							  <input type="checkbox" class="" name="saturday" value="1"> Saturday<br>
							  <input type="checkbox" class="" name="sunday" value="1"> Sunday <br>
						</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="add-doctor" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
