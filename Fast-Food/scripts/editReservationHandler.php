<?php

  include("conn.php");
  session_start();

    $id = $_POST["id"];
    $category = $_POST["category"];
    $userID = $_SESSION["user"]["id"];
    $result;

    

    if(isset($_POST['edit-burger-reservation']))
    {
      $cheese = $_POST["cheese"];
      $bread = $_POST["bread"];
      $includeSalad = isset($_POST["includeSalad"]) ? 1 : 0;
      $delivery = $_POST["delivery"];

        $editBurger = "UPDATE burger_reservations SET cheese = '$cheese', bread = '$bread', incSalad = $includeSalad, delivery = $delivery WHERE id = $id AND userID = $userID";
        $result = $conn->query($editBurger); // run the sql query

    }
    else if(isset($_POST['edit-pizza-reservation']))
    {
      $cheese = $_POST["cheese"];
      $crust = $_POST["crust"];
      $delivery = $_POST["delivery"];

      $editPizza = "UPDATE pizza_reservations SET cheese = '$cheese', crust = '$crust', delivery = $delivery WHERE id = $id AND userID = $userID";

      $result = $conn->query($editPizza);

    }
    else if(isset($_POST['edit-kebab-reservation']))
    {
      $includeRice = isset($_POST["includeRice"]) ? 1 : 0;
      $includeCuscus = isset($_POST["includeCuscus"]) ? 1 : 0;
      $includeSalad = isset($_POST["includeShepherdSalad"]) ? 1 : 0;
      $includeCoslow = isset($_POST["includeCoslow"]) ? 1 : 0;
      $delivery = $_POST["delivery"];

      $editKebab = "UPDATE kebab_reservations SET incCuscus = $includeCuscus, incRice = $includeRice, incCoslow = $includeCoslow, incSalad = $includeSalad, delivery = $delivery WHERE id = $id AND userID = $userID";

      $result = $conn->query($editKebab);

    }

    // $deleteQuery = "DELETE FROM ".$category."_reservations WHERE id='$id'";
    // $result = $conn->query($deleteQuery);

    if($result){
      $_SESSION["message"] = "This reservation has been edited, thank you.";
    }
    else{
      die("Mysql ERROR: ".$conn->error);
    }

  
  // Go back to previous page
  header("Location: ".$_SERVER['HTTP_REFERER']);

?>