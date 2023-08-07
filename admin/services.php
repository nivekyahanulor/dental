<?php include('header.php'); include('nav.php'); include('../controller/admin-services.php');?>
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
              <h5 class="card-title">List of Services <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addservice">  <i class="bi bi-calendar2-plus"></i> ADD SERVICE </button></h5>
					<?php 
						if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> SERVICE DATA ADDED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> SERVICE DATA UPDATED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['deleted'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> SERVICE DATA DELETED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="text-start"> SERVICE</th>
                    <th scope="col" class="text-end"> PRICE</th>
                    <th scope="col" class="text-start"> DESCRIPTION</th>
                    <th scope="col" class="text-start"> INSTALLMENT</th>
                    <th scope="col" class="text-start"> PHOTO</th>
                    <th scope="col" class="text-center"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_offer->fetch_object()){ ?>
                  <tr>
                    <td class="text-start"><?php echo $val->service;?></td>
                    <td class="text-end"><?php echo $val->price;?></td>
                    <td class="text-start"><?php echo $val->description;?></td>
                    <td class="text-start"><a href="installment.php?service=<?php echo $val->id;?>"> view </a></td>
                    <td class="text-start"><img src="../page/front/services/<?php echo $val->photo;?>" width="200px"></td>
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $val->id;?>"> <i class="bi bi-pencil-square"></i></button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $val->id;?>"> <i class="bi bi-trash"></i></button>
					</td>
                  </tr>
				   <div class="modal fade done" id="edit<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">EDIT SERVICES</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST"  enctype="multipart/form-data">
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> Service Name : </label>
							  <input class="form-control" value="<?php echo $val->service;?>" name="service"  required>
							  <input type="hidden" value="<?php echo $val->id;?>" name="id" >
							</div>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">Price : </label>
							  <input type="text" class="form-control"  value="<?php echo $val->price;?>"  name="price" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
							</div>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">Description : </label>
							  <textarea class="form-control" name="description" required><?php echo $val->description;?></textarea>
							</div>
							
							<div class="col-md-12">
							  <label for="inputName5" class="form-label">Photo : </label>
							  <input type="file" class="form-control" name="image" >
							  <input type="hidden" class="form-control" name="logo" value="<?php echo $val->photo;?>" >
							</div>
							</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-services">Update</button>
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
						  <h5 class="modal-title">DELETE SERVICES</h5>
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
						  <button type="submit" class="btn btn-warning" name="delete-services">Delete</button>
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
                      <h5 class="modal-title">SERVICE DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Service Name : </label>
						  <input type="text" class="form-control" name="service" required>
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Price : </label>
						  <input type="text" class="form-control" name="price" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
						</div>
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Description : </label>
						  <textarea class="form-control" name="description" required></textarea>
						</div>
						
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Photo : </label>
						  <input type="file" class="form-control" name="image" required>
						</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="add-service" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
