<div class="pagetitle">
	<h1>Laporan Motor Terlaris</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item active">Laporan Motor Terlaris</li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Laporan Motor Terlaris</h5>
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

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Laporan Motor Terlaris</h5>
					<!-- Table with stripped rows -->
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Nomor</th>
								<th>Merk</th>
								<th>Total Penyewa</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php if ($query = $connection->query("SELECT m.no_motor, m.merk, m.nama_motor, (SELECT COUNT(*) FROM transaksi WHERE id_motor=t.id_motor) AS jml FROM transaksi t JOIN motor m USING(id_motor) WHERE t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")) : ?>
								<?php while ($row = $query->fetch_assoc()) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $row['nama_motor'] ?></td>
										<td><?= $row['no_motor'] ?></td>
										<td><?= $row['merk'] ?></td>
										<td><?= $row['jml'] ?></td>
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
			<h3 class="text-center">Laporan Terlaris</h3>
		</div>
		<div class="panel-body">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Nomor</th>
						<th>Merk</th>
						<th>Total Penyewa</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php if ($query = $connection->query("SELECT m.no_motor, m.merk, m.nama_motor, (SELECT COUNT(*) FROM transaksi WHERE id_motor=t.id_motor) AS jml FROM transaksi t JOIN motor m USING(id_motor) WHERE t.tgl_sewa BETWEEN '$_POST[start]' AND '$_POST[stop]'")) : ?>
						<?php while ($row = $query->fetch_assoc()) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row['nama_motor'] ?></td>
								<td><?= $row['no_motor'] ?></td>
								<td><?= $row['merk'] ?></td>
								<td><?= $row['jml'] ?></td>
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
<?php endif; ?> -->