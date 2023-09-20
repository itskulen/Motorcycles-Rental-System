<?php
if (isset($_GET["action"])) {
	$now = date("Y-m-d H") . ":00:00";
	$sql = "UPDATE transaksi";
	if ($_GET["action"] == "ambil") {
		$sql .= " SET tgl_ambil='$now'";
	} elseif ($_GET["action"] == "kembali") {
		$query = $connection->query("SELECT * FROM transaksi WHERE id_transaksi=$_GET[key]");
		$r = $query->fetch_assoc();

		$sql .= " SET tgl_kembali='$now', status='1'";
		var_dump($r);
		$connection->query("UPDATE motor SET status='1' WHERE id_motor=" . $r["id_motor"]);
		// $connection->query("UPDATE supir SET status='1' WHERE id_supir=" . $r["id_supir"]);
	}
	$sql .= " WHERE id_transaksi=$_GET[key]";
	if ($connection->query($sql)) {
		echo alert("Berhasil", "?page=lap_perperiode");
	}
}
?>
<div class="pagetitle">
	<h1>Laporan Periode</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active">Laporan Perperiode</li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Laporan Perperiode</h5>
				<!-- General Form Elements -->
				<form class="form-inline hidden-print" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="start">
						</div>
					</div>

					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Akhir</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="stop">
						</div>
					</div>

					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
					</div>
				</form><!-- End General Form Elements -->

			</div>
		</div>

	</div>
</div>

<br>
<?php if ($_POST) : ?>
	<div class="row">
		<div class="col-lg-12">

			<div class="card" id="lap">
				<div class="card-body">
					<h5 class="card-title">Laporan Perperiode</h5>
					<!-- Table with stripped rows -->
					<table class="table datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pelanggan</th>
								<th>Nama Mobil</th>
								<th>Nomor Mobil</th>
								<th>Tanggal Sewa</th>
								<th>Tanggal Ambil</th>
								<th>Tanggal Kembali</th>
								<th>Lama Sewa</th>
								<th>Total Harga</th>
								<th class="hidden-print"></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php if ($query = $connection->query("SELECT * FROM transaksi t JOIN motor m USING(id_motor) JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan")) : ?>
								<?php while ($row = $query->fetch_assoc()) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $row['nama'] ?></td>
										<td><?= $row['nama_motor'] ?></td>
										<td><?= $row['no_motor'] ?></td>
										<td><?= date("d-m-Y H:i:s", strtotime($row['tgl_sewa'])) ?></td>
										<td><?= ($row['tgl_ambil']) ? date("d-m-Y H:i:s", strtotime($row['tgl_ambil'])) : "<b>Belum Diambil</b>" ?></td>
										<td><?= ($row['tgl_kembali']) ? date("d-m-Y H:i:s", strtotime($row['tgl_kembali'])) : "<b>Belum Dikembalikan</b>" ?></td>
										<td><?= $row['lama'] ?> Hari</td>
										<td>Rp.<?= number_format($row['total_harga']) ?>,-</td>
										<td class="hidden-print">
											<div class="btn-group">
												<?php //if (($row["konfirmasi"] == 1) AND ($row["tgl_ambil"] == NULL) AND ($row["tgl_kembali"] == NULL)): 
												?>
												<!-- <a href="?page=lap_perperiode&action=ambil&key=<? //=$row['id_transaksi']
																									?>" class="btn btn-success btn-xs">Ambil</a> -->
												<?php //endif; 
												?>
												
											</div>
										</td>
									</tr>
								<?php endwhile ?>
							<?php endif ?>
						</tbody>
					</table>
					<!-- End Table with stripped rows -->
					<div class="panel-footer hidden-print ">
						<button id="print" class="btn btn-primary" onclick="">Print</button>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endif; ?>

<!-- <form class="form-inline hidden-print" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
	<label>Periode</label>
	<input type="text" class="form-control" name="start">
	<label>s/d</label>
	<input type="text" class="form-control" name="stop">
	<button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
</form>
<br>
<?php if ($_POST) : ?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="text-center">LAPORAN PENYEWAAN PERPERIODE</h3><br>
			<h4 class="text-center"><?= $_POST["start"] . " s/d " . $_POST["stop"] ?></h4>
		</div>
		<div class="panel-body">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pelanggan</th>
						<th>Nama Mobil</th>
						<th>Nomor Mobil</th>
						<th>Tanggal Sewa</th>
						<th>Tanggal Ambil</th>
						<th>Tanggal Kembali</th>
						<th>Lama Sewa</th>
						<th>Total Harga</th>
						<th class="hidden-print"></th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php if ($query = $connection->query("SELECT * FROM transaksi t JOIN motor m USING(id_motor) JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan WHERE t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")) : ?>
						<?php while ($row = $query->fetch_assoc()) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['nama'] ?></td>
								<td><?= $row['nama_motor'] ?></td>
								<td><?= $row['no_motor'] ?></td>
								<td><?= date("d-m-Y H:i:s", strtotime($row['tgl_sewa'])) ?></td>
								<td><?= ($row['tgl_ambil']) ? date("d-m-Y H:i:s", strtotime($row['tgl_ambil'])) : "<b>Belum Diambil</b>" ?></td>
								<td><?= ($row['tgl_kembali']) ? date("d-m-Y H:i:s", strtotime($row['tgl_kembali'])) : "<b>Belum Dikembalikan</b>" ?></td>
								<td><?= $row['lama'] ?> Hari</td>
								<td>Rp.<?= number_format($row['total_harga']) ?>,-</td>
								<td class="hidden-print">
									<div class="btn-group">
										<?php //if (($row["konfirmasi"] == 1) AND ($row["tgl_ambil"] == NULL) AND ($row["tgl_kembali"] == NULL)): 
										?>
										<!-- <a href="?page=lap_perperiode&action=ambil&key=<? //=$row['id_transaksi']
																							?>" class="btn btn-success btn-xs">Ambil</a> -->
<?php //endif; 
?>
<?php if ($row["konfirmasi"] and $row["tgl_kembali"] == NULL) : ?>
	<a href="?page=lap_perperiode&action=kembali&key=<?= $row['id_transaksi'] ?>" class="btn btn-primary btn-xs">Dikembalikan</a>
<?php endif; ?>
</div>
</td>
</tr>
<?php endwhile ?>
<?php endif ?>
</tbody>
</table>
</div>
<div class="panel-footer hidden-print">
	<a onClick="window.print();return false" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
</div>
</div>
<?php endif; ?>
