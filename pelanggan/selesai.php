<?php
if (!isset($_SESSION["pelanggan"])) {
  header('location: login.php');
  exit;
}

$tgl_ambil   = $_POST["thn"]."-".$_POST["bln"]."-".$_POST["tgl"]." ".date("H:i:s");

// Validasi
$sql = $connection->query("SELECT a.id_motor, a.tgl_ambil, a.lama FROM transaksi a WHERE a.id_motor=$_POST[id_motor] AND a.status='0'");
if ($sql->num_rows) {
    $d = $sql->fetch_assoc();
    $sql = "SELECT
      (SELECT ((
        DATEDIFF(ADDDATE('$tgl_ambil', INTERVAL $_POST[lama] DAY), ADDDATE('$d[tgl_ambil]', INTERVAL $d[lama] DAY))
      )) FROM transaksi WHERE id_motor=$d[id_motor] LIMIT 1) AS a,
      (SELECT ((
        DATEDIFF(ADDDATE('$d[tgl_ambil]', INTERVAL $d[lama] DAY), ADDDATE('$tgl_ambil', INTERVAL $_POST[lama] DAY))
      )) FROM transaksi WHERE id_motor=$d[id_motor] LIMIT 1) AS b";
    $s = $connection->query($sql);
    $a = $s->fetch_assoc();
    if ($a["a"] == 0 AND $a["b"] == 0) {
        echo alert("Maaf, motor yang anda sewa sudah di pesan!");
        exit;
    }
}
$query = $connection->query("SELECT * FROM motor WHERE id_motor=$_POST[id_motor]");
$data  = $query->fetch_assoc();


$id          = $_SESSION["pelanggan"]["id"]; // id user yang sedang login
$jatuhtempo  = date('Y-m-d H:i:s', strtotime('+3 hours')); //jam skrg + 3 jam
$totalbayar  = ($data["harga"] * $_POST["lama"]);


$connection->query("INSERT INTO transaksi VALUES (NULL, $id, $_POST[id_motor], '$now', '$tgl_ambil', NULL, $_POST[lama], $totalbayar, '0', '$_POST[jaminan]', NULL, '$jatuhtempo','0', '0', '0')");
$idtransaksi = $connection->insert_id;


?>

<div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Informasi Transaksi </h3></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>: <?=$_SESSION["pelanggan"]["nama"]?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: <?=$_SESSION["pelanggan"]["email"]?></td>
                </tr>
                <tr>
                    <th>Harga Sewa</th>
                    <td>: Rp.<?=number_format($data["harga"])?>,-/hari</td>
                </tr>
                <tr>
                    <th>Lama Sewa</th>
                    <td>: <?=$_POST["lama"]?> hari</td>
                </tr>
                <tr>
                    <th>Tanggal Ambil</th>
                    <td>: <?=date("d-m-Y H:i:s", strtotime($tgl_ambil))?></td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>: Rp.<?=number_format($totalbayar)?>,-</td>
                </tr>
                <tr>
                    <th>Jatuh Tempo pembayaran</th>
                    <td>: <?=date("d-m-Y H:i:s", strtotime($jatuhtempo))?></td>
                </tr>
                <tr>
                    <th>Jaminan</th>
                    <td>: <?=$_POST["jaminan"]?></td>
                </tr>
            </thead>
        </table>
        <hr>
        <h3>Terimakasih</h3>
        <p>
            Transaksi Anda sedang diproses<br>
            Mohon menunggu proses verifikasi data. <br>
            <strong>(20-03-11-00-9 a/n Cheverse Motor Rent)</strong> Apabila sudah terverifikasi silahkan mengirimkan bukti transfer
        </p>
        <p>
        Apabila sudah terverifikasi silahkan mengirimkan bukti transfer pembayaran dengan mengunjungi halaman profil akun anda lalu tekan tombol konfirmasi. <i><b>Lihat Profil</b></i>.
        </p>
        <p> Batas Konfirmasi 3 jam, jika lebih dari 3 jam anda tidak melakukan konfirmasi maka sistem akan membatalkan pesanan secara otomatis.
        </p>
    </div>
    <div class="panel-footer">
        <a href="?page=profil" class="btn btn-primary btn-sm">Lihat Profil</a>
    </div>
</div>
<style>
        body {
            margin-top: 40px;
            background-image:url(assets/img/bg1.jpg);
            background-size:cover;
        }
    </style>
