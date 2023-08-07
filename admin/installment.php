<?php include('header.php'); include('nav.php'); include('../controller/admin-services.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Installment </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Installment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Services Installment <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addservice">  <i class="bi bi-calendar2-plus"></i> ADD INSTALLMENT </button></h5>
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
                    <th scope="col" class="text-center"> AMOUNT</th>
                    <th scope="col" class="text-center"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_offer->fetch_object()){ ?>
                  <tr>
                    <td class="text-center"><?php echo $val->amount;?></td>
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $val->id;?>"> <i class="bi bi-pencil-square"></i></button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?php echo $val->id;?>"> <i class="bi bi-trash"></i></button>
					</td>
                  </tr>
				   <div class="modal fade done" id="edit<?php echo $val->id ;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">EDIT INSTALLMENT</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST"  enctype="multipart/form-data">
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> AMOUNT : </label>
							  <input class="form-control" value="<?php echo $val->amount;?>" name="amount"  required>
							  <input type="hidden" value="<?php echo $val->installmen_id ;?>" name="id" >
							  <input type="hidden" class="form-control" name="serviceid" value="<?php echo $_GET['service'];?>" required>
							</div>
						
							</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-installment">Update</button>
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
						  <h5 class="modal-title">DELETE INSTALLMENT</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							  ARE YOU SURE TO DELETE THIS DATA ? 
							  <input type="hidden" value="<?php echo $val->installmen_id;?>" name="id" >
							  <input type="hidden" class="form-control" name="serviceid" value="<?php echo $_GET['service'];?>" required>
							</div>
							<br>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-installment">Delete</button>
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
                      <h5 class="modal-title">INSTALLMENT DETAILS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" method="POST"  enctype="multipart/form-data">
						<div class="col-md-12">
						  <label for="inputName5" class="form-label">Amount  : </label>
						  <input type="text" class="form-control" name="amount" required>
						  <input type="hidden" class="form-control" name="serviceid" value="<?php echo $_GET['service'];?>" required>
						</div>
					
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="process" name="add-installment" >Add</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
             </div>
			  
<?php include('footer.php');?>
