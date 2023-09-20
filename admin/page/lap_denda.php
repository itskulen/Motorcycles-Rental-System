<div class="pagetitle">
	<h1>Laporan Denda</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active">Laporan Denda</li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Laporan Denda</h5>
				<!-- General Form Elements -->
				<form class="form-inline hidden-print" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="start">
						</div>
					</div>

					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Akhir</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="stop">
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
				<h5 class="card-title">Laporan Denda</h5>
				<!-- Table with stripped rows -->
				<table class="table datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Pelanggan</th>
							<th>Tanggal Ambil</th>
							<th>Tanggal Kembali</th>
							<th>Terlambat</th>
							<th>Total Harga</th>
							<th>Denda</th>

						</tr>
					</thead>
					<tbody>
					<?php 
					$start = '';
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
								$start = $_POST['start'];
								$stop = $_POST['stop'];
						?>
						<?php $no = 1; ?>
						<?php if ($query = $connection->query("SELECT p.nama, t.total_harga, t.denda, t.tgl_sewa, t.tgl_ambil, t.tgl_kembali, (TIMESTAMPDIFF(HOUR, ADDDATE(t.tgl_ambil, INTERVAL t.lama DAY), t.tgl_kembali)) AS terlambat FROM transaksi t JOIN pelanggan p USING(id_pelanggan) WHERE t.denda != 0 AND t.tgl_sewa BETWEEN '$start' AND '$_POST[stop]'")) : ?>
							<?php while ($row = $query->fetch_assoc()) : ?>
								<tr>
									<td><?= $start ?></td>
									<td><?= $row['nama'] ?></td>
									<td><?= date("d-m-Y H:i:s", strtotime($row['tgl_ambil'])) ?></td>
									<td><?= date("d-m-Y H:i:s", strtotime($row['tgl_kembali'])) ?></td>
									<td><?= $row['terlambat'] ?> jam</td>
									<td>Rp.<?= number_format($row['total_harga']) ?>,-</td>
									<td>Rp.<?= number_format($row['denda']) ?>,-</td>
								</tr>
							<?php endwhile ?>
						<?php endif ?>
						<?php 	} ?>
					</tbody>
				</table>
				<!-- End Table with stripped rows -->
				
			</div>

		</div>
	</div>
</div>
<?php endif; ?>
