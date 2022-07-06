<?php 

include("conn.php");

if(isset($_SESSION["user"])){

  $reservations = array("burger_reservations" => array(), "pizza_reservations" => array(), "kebab_reservations" => array());
  // reservation table names (entities)
  $reservationCategories = array("burger_reservations", "pizza_reservations", "kebab_reservations");

  foreach($reservationCategories as $category)
  {
    // get burgers reservation for logged in user
    $userID = $_SESSION["user"]["id"];
    $getBurgersSQL = "SELECT * FROM $category WHERE userID = $userID";
    $result = $conn->query($getBurgersSQL)->fetch_all(MYSQLI_ASSOC);
    $reservations[$category] = $result;
  }

}


?>