<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHEVERSE MOTOR RENT</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <!-- Optional, Add fancyBox for media, buttons, thumbs -->
    <link rel="stylesheet" href="assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <script type="text/javascript" src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script><!-- Optional, Add mousewheel effect -->
    <script type="text/javascript" src="assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <style>
           .container {
            margin-top: 20px;
        }
        .footer {
            padding: 10px 0 10px 0;
            background-color: #35404f;
            color: #878c94;
        }

        .footer .title {
            text-align: left;
            color: #fff;
            font-size: 25px;
        }

        .footer .category a {
            text-decoration: none;
            color: #fff;
            display: inline-block;
            padding: 5px 20px;
            margin: 1px;
            border-radius: 4px;
            margin-top: 6px;
            background-color: black;
            border: solid 1px #fff;
        }

        .footer .payment {
            margin: 0px;
            padding: 0px;
            list-style-type: none
        }

        .footer .payment li {
            list-style-type: none
        }

        .footer .payment li a {
            text-decoration: none;
            display: inline-block;
            color: #fff;
            float: left;
            font-size: 25px;
            padding: 10px 10px;
        }
    </style>
</head>

<body>
    <nav class=" navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header ">
                <a class="navbar-brand" href="#">CHEVERSE MOTOR RENT</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="?page=home">Beranda <span class="sr-only">(current)</span></a></li>
                    <?php if (isset($_SESSION["pelanggan"])) : ?>
                        <li><a href="?page=profil">Profil</a></li>
                        <li><a href="?page=katalog">Katalog Motor</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="#" style="font-weight: bold; color: red;"><?= ucfirst($_SESSION["pelanggan"]["username"]) ?></a></li>
                    <?php else : ?>
                        <li><a href="?page=daftar">Daftar</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php include page($_PAGE); ?>
            </div>
        </div>
    </div>
    <footer class="footer bg-drak">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h4 class="title">Our Location</h4>
                    <!DOCTYPE html>
                        <html>
                        <head>
<style>
img {
  max-width: 100%;
  height: auto;
}
</style>
</head>
<body>

<img  alt="-7.801560975922642, 110.40634416639772" src="assets/img/pp.png" alt="Cinque Terre" width="900" height="200">

</body>
</html>
                    </ul>
                </div>
                <div class="col-sm-3">
                <h4 class="title">Cheverse Motor Rent</h4>
                    <p>Cheverse motor rent adalah penyedia rental motor yang memilkiki berbagai macam tipe, CC serta jenis motor yang berkualitas. Kami selalu berusaha memberikan pelayanan terbaik kepada para pelanggan kami</p>
                    </ul>
                </div>
                  
                </div>
       

            <div class="row text-center"> © 2023. Made with by itskulen.</div>
        </div>


    </footer>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>