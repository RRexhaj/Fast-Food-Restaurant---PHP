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

    <?php if(!isset( $_SESSION["user"])){ ?>

      <div class="container">
        <!-- enctype="multipart/form-data needed for the images -->
        <form method="POST" action="scripts/registerHandler.php" enctype="multipart/form-data">
          <h1>Register Form</h1>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="name" class="form-control" id="name" name="name" min=1 max=15 placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="surname">Surname</label>
            <input type="surname" class="form-control" id="surname" name="surname" min=1 max=15 placeholder="Surname" required>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" min=3 placeholder="Password" required>
          </div>
          <!-- <div class="form-group">
            <label for="avatar">Upload your Profile Picture</label>
            <input type="file" class="form-control-file" name="avatar" id="avatar">
          </div> -->
          <div class="form-group">
            <div class="row">
              <div class="col-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="avatar" id="avatar-1" value="1" checked>
                  <label class="form-check-label" for="avatar-1">
                    <img src="assets/avatars/1.png" alt="">
                  </label>
                </div>
              </div>
              <div class="col-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="avatar" value="2" id="avatar-2">
                  <label class="form-check-label" for="avatar-2">
                    <img src="assets/avatars/2.png" alt="">
                  </label>
                </div>
              </div>
              <div class="col-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="avatar" value="3" id="avatar-3">
                  <label class="form-check-label" for="avatar-3">
                    <img src="assets/avatars/3.png" alt="">
                  </label>
                </div>
              </div>
              <div class="col-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="avatar" value="4" id="avatar-4">
                  <label class="form-check-label" for="avatar-4">
                    <img src="assets/avatars/4.png" alt="">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Register</button>
        </form>
      </div>

  <?php }else{ ?>

    <div class="container">
      <?php include("_error-404.php"); ?>
    </div>
    
  <?php } ?>

</body>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/validate.js"></script>
  <script src="assets/js/validateRegister.js"></script>

</html>