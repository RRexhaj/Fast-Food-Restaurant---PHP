<?php

include("conn.php");

$categories = array("burgers" => array(), "pizzas" => array(), "kebabs" => array());

foreach($categories as $key => $category)
{
  $sql = "SELECT fillings.title 
          FROM categories 
          INNER JOIN fillings ON categories.id = fillings.category_id 
          WHERE categories.title = '".$key."'
        ";
  $result = $conn->query($sql)->fetch_all(); // get all fillings

  if(!$result){
    die("MySQL Error: " . $conn->error);
  }
  else{
    // store each filling to the corresponding category
    foreach($result as $row){
      array_push($categories[$key], $row[0]);
    }
  }
}

?>
