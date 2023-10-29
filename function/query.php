<?php
require_once 'connection.php';

function query($jabatan) {
  global $connect;

  // Get data from database
  $query = mysqli_query($connect, "SELECT * FROM kandidat WHERE jabatan = '$jabatan'");
  
  $rows = [];
  while($row = mysqli_fetch_assoc($query)) {
    $rows[] = $row;
  }
  
  return $rows;
}