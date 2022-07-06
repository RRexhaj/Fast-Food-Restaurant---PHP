<?php

session_start();

if(!isset($_SESSION["user"])){
  header("Location: login.php");
  exit();
}
else{
  if($_SESSION['user']['role'] == 'admin'){
    header("Location: admin");
    exit();
  }
}

include("scripts/getFillings.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UT-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">


  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Document</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Fast-Food</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a  class="nav-link dropdown-toggle" href="#" id="burgersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Burgers <span class="sr-only">(current)</span></a>
        <div class="dropdown-menu" aria-labelledby="burgersDropdown">
          <?php 
            foreach($categories["burgers"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=burger&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
      <li class="nav-item">
        <a  class="nav-link dropdown-toggle" href="#" id="pizzaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pizza</a>
        <div class="dropdown-menu" aria-labelledby="pizzaDropdown">
          <?php 
            foreach($categories["pizzas"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=pizza&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="kebabDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Kebab
        </a>
        <div class="dropdown-menu" aria-labelledby="kebabDropdown">
          <?php 
            foreach($categories["kebabs"] as $option) { 
          ?>
            <a class="dropdown-item" href="complete-filling.php?category=kebab&selection=<?php echo $option ?>"><?php echo ucfirst($option) ?></a>
          <?php
            }
          ?>
        </div>
      </li>
    </ul>
      <a href="reservations.php" class="btn btn-primary my-2 mx-2 my-sm-0" type="submit">Your Reservations</a>
      <a href="scripts/logoutHandler.php" class="btn btn-danger my-2 my-sm-0" type="submit">Logout</a>
  </div>
</nav>
<div class="container">
home
</div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</html>

