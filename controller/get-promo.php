<?php
include('database.php');
error_reporting(0);
$id = $_POST['id'];
$tbl_event  = $mysqli->query("SELECT * from tbl_promo where service_id='$id'");	
$response = '';
while($val = $tbl_event->fetch_object()){
        $response .= '<option value="' .$val->percentage . '">' . $val->title .' - '. $val->percentage . ' %</option>';
}
echo $response;