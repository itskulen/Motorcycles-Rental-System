<?php
$update = (isset($_GET['action']) and $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE pelanggan SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]', no_telp='$_POST[no_telp]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='" . md5($_POST["password"]) . "'";
		}
		$sql .= " WHERE id_pelanggan='$_GET[key]'";
	} else {
		$sql = "INSERT INTO pelanggan VALUES (NULL, '$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[alamat]', '$_POST[no_telp]', '$_POST[username]', '" . md5($_POST["password"]) . "')";
	}
	if ($connection->query($sql)) {
		echo alert("Berhasil!", "?page=pelanggan");
	} else {
		echo alert("Gagal!", "?page=pelanggan");
	}
}

if (isset($_GET['action']) and $_GET['action'] == 'delete') {
	$connection->query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[key]'");
	echo alert("Berhasil!", "?page=pelanggan");
}
?>
<div class="pagetitle">
	<h1>Data Pelanggan</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item active">Pelanggan</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?= ($update) ? "EDIT" : "Tambah" ?>  Pelanggan</h5>
				<!-- General Form Elements -->
				<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="' . $row["nama"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">No KTP</label>
						<div class="col-sm-10">
							<input type="text" name="no_ktp" class="form-control" <?= (!$update) ?: 'value="' . $row["no_ktp"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Telp</label>
						<div class="col-sm-10">
							<input type="text" name="no_telp" class="form-control" <?= (!$update) ?: 'value="' . $row["no_telp"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="text" name="email" class="form-control" <?= (!$update) ?: 'value="' . $row["email"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="' . $row["alamat"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Username</label>
						<div class="col-sm-10">
							<input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="' . $row["username"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control">
							<?php if ($update) : ?>
								<span class="help-block">*) Kosongkan jika tidak diubah</span>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
						<?php if ($update) : ?>
							<a href="?page=pelanggan" class="btn btn-info btn-block">Batal</a>
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
				<h5 class="card-title">Daftar Pelanggan</h5>
				<!-- Table with stripped rows -->
				<table class="table datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>No KTP</th>
							<th>Telp</th>
							<th>Email</th>
							<th>Username</th>
							<th>Alamat</th>
							<th></th>
							<th class="hidden-print"></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php if ($query = $connection->query("SELECT * FROM pelanggan")) : ?>
							<?php while ($row = $query->fetch_assoc()) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row['nama'] ?></td>
									<td><?= $row['no_ktp'] ?></td>
									<td><?= $row['no_telp'] ?></td>
									<td><?= $row['email'] ?></td>
									<td><?= $row['username'] ?></td>
									<td><?= $row['alamat'] ?></td>
									<td>
									<td class="hidden-print">
										<div class="btn-group">
											<a href="?page=pelanggan&action=update&key=<?= $row['id_pelanggan'] ?>" class="btn btn-warning btn-xs">Edit</a>
											<a href="?page=pelanggan&action=delete&key=<?= $row['id_pelanggan'] ?>" class="btn btn-danger btn-xs">Hapus</a>
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

<!-- <div class="row">
	<div class="col-md-4 hidden-print">

		<div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
			<div class="panel-heading">
				<h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3>
			</div>
			<div class="panel-body">
				<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="' . $row["nama"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="nama">No KTP</label>
						<input type="text" name="no_ktp" class="form-control" <?= (!$update) ?: 'value="' . $row["no_ktp"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="no_telp">Telp</label>
						<input type="text" name="no_telp" class="form-control" <?= (!$update) ?: 'value="' . $row["no_telp"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" class="form-control" <?= (!$update) ?: 'value="' . $row["email"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="' . $row["alamat"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="' . $row["username"] . '"' ?>>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
						<?php if ($update) : ?>
							<span class="help-block">*) Kosongkan jika tidak diubah</span>
						<?php endif; ?>
					</div>
					<button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
					<?php if ($update) : ?>
						<a href="?page=pelanggan" class="btn btn-info btn-block">Batal</a>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="text-center">DAFTAR PELANGGAN</h3>
			</div>
			<div class="panel-body">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Telp</th>
							<th>Email</th>
							<th>Username</th>
							<th>Alamat</th>
							<th></th>
							<th class="hidden-print"></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php if ($query = $connection->query("SELECT * FROM pelanggan")) : ?>
							<?php while ($row = $query->fetch_assoc()) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row['nama'] ?></td>
									<td><?= $row['no_telp'] ?></td>
									<td><?= $row['email'] ?></td>
									<td><?= $row['username'] ?></td>
									<td><?= $row['alamat'] ?></td>
									<td>
									<td class="hidden-print">
										<div class="btn-group">
											<a href="?page=pelanggan&action=update&key=<?= $row['id_pelanggan'] ?>" class="btn btn-warning btn-xs">Edit</a>
											<a href="?page=pelanggan&action=delete&key=<?= $row['id_pelanggan'] ?>" class="btn btn-danger btn-xs">Hapus</a>
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
	</div>
</div> -->