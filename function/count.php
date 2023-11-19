<?php
require_once("../function/query.php");

$ketua = query("SELECT * FROM kandidat WHERE jabatan = 'ketua'");
$sekretaris = query("SELECT * FROM kandidat WHERE jabatan = 'sekretaris'");
$bendahara = query("SELECT * FROM kandidat WHERE jabatan = 'bendahara'");

$countKetua = [];
foreach($ketua as $row) {
	$result = mysqli_query($connect, "SELECT * FROM votes WHERE ketua_selected = '{$row['nama']}'");
	$ketuaVotes = mysqli_num_rows($result);

	$countKetua[] = $ketuaVotes;
}

$countSekretaris = [];
foreach($sekretaris as $row) {
	$result = mysqli_query($connect, "SELECT * FROM votes WHERE sekretaris_selected = '{$row['nama']}'");
	$sekretarisVotes = mysqli_num_rows($result);

	$countSekretaris[] = $sekretarisVotes;
}

$countBendahara = [];
foreach($bendahara as $row) {
	$result = mysqli_query($connect, "SELECT * FROM votes WHERE bendahara_selected = '{$row['nama']}'");
	$bendaharaVotes = mysqli_num_rows($result);

	$countBendahara[] = $bendaharaVotes;
}