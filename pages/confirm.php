<?php 
session_start();
require_once '../function/query.php';

if(!$_SESSION['loggedIn']) {
	header('location: ../index.php');
}

if(!isset($_SESSION['chosenKetua']) && !isset($_SESSION['chosenSekretaris']) && !isset($_SESSION['chosenBendahara'])) {
  header('location: ./voteKetua.php');
}

$chosenKetua = query("SELECT * FROM kandidat WHERE nama = '{$_SESSION['chosenKetua']}'")[0];
$chosenSekretaris = query("SELECT * FROM kandidat WHERE nama = '{$_SESSION['chosenSekretaris']}'")[0];
$chosenBendahara = query("SELECT * FROM kandidat WHERE nama = '{$_SESSION['chosenBendahara']}'")[0];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Konfirmasi | PERINTIS</title>
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/global.css" />
		<link rel="stylesheet" href="../css/confirmPage.css" />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
	</head>
	<body class="container d-flex flex-column" style="height: 100vh">
		<header class="d-sm-flex d-none justify-content-between align-items-center py-4" style="border-top: 5px solid #9a3d36;">
			<div class="d-flex flex-column align-items-sm-center">
				<h1 class="logo-font display-5 fw-bold color-text-logo m-0" style="letter-spacing: 5px">PER<span class="logo-font" style="color: #9a3d36">INTI</span>S</h1>
				<p class="color-text-primary m-0">Pemilihan Pengurus Inti OSIS</p>
			</div>
			<div class="d-flex gap-4">
				<img src="../img/smktelkommedan.png" alt="Logo Telkom Schools" width="60px" />
				<img src="../img/osisskatel.png" alt="Logo OSIS" width="60px" />
			</div>
		</header>
    <main class="d-flex flex-column align-items-center py-5 py-sm-0">
      <h2 class="display-4 fw-bold color-text-primary mb-3">Konfirmasi</h2>
      <div class="mb-3 mb-md-0">
        <div class="row row-cols-md-3 row-cols-1 gx-5 gy-3 gy-md-0">
          <div class="d-flex flex-md-column flex-row align-items-center justify-content-between justify-content-md-start gap-2">
            <!-- <div class="bg-secondary-subtle" style="height: 270px; width: 270px;"></div> -->
            <img src="../img/<?= $chosenKetua['gambar'] ?>" alt="<?= $chosenKetua['nama'] ?>" style="height: 270px; width: 270px; object-fit: cover">
            <p class="fs-5" style="color: rgba(73, 73, 73, 0.60);">Ketua</p>
          </div>
          <div class="d-flex flex-md-column flex-row align-items-center justify-content-between justify-content-md-start gap-2">
            <!-- <div class="bg-secondary-subtle" style="height: 270px; width: 270px; object-fit: cover"></div> -->
            <img src="../img/<?= $chosenSekretaris['gambar'] ?>" alt="<?= $chosenSekretaris['nama'] ?>" style="height: 270px; width: 270px; object-fit: cover">
            <p class="fs-5" style="color: rgba(73, 73, 73, 0.60);">Sekretaris</p>
          </div>
          <div class="d-flex flex-md-column flex-row align-items-center justify-content-between justify-content-md-start gap-2">
            <!-- <div class="bg-secondary-subtle" style="height: 270px; width: 270px; object-fit: cover"></div> -->
            <img src="../img/<?= $chosenBendahara['gambar'] ?>" alt="<?= $chosenBendahara['nama'] ?>" style="height: 270px; width: 270px; object-fit: cover">
            <p class="fs-5" style="color: rgba(73, 73, 73, 0.60);">Bendahara</p>
          </div>
        </div>
      </div>
      <p class="color-text-primary text-center mb-5 fs-5 px-5" style="min-width: 50px; max-width: 600px;">Anda telah memilih kandidat - kandidat diatas. Jika anda sudah yakin dengan pilihan anda, tekan tombol dibawah ini. Jika belum, tekan tombol kembali</p>
      <a href="../function/logout.php" class="color-bg-primary text-light fw-bold py-2 px-5 rounded-2 text-decoration-none mb-2">Selesai & Log out</a>
      <a href="./voteKetua.php" class="color-text-primary">Kembali</a>
    </main>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>
