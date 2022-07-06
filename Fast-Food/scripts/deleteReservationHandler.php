<?php

  include("conn.php");
  session_start();

  if(isset($_POST["delete-reservation"])){

    $id = $_POST["id"];
    $category = $_POST["category"];

    $deleteQuery = "DELETE FROM ".$category."_reservations WHERE id='$id'";
    $result = $conn->query($deleteQuery);

    if($result){
      $_SESSION["message"] = "This reservation has been deleted, thank you.";
    }
    else{
      die("Mysql ERROR: ".$conn->error);
    }

  }
  
  // Go back to previous page
  header("Location: ".$_SERVER['HTTP_REFERER']);

?>