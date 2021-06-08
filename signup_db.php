<?php

  if(!isset($_POST["submit"])) {
    header("location: signup.php");
    exit;
  }

  require_once "config.php";

  $email = $password = $name = $phone_no = "";
  $email_err = true;
  
  // Validate Email
  $sql = "SELECT id FROM users WHERE email = ?";

  if($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $param_email);
    $param_email = trim($_POST["email"]);

    if($stmt->execute()) {
      $stmt->store_result();

      if($stmt->num_rows === 1) {
        header("location: signup.php?signup=exists");
      }
      else {
        $email = trim($_POST["email"]);
        $email_err = false;
      }
    }
    else {
      echo "Oops! Something went wrong. Please try again.";
    }
  }
  $stmt->close();
    
  $password = trim($_POST["password"]);
  
  // Check errors and insert into database
  if($email_err === false) {
    $sql = "INSERT INTO users(email, password, name, phone_no) VALUES(?, ?, ?, ?)";

    if($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("ssss", $param_email, $param_password, $param_name, $param_phone_no);
      $name = trim($_POST["name"]);
      $phone_no = trim($_POST["phone_no"]);
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);
      $param_name = $name;
      $param_phone_no = $phone_no;

      if($stmt->execute()) {
        header("location: signup.php?signup=success");
      }
      else {
        echo "Oops! Something went wrong. Please try again.";
      }
    }
    $stmt->close();
  }
  $mysqli->close();
