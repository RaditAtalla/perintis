<?php
session_start();
require_once 'connection.php';
$_SESSION['usernameExist'] = true;
$_SESSION['passwordCorrect'] = true;

function login($username, $password){
  global $connect;

  $query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
  
  // Checks if the username doesn't exist in database
  if(!mysqli_num_rows($query) > 0){
    $_SESSION['usernameExist'] = false;
    return;
  }

  $datas = mysqli_fetch_assoc($query); // destructures the login query into assoc array
  $hashedPassword = $datas["password"]; // returns the password from database

  // Checks if the password is wrong
  if(!password_verify($password, $hashedPassword)){
    $_SESSION['passwordCorrect'] = false;
    return;
  }

  if($username == 'admin') {
    $_SESSION['isAdmin'] = true;
    header('location: pages\admin.php');
    exit;
  }

  $_SESSION['loggedIn'] = true;
  header('location: pages\voteKetua.php');
}