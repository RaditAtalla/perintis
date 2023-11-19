<?php
session_start();

if (!isset($_SESSION['isAdmin'])) {
	header('location: ../index.php');
}

require_once("../function/connection.php");
require_once("../function/count.php");

$getVoters = mysqli_query($connect, "SELECT * FROM user");
$countVoters = mysqli_num_rows($getVoters);

$getHasVoted = mysqli_query($connect, "SELECT * FROM votes");
$countHasVoted = mysqli_num_rows($getHasVoted);

$votedPercentage = round(($countHasVoted / $countVoters) * 100);
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
			<a href="../function/logout.php">Log out</a>
		</div>
	</header>

	<main>
		<section class="row row-cols-1 row-cols-sm-2 text-light gy-3">
			<div class="color-bg-primary p-4 rounded-5 col-sm-5 me-2">
				<p class="fs-1"><?= $countVoters ?></p>
				<p class="fs-4">Pemilih</p>
			</div>
			<div class="color-bg-primary p-4 rounded-5 col-sm-5">
				<p class="fs-1"><?= $countHasVoted ?><span class="fs-3">(<?= $votedPercentage ?>%)</span></p>
				<p class="fs-4">Sudah Memilih</p>
			</div>
		</section>
		<section class="mt-4">
			<div>
				<h2 class="color-text-primary fs-1">Perolehan Ketua</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Suara</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php $j = 0 ?>
						<?php foreach($ketua as $row) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $row['nama']; ?></td>
								<td><?= $row['jabatan']; ?></td>
								<td><?= $countKetua[$j] ?></td>
								<td><a href="">Detail</a></td>
							</tr>
							<?php $i++ ?>
							<?php $j++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div>
				<h2 class="color-text-primary fs-1">Perolehan Sekretaris</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Suara</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php $j = 0 ?>
						<?php foreach($sekretaris as $row) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $row['nama']; ?></td>
								<td><?= $row['jabatan']; ?></td>
								<td><?= $countSekretaris[$j] ?></td>
								<td><a href="">Detail</a></td>
							</tr>
							<?php $i++ ?>
							<?php $j++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div>
				<h2 class="color-text-primary fs-1">Perolehan Bendahara</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Suara</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php $j = 0 ?>
						<?php foreach($bendahara as $row) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $row['nama']; ?></td>
								<td><?= $row['jabatan']; ?></td>
								<td><?= $countBendahara[$j] ?></td>
								<td><a href="">Detail</a></td>
							</tr>
							<?php $i++ ?>
							<?php $j++ ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</section>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>