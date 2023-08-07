<?php
session_start();
if(!isset($_SESSION['id'])){
header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DENTAL CLINIC | ADMINISTRATOR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../page/back/img/favicon.png" rel="icon">
  <link href="../page/back/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../page/back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../page/back/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../page/back/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../page/back/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../page/back/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../page/back/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../page/back/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="../page/back/css/fullcalendar.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="../page/back/css/style.css" rel="stylesheet">
  <style>
  #table-3_filter.dataTables_filter,#table-2_filter.dataTables_filter,#table-1_filter.dataTables_filter ,#table-4_filter.dataTables_filter {
  float: left;
  margin-top: 10px;
 }
  </style>
</head>