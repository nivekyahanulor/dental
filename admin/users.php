<?php include('header.php'); include('nav.php'); include('../controller/admin-users.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>System Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">System Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of System Users  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">  <i class="bi bi-person-plus-fill"></i> ADD USER </button></h5>
					<?php if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> NEW USER ADDED  ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> USER INFORMATION UPDATED  ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['removed'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> USER DELETED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="text-start"> NAME  </th>
                    <th scope="col" class="text-start"> EMAIL</th>
                    <th scope="col" class="text-start"> ADDRESS</th>
                    <th scope="col" class="text-start"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_signup->fetch_object()){ ?>
                  <tr>
                    <td class="text-start"><?php echo $val->firstname .' '. $val->lastname;?></td>
                    <td class="text-start"><?php echo $val->email;?></td>
                    <td class="text-start"><?php echo $val->address;?></td>
                    <td class="text-start">
						<a href="edit-user.php?data=<?php echo $val->id;?>"><button class="btn btn-info btn-sm edit-user"><i class="bi bi-pencil"></i> Update </button></a>
						<!--<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $val->id;?>"><i class="bi bi-x"></i> Remove </button> -->
					</td>
                  </tr>
					<div class="modal fade" id="edit<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">UPDATE USER </h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">First Name : </label>
						  <input type="text" class="form-control" name="fname"  value="<?php echo $val->firstname;?>" required>
						  <input type="hidden" class="form-control" name="id"  value="<?php echo $val->id;?>" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Last Name : </label>
						  <input type="text" class="form-control" name="lname" value="<?php echo $val->lastname;?>" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Email : </label>
						  <input type="text" class="form-control" name="email" value="<?php echo $val->email;?>" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Address : </label>
						  <input type="text" class="form-control" name="address" value="<?php echo $val->address;?>" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Current Password : </label>
						 <div class="input-group mb-3 " >
						  <input type="password" class="form-control" name="cpassword" id="cpassword<?php echo $val->id ;?>" required>
						  <input type="password" class="form-control" name="ppassword" id="ppassword<?php echo $val->id ;?>" value="<?php echo $val->password;?>" style="display:none;" required>
						 <span class="input-group-text" onclick="password_show_hide();">
							  <i class="bi bi-eye" id="show_eye<?php echo $val->id ;?>"></i>
							  <i class="bi bi-eye-slash d-none" id="hide_eye<?php echo $val->id ;?>"></i>
							</span>
						</div>
						</div>
						<br>
						<div class="col-md-12" style="display:none;">
						  <label for="inputName5" class="form-label">Password : </label>
						  <input type="password" class="form-control" name="password" value="<?php echo $val->password;?>" required>
						</div>
						

						<div class="col-12">
							<div id="passres<?php echo $val->id;?>"></div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-user" id="update-user<?php echo $val->id;?>" style="display:none;">Update</button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
					</div>
					<div class="modal fade done" id="delete<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Remove User</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							ARE YOU SURE TO REMOVE USER ?
							<input type="hidden" class="form-control" name="id"  value="<?php echo $val->id;?>" required>
							
							</div>
						
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success done-schedule" name="remove-user" >Remove</button>
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
  
			<div class="modal fade" id="adduser" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">USER DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">First Name : </label>
						  <input type="text" class="form-control" name="fname" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Last Name : </label>
						  <input type="text" class="form-control" name="lname" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Email : </label>
						  <input type="text" class="form-control" name="email" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Address : </label>
						  <input type="text" class="form-control" name="address" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Password : </label>
						  <input type="password" class="form-control password" name="password" id= "" required>
						</div><br>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Confirm Password : </label>
						  <input type="password" class="form-control password1" name="password" id= "" required>
						</div><br>
						<span class='message'></span>

                    </div>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary process-add" id="process" name="add-user" style="display:none;" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
<?php include('footer.php');?>
