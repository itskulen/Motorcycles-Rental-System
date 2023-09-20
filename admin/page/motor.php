<?php
$update = (isset($_GET['action']) and $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM motor WHERE id_motor='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$err = false;
	$file = $_FILES['gambar']['name'];
	if ($update) {
		if ($file) {
			$x = explode('.', $_FILES['gambar']['name']);
			$file_name = date("dmYHis") . "." . strtolower(end($x));
			if (!move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/motor/" . $file_name)) {
				echo alert("Upload File Gagal!", "?page=motor");
				$err = true;
			}
			@unlink("../assets/img/motor/" . $row["gambar"]);
		} else {
			$file_name = $row["gambar"];
		}
	} else {
		if (!$file) {
			echo alert("File gambar tidak ada!", "?page=motor");
			$err = true;
		}
		$x = explode('.', $_FILES['gambar']['name']);
		$file_name = date("dmYHis") . "." . strtolower(end($x));
		if (!move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/motor/" . $file_name)) {
			echo alert("Upload File Gagal!", "?page=motor");
			$err = true;
		}
	}
	if ($update) {
		$sql = "UPDATE motor SET id_jenis='$_POST[id_jenis]', no_motor='$_POST[no_motor]', merk='$_POST[merk]', nama_motor='$_POST[nama_motor]', gambar='$file_name', harga='$_POST[harga]', status='$_POST[status]' WHERE id_motor='$_GET[key]'";
	} else {
		$sql = "INSERT INTO motor VALUES (NULL, '$_POST[id_jenis]', '$_POST[no_motor]', '$_POST[merk]', '$_POST[nama_motor]', '$file_name', '$_POST[harga]', '$_POST[status]')";
	}
	if (!$err) {
		if ($connection->query($sql)) {
			echo alert("Berhasil!", "?page=motor");
		} else {
			echo alert("Gagal!", "?page=motor");
		}
	}
}
if (isset($_GET['action']) and $_GET['action'] == 'delete') {
	$connection->query("DELETE FROM motor WHERE id_motor='$_GET[key]'");
	echo alert("Berhasil!", "?page=motor");
}
?>
<div class="pagetitle">
	<h1>Data Motor</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item active">Motor</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?= ($update) ? "EDIT" : "Tambah" ?> Motor</h5>
				<!-- General Form Elements -->
				<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST" enctype="multipart/form-data">
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Jenis</label>
						<div class="col-sm-10">
							<select class="form-select" aria-label="Default select example" name="id_jenis">
								<option>---</option>
								<?php $query = $connection->query("SELECT * FROM jenis");
								while ($data = $query->fetch_assoc()) : ?>
									<option value="<?= $data["id_jenis"] ?>" <?= (!$update) ?: (($row["id_jenis"] != $data["id_jenis"]) ?: 'selected="on"') ?>><?= $data["nama"] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">No Plat</label>
						<div class="col-sm-10">
							<input type="text" name="no_motor" class="form-control" <?= (!$update) ?: 'value="' . $row["no_motor"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Nama motor</label>
						<div class="col-sm-10">
							<input type="text" name="nama_motor" class="form-control" <?= (!$update) ?: 'value="' . $row["nama_motor"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Merk</label>
						<div class="col-sm-10">
							<input type="text" name="merk" class="form-control" <?= (!$update) ?: 'value="' . $row["merk"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
						<div class="col-sm-10">
							<input type="file" name="gambar" class="form-control">
							<?php if ($update) : ?>
								<span class="help-block">* Kosongkan jika tidak diubah</span>
							<?php endif; ?>
						</div>
					</div>
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Harga Sewa</label>
						<div class="col-sm-10">
							<input type="text" name="harga" class="form-control" <?= (!$update) ?: 'value="' . $row["harga"] . '"' ?>>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-sm-2 col-form-label">Status</label>
						<div class="col-sm-10">
							<select class="form-control" name="status">
								<option>---</option>
								<option value="0" <?= (!$update) ?: (($row["status"] != 0) ?: 'selected="on"') ?>>Tidak Tersedia</option>
								<option value="1" <?= (!$update) ?: (($row["status"] != 1) ?: 'selected="on"') ?>>Tersedia</option>
							</select>
						</div>
					</div>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-<?= ($update) ? "warning" : "primary" ?> btn-block">Simpan</button>
						<?php if ($update) : ?>
							<a href="?page=motor" class="btn btn-info btn-block">Batal</a>
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
				<h5 class="card-title">Daftar motor</h5>
				<!-- Table with stripped rows -->
				<table class="table datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis</th>
							<th>No Plat</th>
							<th>Nama</th>
							<th>Merk</th>
							<th>Harga</th>
							<th>Status</th>
							<th class="hidden-print"></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						<?php if ($query = $connection->query("SELECT * FROM motor JOIN jenis USING(id_jenis)")) : ?>
							<?php while ($row = $query->fetch_assoc()) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $row['nama'] ?></td>
									<td><?= $row['no_motor'] ?></td>
									<td><?= $row['nama_motor'] ?></td>
									<td><?= $row['merk'] ?></td>
									<td><?= $row['harga'] ?></td>
									<td><span class="label label-<?= ($row['status']) ? "success" : "danger" ?>"><?= ($row['status']) ? "Tersedia" : "Tidak Tersedia" ?></span></td>
									<td class="hidden-print">
										<div class="btn-group">
											<a href="../assets/img/motor/<?= $row['gambar'] ?>" class="btn btn-info btn-xs fancybox">Lihat</a>
											<a href="?page=motor&action=update&key=<?= $row['id_motor'] ?>" class="btn btn-warning btn-xs">Edit</a>
											<a href="?page=motor&action=delete&key=<?= $row['id_motor'] ?>" class="btn btn-danger btn-xs">Hapus</a>
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

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			openEffect: 'none',
			closeEffect: 'none',
			iframe: {
				preload: false
			}
		});
		$(".various").fancybox({
			maxWidth: 800,
			maxHeight: 600,
			fitToView: false,
			width: '70%',
			height: '70%',
			autoSize: false,
			closeClick: false,
			openEffect: 'none',
			closeEffect: 'none'
		});
		$('.fancybox-media').fancybox({
			openEffect: 'none',
			closeEffect: 'none',
			helpers: {
				media: {}
			}
		});
	});
</script>