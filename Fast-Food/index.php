<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
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
          <a  class="nav-link" href="home.php" id="burgersDropdown">Home <span class="sr-only">(current)</span></a>
        </li>
        <?php if(!isset( $_SESSION["user"])){ ?>
          <li class="nav-item">
            <a  class="nav-link" href="register.php" id="pizzaDropdown">Register</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="login.php" id="kebabDropdown">Login</a>
          </li>
        <?php }else{ ?>
          <li class="nav-item dropdown">
            <a class="nav-link" href="scripts/logoutHandler.php" id="kebabDropdown">Logout</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
  <div class="container">
    index
  </div>

</body>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</html>