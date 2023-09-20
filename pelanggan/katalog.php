<div class="row">
	<?php $query = $connection->query("SELECT * FROM motor JOIN jenis USING(id_jenis)"); while ($row = $query->fetch_assoc()): ?>
		<div class="col-xs-6 col-md-3">
			<div class="thumbnail">
				<a href="assets/img/motor/<?=$row['gambar']?>" class="fancybox">
				<img src="assets/img/motor/<?=$row['gambar']?>" style="height:250px; width:100%">
			</a>
	      <div class="caption text-center">
	        <h4><?=$row["nama_motor"]?></h4>
	        <h5>Rp.<?=$row["harga"]?>,- <?=$row["nama"]?> - <?=$row["merk"]?></h5>
	        <h6><?=$row["no_motor"]?></h6>
			<span class="label label-<?=($row['status']) ? "success" : "danger" ?>"><?=($row['status']) ? "Tersedia" : "Tidak Tersedia" ?></span>
	        <p>
				<br>
				<a href="<?=($row['status']) ? "?page=transaksi&id=$row[id_motor]" : "#" ?>" class="btn btn-primary" <?=($row['status']) ?: "disabled" ?>>Sewa Sekarang!</a>
			</p>
	      </div>
	    </div>
	  </div>
	<?php endwhile; ?>
</div>

<style>
        body {
            margin-top: 40px;
            background-image:url(assets/img/bg1.jpg);
            background-size:cover;
        }
    </style>