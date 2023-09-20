<?php
if (!isset($_SESSION["pelanggan"])) {
  header('location: login.php');
  exit;
}
?>
<div class="panel panel-info">
    <div class="panel-heading"><h3 class="text-center">Sewa</h3></div>
    <div class="panel-body">
        <form action="?page=selesai" method="POST">
            <input type="hidden" name="id_motor" value="<?=$_GET["id"]?>">
            <div class="form-group">
                <label for="lama">Lama Sewa</label>
                <select name="lama" class="form-control">
                    <?php for ($i=1; $i<=7; $i++): ?>
                      <option value="<?=$i?>"><?=$i?> Hari</option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Ambil</label>
                <!-- <input type="text" name="ambil" class="form-control"> -->
                <div class="row">
                  <div class="col-md-4">
                    <select name="thn" class="form-control" required="on">
                        <option>-- Tahun --</option>
                        <?php for ($i=2023; $i<=2030; $i++): ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select name="bln" class="form-control" required="on">
                        <option>-- Bulan --</option>
                        <?php for ($i=1; $i<=12; $i++): ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor; ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select name="tgl" class="form-control" required="on">
                        <option>-- Tanggal --</option>
                        <?php for ($i=1; $i<=31; $i++): ?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor; ?>
                    </select>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label for="jaminan">Jaminan</label>
                <select name="jaminan" class="form-control">
                    <option value="STNK">STNK</option>
                    <option value="KTP">KTP</option>
                    <option value="Pasport">Pasport</option>
                    <option value="NPWP">NPWP</option>
                    <option value="SIM A">SIM A</option>
                    <option value="Sertifikat Rumah">Sertifikat Rumah</option>
                </select>
            </div>
            <button type="submit" class="btn btn-info btn-block">NEXT!</button>
        </form>
    </div>
</div>
<style>
        body {
            margin-top: 40px;
            background-image:url(assets/img/bg1.jpg);
            background-size:cover;
        }
    </style>
