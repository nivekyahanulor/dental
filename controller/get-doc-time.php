<?php
include('database.php');
error_reporting(0);
$id = $_POST['id'];
$tbl_event  = $mysqli->query("SELECT * from tbl_doctors where doctor_id='$id'");	
$response = '';
while($val = $tbl_event->fetch_object()){
        $response = array('time' => $val->times . ' - '. $val->timee 
		, "monday"=>$val->monday
		, "tuesday"=>$val->tuesday
		, "wednesday"=>$val->monday
		, "thursday"=>$val->thursday
		, "friday"=>$val->friday
		, "saturday"=>$val->saturday
		, "sunday"=>$val->sunday
		);
}
echo json_encode($response);