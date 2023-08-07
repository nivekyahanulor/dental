<?php
include('database.php');
error_reporting(0);
$tbl_event  = $mysqli->query("SELECT * from tbl_event");	
$tbl_appointments = $mysqli->query("SELECT a.* ,b.firstname , b.lastname, b.id as user_id , c.service, c.id as service_id FROM tbl_appointments a 
									LEFT JOIN tbl_signup b on b.id = a.user_id
									LEFT JOIN tbl_offer c on a.service_id = c.id
									WHERE (a.approved ='1' or a.approved = 2 )
									");
									