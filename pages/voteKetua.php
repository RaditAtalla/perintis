<?php 
session_start();

if(!$_SESSION['loggedIn']) {
	header('location: ../index.php');
}

require_once("../function/connection.php");
require_once("../function/query.php");
require_once("../function/stringEditor.php");

$userRow = mysqli_query($connect, "SELECT nama FROM user WHERE username = '{$_SESSION['username']}'");
$usernameName = mysqli_fetch_assoc($userRow)['nama'];
$usernameHasVoted = mysqli_query($connect, "SELECT voter_name FROM votes WHERE voter_name = '$usernameName'");
if(mysqli_fetch_assoc($usernameHasVoted) > 0) {
	$_SESSION['hasVoted'] = true;
	unset($_SESSION['loggedIn']);
	header('location: ../index.php');
}

$ketua = query("SELECT * FROM kandidat WHERE jabatan = 'ketua'");
$sekretaris = query("SELECT * FROM kandidat WHERE jabatan = 'sekretaris'");
$bendahara = query("SELECT * FROM kandidat WHERE jabatan = 'bendahara'");

if(isset($_POST['selanjutnya'])){
	if(!isset($_POST['kandidatKetua'])){
		// echo "<script>alert('HARAP TEKAN TOMBOL VOTE PADA SALAH SATU KANDIDAT SEBELUM MELANUTKAN KE JABATAN SELANJUTNYA!')</script>";
		header('location: ./voteKetua.php');
		return;
	}
	$_SESSION['chosenKetua'] = $_POST['kandidatKetua'];
	header('location: ./voteSekret.php');
}
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
	<body class="container d-flex flex-column gap-5" style="height: 100vh">
		<div class="modal fade" tabindex="-1" id="myModal">
			<div class="modal-dialog modal-fullscreen p-0 p-sm-5">
				<div class="modal-content px-5 py-2">
					<div class="modal-header flex-column flex-md-row">
						<h5 class="modal-title display-1 color-text-primary fw-bold">Tata Cara</h5>
						<button type="button" class="color-bg-primary text-light border-0 fw-bold rounded-1 px-5 py-2" data-bs-dismiss="modal" aria-label="Close">Saya Mengerti</button>
					</div>
					<div class="modal-body">
						<ol class="fs-4">
              <li>Pada halaman pemilihan ketua, klik tombol <b>vote</b> pada kandidat yang ingin dipilih. Anda juga dapat melihat visi dan misi dari kandidat tersebut dengan menekan tombol <b>visi & misi.</b></li>
              <li>Setelah memilih salah satu kandidat ketua, klik tombol <b>Sekretaris</b> untuk memasuki halaman pemilihan sekretaris, mekanismenya sama dengan halaman pemilihan ketua (anda baru dapat memilih sekretaris setelah anda memilih ketua).</li>
              <li>Setelah itu, lakukan hal yang sama dengan pemilihan <b>Bendahara</b></li>
              <li>Setelah anda telah memiilh satu kandidat untuk masing-masing jabatan, klik tombol <b>Selanjutnya</b> di bagian kanan atas halaman pemilihan bendahara. Tombol tersebut akan membawa anda ke halaman konfirmasi.</li>
              <li>Pada halaman konfirmasi, anda dapat meninjau kembali pilihan anda. Jika sudah yakin dengan pilihan anda, silahkan tekan tombol <b>Selesai & Log out</b>. Jika ingin mengubah pilihan, tekan tombol <b>Kembali</b>.</li>
            </ol>
					</div>
				</div>
			</div>
		</div>
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
		<main class="pb-5">
			<form action="" method="post">
				<nav>
					<div class="nav nav-tabs gap-1" id="nav-tab" role="tablist">
						<button class="nav-link active fs-4" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ketua</button>
						<button name="selanjutnya" class="color-bg-primary text-light rounded border-0 px-2 fs-5">Selanjutnya</button>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active container-fluid" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
						<div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 gy-3 justify-content-center mt-3">
							<?php foreach($ketua as $row) : ?>
							<div class="col" style="min-width: 100px !important; max-width: 500px">
								<div class="modal" tabindex="-1" id="<?= removeSpaces(removeDots($row['nama'])) ?>">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Visi & Misi</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div>
													<p class="text-center text-decoration-underline color-primary fw-medium fs-5">Visi</p>
													<p class="text-center fs-4">“<?= $row['visi'] ?>”</p>
												</div>
												<div>
													<p class="text-center text-decoration-underline color-primary fw-medium fs-5">Misi</p>
													<ol>
														<?php $misi = splitByDot($row['misi']); foreach($misi as $ms) : ?>
														<li><?= $ms ?></li>
														<?php endforeach; ?>
													</ol>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card p-0 rounded-1 shadow">
									<img src="../img/<?= $row['gambar'] ?>" loading="lazy" class="card-img-top w-100 rounded-top-1" alt="foto kandidat" style="height: 250px; object-fit: cover;" />
									<!-- <div class="w-100 bg-secondary-subtle rounded-top-1" style="height: 250px"></div> -->
									<div class="card-body">
										<h5 class="card-title m-0"><?= $row['nama'] ?></h5>
										<p class="card-text color-text-secondary" style="margin: 0 0 5em 0"><?= $row['kelas'] ?></p>
										<div class="container-fluid">
											<div class="row row-cols-1 gap-2">
												<div class="vote-btn d-flex justify-content-center text-center position-relative p-0" id="votee">
													<input type="radio" name="kandidatKetua" class="position-absolute opacity-0" id="k<?= $row['id'] ?>" value="<?= $row['nama'] ?>">
													<label for="k<?= $row['id'] ?>" class="color-bg-primary text-light rounded w-100 p-2" style="cursor: pointer;" >Vote</label>
												</div>
												<a href="#" class="btn color-border-primary color-primary" data-bs-toggle="modal" data-bs-target="#<?= removeSpaces(removeDots($row['nama'])) ?>">Visi & Misi</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
			</form>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(window).on("load", function () {
				$("#myModal").modal("show");
			});
		</script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
			crossorigin="anonymous"
		></script>
	</body>
</html>
