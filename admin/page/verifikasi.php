<?php 
$update = (isset($_GET['action']) and $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = "UPDATE transaksi SET verifikasi='1' WHERE id_transaksi  = '$_GET[key]'";
    if ($connection->query($sql)) {
		echo alert("Berhasil!", "?page=verifikasi");
	} else {
		echo alert("Gagal!", "?page=verifikasi");
	}
}
?>
<div class="pagetitle">
    <h1>Verifikasi Data Pelanggan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Verifikasi</li>
        </ol>
    </nav>
</div><!-- End Page Title -->



<div class="row">
    <div class="col-lg-12">

        <div class="card" id="lap">
            <div class="card-body">
                <h5 class="card-title">Verifikasi</h5>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tgl Sewa</th>
                            <th>Lama Sewa</th>
                            <th class="hidden-print"></th>
                        </tr>
                    </thead>
                    <tbody>

                            <?php $no = 1; ?>
                            <?php if ($query = $connection->query("SELECT * FROM transaksi JOIN pelanggan USING(id_pelanggan) WHERE verifikasi = '0'")) : ?>
                                <?php while ($row = $query->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= date("d-m-Y H:i:s", strtotime($row['tgl_sewa'])) ?></td>
                                        <td><?= $row['lama'] ?> Hari</td>
                                        <td class="hidden-print">
                                        <a href="?page=verifikasi&action=update&key=<?= $row['id_transaksi'] ?>" class="btn btn-warning btn-xs">Verifikasi Transaksi</a>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php endif ?>
                            
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                
            </div>

        </div>
    </div>
</div>