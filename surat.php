<?php
include "koneksi.php";

$Nomor = $_GET['Nomor'];
$query = mysqli_query($connect, "SELECT * FROM data Where Nomor = $Nomor") or die(mysqli_error($connect));
$pecah = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Login page for DAP project" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- CSS End -->

    <link rel="icon" href="dap.png" />
    <title>FSKP DAP</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 40px; }
        .content { text-align: justify; line-height: 1.6; }
        .ttd { margin-top: 60px; width: 100%; }
        .ttd .right { float: right; text-align: center; }
        @media print { .no-print { display: none;} }
    </style>
</head>
<body>

<div class="header">
    <h2 class="display-4">Formulir Pertimbangan</h2>
    <h4 class="lead">Penilaian Kinerja JF Ahli Madya</h4>
</div>

<div class="content">
    <p>Saya yang bertanda tangan di bawah ini:</p>
    <table>
        <tr><td>Nama</td><td>:</td><td><?php echo $pecah['Nama']; ?></td></tr>
        <tr><td>NIP</td><td>:</td><td><?php echo $pecah['NIP']; ?></td></tr>
        <tr><td>Jabatan</td><td>:</td><td><?php echo $pecah['Jabatan']; ?></td></tr>
        <tr><td>Bidang</td><td>:</td><td><?php echo $pecah['Bidang']; ?></td></tr>
        <tr><td>Periode</td><td>:</td><td><?php echo $pecah['Periode']; ?></td></tr>
        <tr><td>Status</td><td>:</td><td><?php echo $pecah['status']; ?></td></tr>
    </table>

</div>

<section>
<div class="ttd container">
    <div class="row">
        <div class="col-sm left">
            <br>
            Kepala Bidang<br><br><br><br>
            <u><?php echo $pecah['Kabid']; ?></u><br>
            <?php 
            if ($pecah['Kabid']=="Sosy Findra, S.Kom"){ echo "196707241999031006";} 
            if ($pecah['Kabid']=="Kiswati SS,MPA"){echo "196808151999032001";} 
            if ($pecah['Kabid']=="Dian Dewi Kartika, S.Sos, M.Si") {echo "197209231992022001";}
            if ($pecah['Kabid']=="Fajri Rahmad Ersya, S.STP, M.Si") {echo "199203242014061003";} 
            ?>
        </div>
        <div class="col-sm right">
            Padang, <?php echo date("d F Y"); ?><br>
            Yang mengajukan,<br><br><br><br>
            <u><?php echo $pecah['Nama']; ?></u><br>
            <?php echo $pecah['NIP']; ?>
        </div>
    </div>
</div>
</section>

<div class="no-print" style="margin-top: 50px;">
    <button class="btn btn-success" onclick="window.print()">Cetak Surat</button>
</div>

</body>
</html>
