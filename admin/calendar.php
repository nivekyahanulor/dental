<?php 
include('header.php');
 include('nav.php'); 
include('../controller/admin-events.php');
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Calendar  </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Calendar Record</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-7">

          <div class="card">
            <div class="card-body">
			 <hr>
		 <h5> Legends : </h5>
		 <p>  
		 <button style="background-color:red;withd:2px !important;" > &nbsp; &nbsp; </button> Red - Full Schedule
		      <button style="background-color:blue;" > &nbsp; &nbsp; </button> Blue - Events and Promos
			 <button  style="background-color:green;" > &nbsp; &nbsp; </button> Green - Approved Appointments</p>
        </div> 
              <h5 class="card-title"></h5>
				<div id="calendar"></div>
            </div>
			
          </div>
		
		<div class="col-lg-5">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> ADD EVENT AND PROMO</h5>
			  <?php 
						if(isset($_GET['added'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> EVENT DATA ADDED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} if(isset($_GET['updated'])){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="bi bi-check-circle me-1"></i> EVENT DATA UPDATED ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						} else if(isset($_GET['deleted'])){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-octagon me-1"></i> EVENT DATA DELETED! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
						}  
					?>
				<form class="row g-3" method="POST">
				<br>
				<div class="col-md-12">
					<label for="inputName5" class="form-label"> Title  : </label>
					<input class="form-control"  name="title"  required>
				</div>
				<div class="col-md-12">
					<label for="inputName5" class="form-label"> Description : </label>
					<textarea class="form-control"  name="description" required></textarea>
				</div>
				<div class="col-md-12">
					<input type="checkbox" name="promo" value="1" id="promo" onclick="validate()" >  Add Promo
				</div>
				<div class="col-md-12" id="promo-discount" style="display:none;">
					<label for="inputName5" class="form-label"> Discount (%)  : </label>
					<input class="form-control"  name="discount"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
				</div>
				<div class="col-md-12" id="promo-services" style="display:none;">
					<label for="inputName5" class="form-label"> Services  : </label>
						  <br>

						  <?php 
						  $tbl_offer = $mysqli->query("SELECT * FROM tbl_offer");
						  while($serv = $tbl_offer->fetch_object()){ ?>
						  <input class="form-check-input" type="checkbox" name="services[]"  value="<?php echo $serv->service;?>">
						  <label class="form-check-label" for="flexRadioDefault1">
								<?php echo $serv->service;?>
						  </label>
						  <br>
						  <?php } ?>
				</div>
				<div class="col-md-12">
					<label for="inputName5" class="form-label"> Date Start  : </label>
					<input type="date" class="form-control"  name="start"  required>
				</div>
				<div class="col-md-12">
					<label for="inputName5" class="form-label"> End Date  : </label>
					<input  type="date" class="form-control"name="end"  required>
				</div>
				 <button type="submit" class="btn btn-primary" name="add-event">ADD EVENT AND PROMO</button>
				</form>
            </div>
          </div>
		  
		  
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  EVENT AND PROMO LIST</h5>
			  <table class="table datatable responsive">
                <thead>
                  <tr>
                    <th scope="col" class="text-start"> TITLE</th>
                    <th scope="col" class="text-start"> DESCRIPTION</th>
                    <th scope="col" class="text-center"> START</th>
                    <th scope="col" class="text-center"> END</th>
                    <th scope="col" class="text-center"> ACTION </th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $tbl_event->fetch_object()){ 
				$id = $val->id;
				?>
                  <tr>
                    <td class="text-start"><?php echo $val->title;?></td>
                    <td class="text-start"><?php echo $val->description;?></td>
                    <td class="text-center"><?php echo $val->start;?></td>
                    <td class="text-center"><?php echo $val->end;?></td>
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
						  <form class="row g-3" method="POST">
							<br>
							<div class="col-md-12">
								<label for="inputName5" class="form-label"> Title  : </label>
								<input type="text"  class="form-control"  name="title" value="<?php echo $val->title;?>" required>
								<input type="hidden" class="form-control"  name="id" value="<?php echo $val->id;?>" required>
							</div><br>
							<?php if($val->is_promo ==1){?> 
							<div class="col-md-12" id="promo-discount">
								<label for="inputName5" class="form-label"> Discount (%)  : </label>
								<input class="form-control"  name="discount" value="<?php echo $val->discount;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
							</div>
							<div class="col-md-12" id="promo-services">
								<label for="inputName5" class="form-label"> Services  : </label>
								<br>
								
									  <?php 
									  	$services1 =  str_replace( array('[',']') , ''  ,$val->services );
										$res_ser = $mysqli->query("SELECT * FROM tbl_offer where service IN ($services1)");
										while($val1 = $res_ser->fetch_object()){ ?>
											<input type='checkbox' checked  name='service[]' value="<?php echo $val1->service;?>"><?php echo $val1->service;?><br>
										<?php
										}
										$res_ser1 = $mysqli->query("SELECT * FROM tbl_offer where service NOT IN ($services1)");
										while($val11 = $res_ser1->fetch_object()){ ?>
											<input type='checkbox' name='service[]' value="<?php echo $val11->service;?>"><?php echo $val11->service;?><br>
										<?php
										}
										?>
									
							</div><br>
							<?php } ?>
							<div class="col-md-12">
								<label for="inputName5" class="form-label"> Description : </label>
								<textarea class="form-control"  name="description" required><?php echo $val->description;?></textarea>
							</div><br>
							<div class="col-md-12">
								<label for="inputName5" class="form-label"> Date Start  : </label>
								<input type="date" class="form-control"  name="start" value="<?php echo $val->start;?>" required>
							</div><br>
							<div class="col-md-12">
								<label for="inputName5" class="form-label"> End Date  : </label>
								<input  type="date" class="form-control"name="end" value="<?php echo $val->end;?>" required>
							</div>
							<br>
						</div>
						
						<div class="modal-footer">
						  <button type="submit" class="btn btn-success" name="update-event">Update</button>
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
						  <button type="submit" class="btn btn-warning" name="delete-event">Delete</button>
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
