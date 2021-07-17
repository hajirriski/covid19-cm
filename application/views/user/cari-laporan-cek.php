<?php
error_reporting(0);
//DB conncetion
include "konek.php";
?>

<!DOCTYPE html>
<html>
<title>Covid-19 Checking Management System</title>
<meta charset="utf-8" />
<?= link_tag('assets/css/style.css'); ?>

<body>
  <nav class="topbar"></nav>
  <nav class="sidebar bg-white">
    <div class="sidenav-header bg-primary">
      <a href="<?= base_url()?>home/index"><em>Covid-19</em> CMS</a>
    </div>
    <ul>
      <li>
        <a href="<?= base_url()?>user/livetest">Dashboard</a>
      </li>
      <br>
      <p>Covid-19 Checking</p>
      <li>
        <a class="mt-10 collapsible">Checking</a>
        <div class="content">
          <br>
          <a href="<?= base_url()?>user/index" class="konten"><strong>User baru</strong></a>
          <a href="<?= base_url()?>user/registered" class="konten active"><strong>Sudah mendaftar</strong></a>
          <br>
        </div>
      </li>
      <li class="mt-10">
        <a class="active" href="<?= base_url()?>user/carilaporan">Laporan Cek</a>
      </li>
      <li class="mt-10">
        <a href="<?= base_url(); ?>admin/index">Admin</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <header style="padding: 30px 20px 60px 20px" class="bg-primary">
      <h1>Covid19 - Checking | Cari Laporan</h1>
    </header>

    <form method="post" action="<?= base_url()?>user/laporanpasien">
      <div class="card" style="margin-top: -25px; z-index: 99">
        <div class="card-body">
          <div class="form-group">
            <label>Cari Berdasarkan Nama Pasien atau Nomor Ponsel atau Nomor Pesanan</label>
            <input type="text" class="form-control" id="caridata" name="caridata" required="true" placeholder="Masukkan nama / nomor HP / nomor pesanan">
          </div>
          <div class="form-group">
            <input type="submit" class="button bg-primary mb-3" name="cari" value="Cari">
          </div>
        </div>
      </div>
    </form>

    <script>
      var coll = document.getElementsByClassName("collapsible");
      var i;

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight) {
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "px";
          }
        });
      }
    </script>
</body>

</html>