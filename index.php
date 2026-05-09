<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pendaftaran Mahasiswa Baru</title>

<link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

<h1>Pendaftaran Mahasiswa Baru</h1>
<h2>UNIVERSITAS PAMULANG</h2>

<form method="post" id="formAwal">

<div class="form-group">
<label>Jumlah Input Data</label>
<input type="number" name="jumlah" min="1" required>
</div>

<button type="submit" name="buat">Buat Form</button>

</form>

<?php
if(isset($_POST['buat'])){

$jumlah = $_POST['jumlah'];
?>

<hr>

<form method="post" id="formData">

<?php
for($i=1; $i <= $jumlah; $i++){
?>

<div class="card">

<h2>Data Pendaftar <?= $i ?></h2>

<div class="grid">

<div class="form-group">
<label>Kode Pendaftaran</label>
<input type="text" name="kode[]" placeholder="A2-1010-9" required>
</div>

<div class="form-group">
<label>Nama Pendaftar</label>
<input type="text" name="nama[]" required>
</div>

<div class="form-group">
<label>Jenis Kelamin</label>

<div class="radio-group">

<label>
<input type="radio" name="jk[<?= $i ?>]" value="Laki-laki" required>
Laki-laki
</label>

<label>
<input type="radio" name="jk[<?= $i ?>]" value="Perempuan">
Perempuan
</label>

</div>

</div>

<div class="form-group">
<label>Tempat Lahir</label>
<input type="text" name="tempat[]" required>
</div>

<div class="form-group">
<label>Tanggal Lahir</label>
<input type="date" name="tanggal[]" required>
</div>

<div class="form-group">
<label>Asal Sekolah</label>
<input type="text" name="asal[]" required>
</div>

<div class="form-group">
<label>Pekerjaan Orang Tua</label>
<input type="text" name="ortu[]" required>
</div>

</div>

<h3>Nilai Tes</h3>

<div class="grid">

<div class="form-group">
<label>Matematika</label>
<input type="number" name="mtk[]" min="0" max="100" required>
</div>

<div class="form-group">
<label>Bahasa Inggris</label>
<input type="number" name="bing[]" min="0" max="100" required>
</div>

<div class="form-group">
<label>Pengetahuan Umum</label>
<input type="number" name="umum[]" min="0" max="100" required>
</div>

</div>

</div>

<?php
}
?>

<div class="button-group">

<button type="submit" name="simpan">
Simpan Data
</button>

<button type="reset" class="reset">
Reset
</button>

<button type="button" onclick="window.print()" class="print">
Print
</button>

</div>

</form>

<?php
}
?>

<?php

if(isset($_POST['simpan'])){

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$tempat = $_POST['tempat'];
$tanggal = $_POST['tanggal'];
$asal = $_POST['asal'];
$ortu = $_POST['ortu'];

$mtk = $_POST['mtk'];
$bing = $_POST['bing'];
$umum = $_POST['umum'];

$jumlahLulus = 0;
$jumlahCadangan = 0;
$jumlahTidak = 0;

?>

<hr>

<h2>Hasil Data Pendaftaran</h2>

<div class="table-responsive">

<table>

<tr>
<th>KODE PENDAFTARAN</th>
<th>NAMA PENDAFTAR</th>
<th>TEMPAT LAHIR</th>
<th>JK</th>
<th>TANGGAL LAHIR</th>
<th>PEKERJAAN ORANG TUA</th>
<th>TEMPAT TES</th>
<th>BULAN TES</th>
<th>MTK</th>
<th>B. INGGRIS</th>
<th>P. UMUM</th>
<th>NILAI RATA-RATA</th>
<th>KETERANGAN</th>
</tr>

<?php

for($i=0; $i < count($nama); $i++){

/* =========================
   HITUNG RATA-RATA
========================= */

$rata = ($mtk[$i] + $bing[$i] + $umum[$i]) / 3;

/* =========================
   TEMPAT TES
========================= */

$kodeAwal = strtoupper(substr($kode[$i],0,1));

if($kodeAwal == "A"){
    $tempatTes = "Gedung A";
}
elseif($kodeAwal == "B"){
    $tempatTes = "Gedung B";
}
elseif($kodeAwal == "V"){
    $tempatTes = "Viktor";
}
else{
    $tempatTes = "Tidak Diketahui";
}

/* =========================
   BULAN TES
========================= */

$bulanAngka = (int) substr($kode[$i], -1);

$bulanList = [
    1 => "Januari",
    2 => "Februari",
    3 => "Maret",
    4 => "April",
    5 => "Mei",
    6 => "Juni",
    7 => "Juli",
    8 => "Agustus",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember"
];

$bulanTes = isset($bulanList[$bulanAngka])
            ? $bulanList[$bulanAngka]
            : "Tidak Valid";

/* =========================
   KETERANGAN
========================= */

if($rata >= 80){

    $ket = "Lulus";
    $jumlahLulus++;

}
elseif($rata >= 60){

    $ket = "Cadangan";
    $jumlahCadangan++;

}
else{

    $ket = "Tidak Lulus";
    $jumlahTidak++;

}

?>

<tr>

<td><?= $kode[$i] ?></td>

<td><?= $nama[$i] ?></td>

<td><?= $tempat[$i] ?></td>

<td><?= $jk[$i+1] ?></td>

<td><?= $tanggal[$i] ?></td>

<td><?= $ortu[$i] ?></td>

<td><?= $tempatTes ?></td>

<td><?= $bulanTes ?></td>

<td><?= $mtk[$i] ?></td>

<td><?= $bing[$i] ?></td>

<td><?= $umum[$i] ?></td>

<td><?= number_format($rata,2) ?></td>

<td>

<?php

if($ket == "Lulus"){

    echo "<span class='success'>$ket</span>";

}
elseif($ket == "Cadangan"){

    echo "<span class='warning'>$ket</span>";

}
else{

    echo "<span class='danger'>$ket</span>";

}

?>

</td>

</tr>

<?php
}
?>

</table>

</div>

<div class="summary">

<h3>Statistik Peserta</h3>

<p>✅ Lulus : <?= $jumlahLulus ?></p>

<p>🟡 Cadangan : <?= $jumlahCadangan ?></p>

<p>❌ Tidak Lulus : <?= $jumlahTidak ?></p>

</div>

<?php
}
?>

</div>

<script src="js/script.js"></script>

</body>
</html>