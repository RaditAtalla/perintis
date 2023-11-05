<?php
require_once 'connection.php';

function query($query) {
  global $connect;

  // Get data from database
  $result = mysqli_query($connect, $query);
  
  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  
  return $rows;
}