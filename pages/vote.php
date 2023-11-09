<?php 
session_start();

if(!$_SESSION['loggedIn']) {
	header('location: ../index.php');
}

require_once("../function/query.php");
require_once("../function/stringEditor.php");
$kandidat = query("SELECT * FROM kandidat");
$highestId = query("SELECT MAX(id) FROM kandidat")[0]["MAX(id)"];
$ketua = query("SELECT * FROM kandidat WHERE jabatan = 'ketua'");
$sekretaris = query("SELECT * FROM kandidat WHERE jabatan = 'sekretaris'");
$bendahara = query("SELECT * FROM kandidat WHERE jabatan = 'bendahara'");

for($i = 0; $i <= $highestId; $i++) {
	echo $i;
}
// switch($ketuaSelectedId) {

// }
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
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link active fs-4" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ketua</button>
					<button class="nav-link fs-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
						Sekretaris
					</button>
					<button class="nav-link fs-4" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
						Bendahara
					</button>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<!-- ketua tab -->
				<div class="tab-pane fade show active container-fluid" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
					<form method="get" class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-3 justify-content-center mt-3">
						<?php foreach($ketua as $k) : ?>
						<div class="col" style="min-width: 100px !important; max-width: 500px">
              <div class="modal" tabindex="-1" id="<?= removeSpaces(removeDots($k['nama'])) ?>">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Visi & Misi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Visi</p>
                        <p class="text-center fs-4">“<?= $k['visi'] ?>”</p>
                      </div>
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Misi</p>
                        <ol>
													<?php $misi = splitByDot($k['misi']); foreach($misi as $ms) : ?>
                          <li><?= $ms ?></li>
													<?php endforeach; ?>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
							<div class="card p-0 rounded-1 shadow">
								<img src="../img/<?= $k['gambar'] ?>" loading="lazy" class="card-img-top w-100 rounded-top-1" alt="foto kandidat" style="height: 250px; object-fit: cover;" />
								<!-- <div class="w-100 bg-secondary-subtle rounded-top-1" style="height: 250px"></div> -->
								<div class="card-body">
									<h5 class="card-title m-0"><?= $k['nama'] ?></h5>
									<p class="card-text color-text-secondary" style="margin: 0 0 5em 0"><?= $k['kelas'] ?></p>
									<div class="container-fluid">
										<div class="row row-cols-1 gap-2">
											<button type="submit" name="vote<?= $k['id'] ?>" class="btn color-bg-primary text-light d-flex align-items-center justify-content-center">Vote</button>
											<a href="#" class="btn color-border-primary color-primary" data-bs-toggle="modal" data-bs-target="#<?= removeSpaces(removeDots($k['nama'])) ?>">Visi & Misi</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</form>
				</div>
				
				<!-- sekretaris tab -->
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
					<form method="get" class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-3 justify-content-center mt-3">
					<?php foreach($sekretaris as $s) : ?>
						<div class="col" style="min-width: 100px !important; max-width: 500px">
              <div class="modal" tabindex="-1" id="<?= removeSpaces(removeDots($s['nama'])) ?>">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Visi & Misi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Visi</p>
                        <p class="text-center fs-4">“<?= $s['visi'] ?>”</p>
                      </div>
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Misi</p>
                        <ol>
													<?php $misi = splitByDot($s['misi']); foreach($misi as $ms) : ?>
                          <li><?= $ms ?></li>
													<?php endforeach; ?>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
							<div class="card p-0 rounded-1 shadow">
								<img src="../img/<?= $s['gambar'] ?>" loading="lazy" class="card-img-top w-100 rounded-top-1" alt="foto kandidat" style="height: 250px; object-fit: cover;" />
								<!-- <div class="w-100 bg-secondary-subtle rounded-top-1" style="height: 250px"></div> -->
								<div class="card-body">
									<h5 class="card-title m-0"><?= $s['nama'] ?></h5>
									<p class="card-text color-text-secondary" style="margin: 0 0 5em 0"><?= $s['kelas'] ?></p>
									<div class="container-fluid">
										<div class="row row-cols-1 gap-2">
											<button type="submit" name="vote<?= $s['id'] ?>" class="btn color-bg-primary text-light d-flex align-items-center justify-content-center">Vote</button>
											<a href="#" class="btn color-border-primary color-primary" data-bs-toggle="modal" data-bs-target="#<?= removeSpaces(removeDots($s['nama'])) ?>">Visi & Misi</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</form>
				</div>

				<!-- bendahara tab -->
				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
					<form method="get" class="row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-3 justify-content-center mt-3">
					<?php foreach($bendahara as $b) : ?>
						<div class="col" style="min-width: 100px !important; max-width: 500px">
              <div class="modal" tabindex="-1" id="<?= removeSpaces(removeDots($b['nama'])) ?>">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Visi & Misi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Visi</p>
                        <p class="text-center fs-4">“<?= $b['visi'] ?>”</p>
                      </div>
                      <div>
                        <p class="text-center text-decoration-underline color-primary fw-medium fs-5">Misi</p>
                        <ol>
													<?php $misi = splitByDot($b['misi']); foreach($misi as $ms) : ?>
                          <li><?= $ms ?></li>
													<?php endforeach; ?>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
							<div class="card p-0 rounded-1 shadow">
								<img src="../img/<?= $b['gambar'] ?>" loading="lazy" class="card-img-top w-100 rounded-top-1" alt="foto kandidat" style="height: 250px; object-fit: cover;" />
								<!-- <div class="w-100 bg-secondary-subtle rounded-top-1" style="height: 250px"></div> -->
								<div class="card-body">
									<h5 class="card-title m-0"><?= $b['nama'] ?></h5>
									<p class="card-text color-text-secondary" style="margin: 0 0 5em 0"><?= $b['kelas'] ?></p>
									<div class="container-fluid">
										<div class="row row-cols-1 gap-2">
											<button type="submit" name="vote<?= $b['id'] ?>" class="btn color-bg-primary text-light d-flex align-items-center justify-content-center">Vote</button>
											<a href="#" class="btn color-border-primary color-primary" data-bs-toggle="modal" data-bs-target="#<?= removeSpaces(removeDots($s['nama'])) ?>">Visi & Misi</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</form>
			</div>
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
