<?php
include('database.php');
$id = $_POST['id'];
$tbl_event  = $mysqli->query("SELECT * from tbl_installment where service_id='$id'");	
$response = '';
while($val = $tbl_event->fetch_object()){
        $response .= '<option value="' .$val->amount . '">' . $val->amount . '</option>';
}
echo $response;