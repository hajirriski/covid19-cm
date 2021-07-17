<?php
include "konek.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Covid-19 Checking Management System</title>
  <meta charset="utf-8" />
  <?= link_tag('https://fonts.googleapis.com/css?family=Asap'); ?>
  <?= link_tag('assets/css/login-style.css'); ?>
  
</head>

<body>
  <div class="sidenav-header">
    <a href="<?= base_url() ?>home"><em>Covid-19</em> CMS</a>
  </div>
  <div class="sidenav-headerbottom">
    <a>Halaman Login Admin</a>
  </div>

  <form action="<?= base_url() ?>admin/login" method="post" class="login">
    <input type="text" class="login-input bg-white" name="username" id="username" placeholder="Username" required>
    <input type="password" class="login-input bg-white" name="inputpwd" id="inputpwd" placeholder="Password" required>
    <input type="submit" class="btn btn-bg" name="login" value="Login"></input>
  </form>

</body>
<div class="sidenav-headerket">
  <a><?php
      if (isset($_GET['login'])) {
        if ($_GET['login'] == "gagal") {
          echo "Login gagal ! username dan password salah!";
        } else if ($_GET['login'] == "logout") {
          echo "Anda telah berhasil logout";
        }
      }
      ?>
  </a>
</div>

</html>