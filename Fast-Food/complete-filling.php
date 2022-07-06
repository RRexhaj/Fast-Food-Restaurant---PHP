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
      <a href="scripts/logoutHandler.php" class="btn btn-danger my-2 mx-2 my-sm-0" type="submit">Logout</a>
  </div>
</nav>
<div class="container">
<form method="POST" action="scripts/handleFiiling.php" >


  <?php if($_GET['category'] == 'pizza'){ ?>
    <div class="form-group col-md-4">
        <label for="cheese">Cheese</label>
        <select id="cheese" name="cheese" class="form-control" required>
          <option value="no-cheese">No Cheese</option>
          <option value="mozzarella">Mozzarella</option>
          <option value="cheddar">Cheddar</option>
          <option value="philadelphia">Philadelphia</option>
        </select>
      </div>
        <div class="form-group col-md-4">
        <label for="crust">Crust</label>
        <select id="crust" name="crust" class="form-control">
          <option value="thin">Thin Crust</option>
          <option value="thick">Thick Crust</option>
        </select>
      </div>
      <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios1" value="1" checked>
            <label class="form-check-label" for="gridRadios1">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios2" value="0">
            <label class="form-check-label" for="gridRadios2">
              No
            </label>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit-pizza">Order Now</button>
      </div>
    </div>
  <?php }else if($_GET["category"] == 'burger'){ ?>
    <div class="form-group col-md-4">
        <label for="cheese">Cheese</label>
        <select id="cheese" name="cheese" class="form-control" required>
          <option value="no-cheese">No Cheese</option>  
          <option value="mozzarella">Mozzarella</option>
          <option value="cheddar">Cheddar</option>
          <option value="philadelphia">Philadelphia</option>
        </select>
      </div>
        <div class="form-group col-md-4">
        <label for="bread">Bread</label>
        <select id="bread" name="bread" class="form-control" required>
          <option value="ciabatta"> Ciabatta</option>
          <option value="english muffin">English Muffin</option>
        </select>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeSalad" id="includeSalad" >
        <label class="form-check-label" for="includeSalad" >Include Salad?</label>
      </div>
      <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="delivery1" value="1" checked>
            <label class="form-check-label" for="delivery1">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="delivery2" value="0">
            <label class="form-check-label" for="delivery2">
              No
            </label>
          </div>
        </div>
      </div>
    </fieldset>
        <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit-burger">Order Now</button>
      </div>
    </div>
  <?php } else if($_GET['category'] == "kebab"){ ?>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeRice" id="includeSalad">
        <label class="form-check-label" for="includeRice" >Rice</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeCuscus" id="includeCuscus">
        <label class="form-check-label" for="includeCuscus" >cuscus</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeCoslow" id="includeCoslow">
        <label class="form-check-label" for="includeCoslow" >coslow</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="includeShepherdSalad" id="includeShepherdSalad">
        <label class="form-check-label" for="includeShepherdSalad" >shepherd salad</label>
      </div>
      <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Delivery</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios1" value="1" checked>
            <label class="form-check-label" for="gridRadios1">
              Yes
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="delivery" id="gridRadios2" value="0">
            <label class="form-check-label" for="gridRadios2">
              No
            </label>
          </div>
        </div>
      </div>
    </fieldset>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit-kebab">Order Now</button>
      </div>
    </div>
    <?php } ?>
      <?php include("scripts/_message.php") ?>
</form>
</div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</html>

