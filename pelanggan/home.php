<div class="page-header">
<!DOCTYPE html>
<html>
<h2> Welcome Our Customers To Cheverse Motor Rent </h2>
<style>
h2 {text-align: center;}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-content w3-section" style="max-width:500px">
  <img class="mySlides w3-animate-fading" src="assets/img/02.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="assets/img/03.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 9000);    
}
</script>

</body>
</html></div>

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


<script type="text/javascript">
$(document).ready(function(){
	$(".fancybox").fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		iframe : {
			preload: false
		}
	});
	$(".various").fancybox({
		maxWidth    : 800,
		maxHeight    : 600,
		fitToView    : false,
		width        : '70%',
		height        : '70%',
		autoSize    : false,
		closeClick    : false,
		openEffect    : 'none',
		closeEffect    : 'none'
	});
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
});
</script>
