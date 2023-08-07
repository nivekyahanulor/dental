<?php include('header.php');  include('../controller/user-appointments.php');?>

  
	
      <div class="row justify-content-center">
	   <div style="height:200px;"></div>
        <div class="col-lg-6">

          <div class="card">
		  
            <div class="card-body">
			<h5 class="card-title">Terms and Condition
				
			</h5>
				
                <?php 
					$tbl_about = $mysqli->query("SELECT * from tbl_about where page='Terms and Condition'");
					$info1     = $tbl_about->fetch_assoc();
					echo $info1['content'];
			    ?>

            </div>
          </div>

        </div>
      </div>
  
<?php include('footer.php');?>
