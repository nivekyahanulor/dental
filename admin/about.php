<?php include('header.php'); include('nav.php'); include('../controller/admin-about.php');?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>About Information </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">About</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Services </h5>
					<?php 
						 if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> INFORMATION DATA UPDATED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} 
					?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="text-start"> PAGE</th>
                    <th scope="col" class="text-start"> CONTENT </th>
                    <th scope="col" class="text-start"> CONTENT </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_about->fetch_object()){ ?>
                  <tr>
                    <td class="text-start"><?php echo $val->page;?></td>
                    <td class="text-start"><?php echo $val->content;?></td>
                    <td class="text-start">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $val->about_id;?>"> <i class="bi bi-pencil-square"></i></button>
					</td>
                  </tr>
				   <div class="modal fade done" id="edit<?php echo $val->about_id;?>" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">EDIT INFORMATION</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
							  <label for="inputName5" class="form-label"> Information  : </label>
							  <textarea class="form-control" value="" name="information"  required><?php echo $val->content;?></textarea>
							  <input type="hidden" value="<?php echo $val->about_id;?>" name="about_id" >
							</div>
							<br>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-information">Update</button>
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
        
<?php include('footer.php');?>
