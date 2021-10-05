<!DOCTYPE html>
<html lang="en">
  
  <!-- Here it cotains all the necessary links and scripts -->
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS 
         For using of various fonts and icons in the website     -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Student Testimonial Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/owl.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/testyslider.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
   
    <title>GoWise</title>
  </head>
  <body>
     <!-- Start Nagigation -->
      <!--(navbar-dark means background of the navbar is set to dark)
          (Pl-5 means Padding Left of 5) 
          (Fixed-top is for when we scroll the page navbar will be fixed on his position)  -->   
     <nav class="navbar navbar-expand-sm navbar-dark pl-5 fixed-top"> 
      <a href="index.php" class="navbar-brand">LearnerPath</a> <!-- For Logo or Name beside the navbar-->
      <span class="navbar-text">Learn and Implement</span> <!--Tag line -->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="myMenu">
        <ul class="navbar-nav pl-5 custom-nav">
          <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item custom-nav-item"><a href="courses.php" class="nav-link">Courses</a></li>
          <li class="nav-item custom-nav-item"><a href="paymentstatus.php" class="nav-link">Payment Status</a></li>
         
         <?php 
         // Here if the user session is logged in i.e. True then 
              session_start();   
              if (isset($_SESSION['is_login']))
              { // only my profile and logout option will show on navbar
                echo '<li class="nav-item custom-nav-item"><a href="Student/studentProfile.php" class="nav-link">My Profile</a></li>
                      <li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
              } 
              else 
              { // Otherwise if not logged in then Login and signup will show on navbar
                echo '<li class="nav-item custom-nav-item"><a href="#login" class="nav-link" data-toggle="modal" data-target="#stuLoginModalCenter">Login</a></li> 
                      <li class="nav-item custom-nav-item"><a href="#signup" class="nav-link" data-toggle="modal" data-target="#stuRegModalCenter">Signup</a></li>';
              }
          ?> 
          <li class="nav-item custom-nav-item"><a href="#Feedback" class="nav-link">Feedback</a></li>
          <li class="nav-item custom-nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </nav> 
    <!-- End Navigation -->
