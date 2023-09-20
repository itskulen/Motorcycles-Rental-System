<?php

session_start();
unset($_SESSION["admin"]);
unset($_SESSION["pemilik"]);
header('Location: login.php');
