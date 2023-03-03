<?php
session_start();
include('includes/linkdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <?php
  include('includes/header.php');
 ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

   <?php include('includes/nav.php'); ?>

  </header><!-- End Header -->


  <main id="main" class="main">
 
  <div class="container d-flex h-100" style="justify-content:center;flex-direction:column;">
  <h2 class="align-items-center" style="text-align:center;">cloud computing</h2>  
  <div class="row align-self-center">
    <img src="assets\img\cloud.png" alt="cloud">
    </div>
   
  </main><!-- End #main -->
    
 <?php include('includes/footer.php'); ?>

  <?php include('includes/script.php'); ?>

</body>

</html>