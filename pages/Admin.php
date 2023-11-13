<?php 
  require_once("../function/connection.php");
  $result = mysqli_query($connect, "SELECT * FROM votes WHERE ketua_selected = 'M. Ahlam Radithya'");
  $kandidat1 = mysqli_fetch_assoc($result);
  $countKandidat1 = mysqli_num_rows($result);
  echo $countKandidat1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>