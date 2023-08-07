<?php
include('database.php');
error_reporting(0);


	
$tbl_offer = $mysqli->query("SELECT * from tbl_offer");	

if(isset($_GET['service'])){
$service = $_GET['service'];
$tbl_offer = $mysqli->query("SELECT * from tbl_installment where service_id = '$service'");	
}


if(isset($_POST['update-services'])){
	$service      = $_POST['service'];
	$id      	  = $_POST['id'];
	$price        = $_POST['price'];
	$description  = $_POST['description'];
	$logo         = $_POST['logo'];
	
	if($logo ==""){
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/services/" . $_FILES["image"]["name"]);
			$location   =  $_FILES["image"]["name"];
		} else{
			if( $_FILES["image"]["name"] == ""){
					$location = $logo;
				} else {
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name = addslashes($_FILES['image']['name']);
					$image_size = getimagesize($_FILES['image']['tmp_name']);
				    move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/services/" . $_FILES["image"]["name"]);
					$location   =  $_FILES["image"]["name"];
			}
	}
	
	$mysqli->query("UPDATE tbl_offer set service = '$service',price = '$price',description = '$description',photo = '$location' where id='$id'");
	echo "<script> window.location.href='services.php?updated'; </script>";
}

if(isset($_POST['delete-services'])){
	$id      = $_POST['id'];
	
	$mysqli->query("DELETE FROM tbl_offer  where id='$id'");
	echo "<script> window.location.href='services.php?deleted'; </script>";
}

if(isset($_POST['add-service'])){
	$service      = $_POST['service'];
	$price        = $_POST['price'];
	$description  = $_POST['description'];
	
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_FILES['image']['name']);
    $image_size = getimagesize($_FILES['image']['tmp_name']);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../page/front/services/" . $_FILES["image"]["name"]);
	$location   =  $_FILES["image"]["name"];
	
	$mysqli->query("INSERT INTO tbl_offer (service, price , description, photo) VALUES ('$service','$price','$description','$location')");
	echo "<script> window.location.href='services.php?added'; </script>";
}


if(isset($_POST['add-installment'])){
	
	$amount      = $_POST['amount'];
	$serviceid   = $_POST['serviceid'];

	
	$mysqli->query("INSERT INTO tbl_installment (service_id, amount) VALUES ('$serviceid','$amount')");
	echo "<script> window.location.href='installment.php?service=".$serviceid."'; </script>";
}


if(isset($_POST['update-installment'])){
	
	$amount      = $_POST['amount'];
	$serviceid   = $_POST['serviceid'];
	$id          = $_POST['id'];
	
	
	$mysqli->query("UPDATE tbl_installment set amount = '$amount'where installmen_id='$id'");
	echo "<script> window.location.href='installment.php?service=".$serviceid."'; </script>";
}



if(isset($_POST['delete-installment'])){
	$serviceid   = $_POST['serviceid'];
	$id          = $_POST['id'];	
	$mysqli->query("DELETE FROM tbl_installment  where installmen_id='$id'");
	echo "<script> window.location.href='installment.php?service=".$serviceid."'; </script>";
}
