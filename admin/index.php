<?php
session_start();
require_once "../config.php";
if (!isset($_SESSION["admin"])) {
  if (!isset($_SESSION["pemilik"])) {
    header('location: login.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">  Cheverse Motor Rent</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php if (isset($_SESSION["admin"])) { ?>
                Admin
              <?php } ?>

              <?php if (isset($_SESSION["pemilik"])) { ?>
                Pemilik
              <?php } ?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <?php if (isset($_SESSION["admin"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=pelanggan">
            <i class="bi bi-person"></i>
            <span>Pelanggan</span>
          </a>
        </li><!-- End Profile Page Nav -->
      <?php } ?>

      <?php if (isset($_SESSION["admin"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=jenis">
            <i class="bi bi-card-list"></i>
            <span>Jenis</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->
      <?php } ?>

      <?php if (isset($_SESSION["admin"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=motor">
            <i class="bi bi-question-circle"></i>
            <span>Motor</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->
      <?php } ?>

      <?php if (isset($_SESSION["admin"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=verifikasi">
            <i class="bi bi-question-circle"></i>
            <span>Verifikasi</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->
      <?php } ?>


      <?php if (isset($_SESSION["pemilik"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=lap_terlaris">
            <i class="bi bi-card-list"></i>
            <span>Laporan Motor Terlaris</span>
          </a>
        </li><!-- End Register Page Nav -->
      <?php } ?>


      <?php if (isset($_SESSION["pemilik"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=lap_denda">
            <i class="bi bi-card-list"></i>
            <span>Laporan Denda</span>
          </a>
        </li><!-- End Register Page Nav -->
      <?php } ?>


      <?php if (isset($_SESSION["pemilik"])) { ?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="?page=lap_perperiode">
            <i class="bi bi-card-list"></i>
            <span>Laporan Sewa Perperiode</span>
          </a>
        </li><!-- End Register Page Nav -->
      <?php } ?>


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="row">
      <div class="col-md-12">
        <?php include adminPage($_ADMINPAGE); ?>
      </div>
    </div>

  </main><!-- End #main -->


  <?php if (isset($_SESSION["admin"])) { ?>
  <div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Log Transaski Berlangsung</h5>
				<!-- General Form Elements -->
				<form class="form-inline hidden-print" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post">
					<div class="row mb-3">
						<label for="nama" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="start">
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
					<h5 class="card-title">Log Transaski Berlangsung</h5>
					<!-- Table with stripped rows -->
					<table class="table datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pelanggan</th>
								<th>Nama motor</th>
								<th>Nomor motor</th>
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
<?php endif; ?>
<?php } ?>







  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    let btn = document.getElementById('print');
    console.log(btn);
    btn.addEventListener("click", print);

    function print() {
      var prtContent = document.getElementById("lap");
      var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
      WinPrint.document.write('<link rel=stylesheet href=assets/css/style.css>');
      WinPrint.document.write('<link rel=stylesheet href=assets/vendor/bootstrap/css/bootstrap.min.css>');
      WinPrint.document.write('<link rel=stylesheet href=assets/vendor/simple-datatables/style.css>');
      WinPrint.document.write(prtContent.innerHTML);
      WinPrint.document.close();
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    }
  </script>

</body>

</html>