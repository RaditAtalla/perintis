<?php 
require_once("function/login.php");

if(isset($_SESSION['loggedIn'])) {
	header('location: pages/voteKetua.php');
	exit;
}

if(isset($_SESSION['isAdmin'])) {
	header('location: pages/admin.php');
	exit;
}

if(isset($_POST["loginButton"])){
	$_SESSION['username'] = $_POST['username'];
	login($_POST["username"], $_POST["password"]);
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Login | PERINTIS</title>
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/global.css" />
		<link rel="stylesheet" href="css/loginPage.css" />
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	</head>
	<body class="container-fluid m-0 p-0" style="height: 100vh;">
		<div class="row h-100 m-0">
			<div class="col-sm-7 h-100 d-none d-lg-flex flex-column align-items-center justify-content-center title-wrapper" style="background-color: rgba(154, 61, 54, 0.2);">
        <div class="d-flex gap-4 logo-wrapper mb-3">
          <img src="img/smktelkommedan.png" alt="logo telkom schools" width="88px" >
          <img src="img/osisskatel.png" alt="logo osis" width="88px" >
        </div>
        <h1 class="fw-bold color-text-primary m-0 title logo-font" style="letter-spacing: 10px; font-size: 7rem;">PER<span style="color: #9A3D36; font-family: 'josefin sans">INTI</span>S</h1>
        <p class="color-text-primary m-0 fw-light fs-1">Pemilihan Pengurus Inti OSIS</p>
      </div>
			<div class="col-lg-5 col-12 h-100 d-flex flex-column justify-content-center px-5" style="gap: 5em;border-top: 5px solid #9a3d36;">
				<h2 class="display-3 fw-bold color-text-primary m-0">Login</h2>
				<form action="" method="post" class="d-flex flex-column gap-5">
					<div class="d-flex flex-column gap-4">
						<div class="d-flex flex-column gap-2">
							<label for="" class="color-text-secondary fs-5">Username</label>
							<?php
							if(!$_SESSION['usernameExist']) echo '<p class="color-primary fst-italic">Username tidak ada!</p>';
							?>
							<div>
								<input type="text" class="py-3 px-3 border-0 w-100 rounded-1" style="background: #F1F1F1; outline: none;" placeholder="Cth: 545211210" autocomplete="off" autofocus required name="username">
								<div style="height: 3px; width: 75%; background-color: #9A3D36;"></div>
							</div>
						</div>
						<div class="d-flex flex-column gap-2">
							<label for="" class="color-text-secondary fs-5">Password</label>
							<?php
							if(!$_SESSION['passwordCorrect']) echo '<p class="color-primary fst-italic">Password salah!</p>';
							?>
							<div>
								<input type="password" class="py-3 px-3 border-0 w-100 rounded-1" style="background: #F1F1F1; outline: none;" placeholder="********" name="password" autocomplete="off" required>
								<div style="height: 3px; width: 50%; background-color: #9A3D36;"></div>
							</div>
						</div>
					</div>
					<button class="text-center text-decoration-none border-0 text-light fw-semibold py-3 rounded-3 fs-5" style="background: #9A3D36;" name="loginButton">Login</button>
				</form>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>
