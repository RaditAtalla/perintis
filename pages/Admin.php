<?php 
	session_start();

	if(!isset($_SESSION['isAdmin'])) {
		header('location: ../index.php');
	}

  require_once("../function/connection.php");
  $result = mysqli_query($connect, "SELECT * FROM votes WHERE ketua_selected = 'Christian Gerald'");
  $kandidat1 = mysqli_fetch_assoc($result);
  $countKandidat1 = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Vote | PERINTIS</title>
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/global.css" />
		<link rel="stylesheet" href="../css/votePage.css" />
		<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
	</head>
	<body class="container" style="height: 100vh">
    <header class="py-4" style="border-top: 5px solid #9a3d36;">
      <div class="d-flex align-items-start">
        <div class="d-flex align-items-center flex-column">
          <h1 class="logo-font display-5 fw-bold color-text-logo m-0" style="letter-spacing: 5px">PER<span class="logo-font" style="color: #9a3d36">INTI</span>S</h1>
          <p class="color-text-primary m-0">Pemilihan Pengurus Inti OSIS</p>
        </div>
      </div>
    </header>

    <main>
      
    </main>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
			crossorigin="anonymous"
		></script>
	</body>
</html>