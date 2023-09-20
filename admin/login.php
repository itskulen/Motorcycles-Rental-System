<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../config.php";
    $sql = "SELECT * FROM admin WHERE username='$_POST[username]' AND password='" . md5($_POST['password']) . "'";
    $sql1 = "SELECT * FROM pemilik WHERE username='$_POST[username]' AND password='$_POST[password]'";
    if ($_POST['role'] == 'admin') {
        if ($query = $connection->query($sql)) {
            if ($query->num_rows) {
                session_start();
                while ($data = $query->fetch_array()) {
                    $_SESSION["admin"]["is_logged"] = true;
                    $_SESSION["admin"]["username"] = $data["username"];
                }
                header('location: index.php');
            } else {
                echo alert("Username / Password tidak sesuai!", "login.php");
            }
        } else {
            echo "Query error!";
        }
    } elseif ($_POST['role'] == 'pemilik') {
        if ($query = $connection->query($sql1)) {
            if ($query->num_rows) {
                session_start();
                echo alert("Username / Password tidak sesuai!", "login.php");
                while ($data = $query->fetch_array()) {
                    $_SESSION["pemilik"]["is_logged"] = true;
                    $_SESSION["pemilik"]["username"] = $data["username"];
                }
                header('location: index.php');
            } else {
                echo alert("Username / Password tidak sesuai!", "login.php");
            }
        } else {
            echo alert("Username / Password tidak sesuai!", "login.php");
        }
    }else{
        echo alert("Role tidak sesuai!", "login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cheverse Motor Rental</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 40px;
            background-image:url(../assets/img/bg1.jpg);
            background-size:cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="text-center">ADMINISTRATOR LOGIN</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="username" autofocus="on">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <option value="">-----Pilih Role----</option>
                                    <option value="admin">Admin</option>
                                    <option value="pemilik">Pemilik</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>