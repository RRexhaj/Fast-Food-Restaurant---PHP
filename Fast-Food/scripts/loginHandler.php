<?php

if(!isset($_SESSION["user"]))
{
  include("conn.php");
  
  if(isset($_POST["submit"])){
    $email_or_phone = $_POST["email_or_phone"];
    $password = $_POST["password"];
  
    //xumocemub@mailinator.com
    $sqlGetUserByEmail = "SELECT * FROM users WHERE email = '$email_or_phone' OR phone = '$email_or_phone'";
    $result = $conn->query($sqlGetUserByEmail)->fetch_assoc();
  
    if($result)
    {
      $pwdVerify = password_verify($password, $result["password"]); // checks if the user has entered the correct password
      if($pwdVerify)
      {
        session_start();
        $_SESSION["user"] = $result; // create the session by storing the user info in the session
        header("Location: ../home.php"); // redirects the user to the specified location (home.php)
      }
      else{
        echo "The password you have entered is wrong.";
      }
    }
    else{
      echo "This email or phone doesn't correspond to any user.";
    }
  }
}
else{
  header("Location: ../error-404.php"); // redirects the user to the specified location (home.php)
}

exit(); // stops the execution of this script, not really neeeded after the header, but it's useful.

?>