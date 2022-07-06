<?php

include("conn.php");
session_start();

if(isset($_SESSION["user"]))
{

  // creating burger reservations table for the first time
  $createTableSQL = "
    CREATE TABLE IF NOT EXISTS burger_reservations (
      id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
      cheese varchar(32) NOT NULL,
      bread varchar(32) NOT NULL,
      incSalad boolean NOT NULL,
      delivery boolean NOT NULL,
      userID INT NOT NULL,
      FOREIGN KEY (userID) REFERENCES users(id)
    );";
        
  $result = $conn->query($createTableSQL); // run the sql query
  if (!$result) {
    die("MySQL Error: " . $conn->error);
  }

  // creating pizza reservations table for the first time
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS pizza_reservations (
      id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
      cheese varchar(32) NOT NULL,
      crust varchar(32) NOT NULL,
      delivery boolean NOT NULL,
      userID INT NOT NULL,
      FOREIGN KEY (userID) REFERENCES users(id)
    );";
        
  $result = $conn->query($createTableSQL); // run the sql query
  if (!$result) {
    die("MySQL Error: " . $conn->error);
  }

  // creating kebab reservations table for the first time
  $createTableSQL = "
    CREATE TABLE IF NOT EXISTS kebab_reservations (
      id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
      incCuscus boolean NOT NULL,
      incRice boolean NOT NULL,
      incCoslow boolean NOT NULL,
      incSalad boolean NOT NULL,
      delivery boolean NOT NULL,
      userID INT NOT NULL,
      FOREIGN KEY (userID) REFERENCES users(id)
    );";
        
  $result = $conn->query($createTableSQL); // run the sql query
  if (!$result) {
    die("MySQL Error: " . $conn->error);
  }

  if(isset($_POST['submit-burger']))
  {
    $cheese = $_POST["cheese"];
    $bread = $_POST["bread"];
    $includeSalad = isset($_POST["includeSalad"]) ? 1 : 0;
    $delivery = $_POST["delivery"];
    $userID = $_SESSION["user"]["id"]; // logged in user

      $addBurger = "INSERT INTO burger_reservations (cheese, bread, incSalad, delivery, userID) VALUES ('$cheese','$bread',$includeSalad,$delivery,$userID)";
      $result = $conn->query($addBurger); // run the sql query

      if (!$result) {
        die("MySQL Error: " . $conn->error);
      }
      else{
        $_SESSION["message"] = "Your burger has been reserved, thank you!";
        header("Location: ../reservations.php");
        // Go back to previous page
        // header("Location: ".$_SERVER['HTTP_REFERER']);

      }
  }
  else if(isset($_POST['submit-pizza']))
  {
    $cheese = $_POST["cheese"];
    $crust = $_POST["crust"];
    $delivery = $_POST["delivery"];
    $userID = $_SESSION["user"]["id"];

    $addPizza = "INSERT INTO pizza_reservations (cheese, crust, delivery, userID) VALUES ('$cheese', '$crust', $delivery, $userID)";

    $result = $conn->query($addPizza);
    if (!$result) {
      die("MySQL Error: " . $conn->error);
    }
    else{
      $_SESSION["message"] = "Your pizza has been reserved, thank you!";
      header("Location: ../reservations.php");
      // Go back to previous page
      // header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  }
  else if(isset($_POST['submit-kebab']))
  {
    $includeRice = isset($_POST["includeRice"]) ? 1 : 0; // if includeRice exists, then return 1 otherwise return 0
    $includeCuscus = isset($_POST["includeCuscus"]) ? 1 : 0; // if includeCuscus exists , then return 1 otherwise return 0
    $includeSalad = isset($_POST["includeShepherdSalad"]) ? 1 : 0; // if includeShepherdSalad exists (isset), then return 1 otherwise return 0
    $includeCoslow = isset($_POST["includeCoslow"]) ? 1 : 0; // if includeCoslow exists (isset), then return 1 otherwise return 0
    $delivery = $_POST["delivery"];
    $userID = $_SESSION["user"]["id"];

    $addKebab = "INSERT INTO kebab_reservations (incCuscus, incRice, incCoslow, incSalad ,delivery, userID) VALUES ($includeCuscus, $includeRice, $includeCoslow, $includeSalad, $delivery, $userID)";

    $result = $conn->query($addKebab);
    if (!$result) {
      die("MySQL Error: " . $conn->error);
    }
    else{
      $_SESSION["message"] = "Your kebab has been reserved, thank you!";
      header("Location: ../reservations.php");
      // Go back to previous page
      // header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  }
}

exit();

?>
