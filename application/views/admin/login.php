<?php
ob_start();
session_start();
include "konek.php";
$username = $_POST['username'];
$password = $_POST['inputpwd'];
$sql = mysqli_query($koneksi, "select * from tb_admin where AdminuserName='$username' && Password='$password'");
$cek = mysqli_num_rows($sql);
if ($cek > 0) {
  $ret = mysqli_fetch_array($sql);
  $_SESSION['aid'] = $ret["ID"];
  $_SESSION['username'] = $ret['AdminuserName'];
  header('location:dashboard');
} else {
?>
        <?php
        $_GET['login'] = "gagal";
        header("location:index?login=gagal");
      }
        ?>
