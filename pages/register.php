<?php 
  $connect = mysqli_connect('localhost', 'root', '', 'perintis');

  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $hashedPassword = password_hash($username, PASSWORD_BCRYPT);

    $query = "INSERT INTO user VALUES('', '$username', '$hashedPassword', '$nama', '$kelas');";
    mysqli_query($connect, $query);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h1>Register</h1>
  <form action="" method="post">
    <input type="text" name="nama" placeholder="nama" style="font-size: 3rem;">
    <input type="text" name="username" placeholder="username" style="font-size: 3rem;">
    <input type="text" name="kelas" placeholder="kelas" style="font-size: 3rem;">
    <button type="submit" name="submit" style="font-size: 2rem;">submit</button>
  </form>
</body>
</html>