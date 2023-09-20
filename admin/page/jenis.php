<?php
$update = (isset($_GET['action']) and $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM jenis WHERE id_jenis='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE jenis SET nama='$_POST[nama]' WHERE id_jenis='$_GET[key]'";
	} else {
		$sql = "INSERT INTO jenis VALUES (NULL, '$_POST[nama]')";
	}
	if ($connection->query($sql)) {
		echo alert("Berhasil!", "?page=jenis");
	} else {
		echo alert("Gagal!", "?page=jenis");
	}
}
if (isset($_GET['action']) and $_GET['action'] == 'delete') {
	$connection->query("DELETE FROM jenis WHERE id_jenis='$_GET[key]'");
	echo alert("Berhasil!", "?page=jenis");
}
?>
<div class="pagetitle">
	<h1>Data Jenis</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item active">Jenis</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?= ($update) ? "EDIT" : "Tambah" ?>  Jenis Motor</h5>
				<!-- General Form Elements -->
				<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">

					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="' . $row["nama"] . '"' ?>>
						</div>
					</div>

					<div class="col-sm-10">
						<button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
						<?php if ($update) : ?>
							<a href="?page=jenis" class="btn btn-info btn-block">Batal</a>
						<?php endif; ?>
					</div>
				</form><!-- End General Form Elements -->

			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Daftar Jenis</h5>
				<!-- Table with stripped rows -->
				<table class="table datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php if ($query = $connection->query("SELECT * FROM jenis")) : ?>
							<?php while ($row = $query->fetch_assoc()) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row['nama'] ?></td>
									<td class="hidden-print">
										<div class="btn-group">
											<a href="?page=jenis&action=update&key=<?= $row['id_jenis'] ?>" class="btn btn-warning btn-xs">Edit</a>
											<a href="?page=jenis&action=delete&key=<?= $row['id_jenis'] ?>" class="btn btn-danger btn-xs">Hapus</a>
										</div>
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

