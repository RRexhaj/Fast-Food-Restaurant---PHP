<?php

// connecting to the database
if(!isset($_SESSION["user"]))
{
  include("conn.php");

  function register($conn)
  {
    if(isset($_POST["submit"]))
    {
      // trim removes all spaces from the string
      $name = trim($_POST["name"]);
      $surname = trim($_POST["surname"]);
      $email = trim($_POST["email"]);
      $phone = trim($_POST["phone"]);
      $password = trim($_POST["password"]);
      $avatar = trim($_POST["avatar"]);
      // $avatar = $_FILES["avatar"];
    
      // if the inputs exist
      if(isset($name) && isset($surname) && isset($email) && isset($phone) && isset($password) && isset($avatar)){

        // create table query
        $createTableSQL = "
          CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            name varchar(16) NOT NULL,
            surname varchar(16) NOT NULL,
            email varchar(64) UNIQUE NOT NULL,
            phone varchar(24) UNIQUE NOT NULL,
            password varchar(256) NOT NULL,
            avatar INT NOT NULL,
            role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
          );
        ";
      
        $result = $conn->query($createTableSQL); // run the sql query
        if (!$result) {
          die("MySQL Error: " . $conn->error);
        }
        else{

          $sqlCheckIfExists = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
          $result = $conn->query($sqlCheckIfExists)->fetch_all();

          // if there isn't a user with the same email or phone
          if(count($result) == 0){
            $pwdHashed = password_hash($password, PASSWORD_DEFAULT);
  
            $sqlStoreUser = "INSERT INTO users (name, surname, email, phone, password, avatar) VALUES ('$name', '$surname', '$email', '$phone', '$pwdHashed', '$avatar')";
            $result = $conn->query($sqlStoreUser);
            if (!$result) {
              die("MySQL Error: " . $conn->error);
            }
            else{
              // echo "USER is stored";
              $userID = $conn->insert_id; // 
              // echo $userID;
  
              session_start();
              // storing the registered user in the session
              $_SESSION["user"] = array("id" => $userID, "name" => $name, "surname" => $surname, "email" => $email, "phone" => $phone, "password" => $pwdHashed, "avatar" => $avatar, "role" => "user");
              header("Location: ../home.php");
  
              // $filePath = "uploads/users/".$userID."/avatar"
            }
          }
          else{
            echo "This email or phone is already taken.";
          }

        }

      }
      
    }
  }
  register($conn);
}
else{
  header("Location: ../error-404.php"); // redirects the user to the specified location (home.php)
}

function validation($name, $surname, $email, $phone, $password, $avatar){
  return true;
}


exit();


?>