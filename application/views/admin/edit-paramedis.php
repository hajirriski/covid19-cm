<?php

//koneksi database
include "konek.php";
if ($_SESSION['aid'] == "") {
  die("<b>Oops!</b> Access Failed.
    <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
    <button type='button' onclick=location.href='index'>Back</button>");
} else {

  //Code for updation
  if (isset($_POST['update'])) {
    $pid = intval($_GET['pid']);
    //getting post values
    $empid = $_POST['empid'];
    $fname = $_POST['fullname'];
    $mnumber = $_POST['mobilenumber'];
    $query = "update tb_paramedis set FullName='$fname',MobileNumber='$mnumber' where id='$pid'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
      echo '<script>alert("Data Paramedis berhasil diperbarui.")</script>';
      echo "<script>window.location.href='<?= base_url() ?>admin/kelolaparamedis'</script>";
    } else {
      echo "<script>alert('Ada yang salah. Silahkan coba lagi.');</script>";
      echo "<script>window.location.href='<?= base_url() ?>admin/kelolaparamedis'</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Covid-19 Checking Management System</title>
  <meta charset="utf-8" />
  <?= link_tag('assets/css/style.css'); ?>
</head>

<body>
  <nav class="topbar"></nav>
  <nav class="sidebar bg-white">
    <div class="sidenav-header bg-primary">
      <a href="<?= base_url() ?>home"><em>Covid-19</em> CMS</a>
    </div>
    <ul>
      <li>
        <a href="<?= base_url() ?>admin/dashboard">Dashboard</a>
      </li>
      <br>
      <p>Covid-19 Checking</p>
      <li>
        <a class="active collapsible">Paramedis</a>
        <div class="content">
          <br>
          <a href="<?= base_url() ?>admin/tambahparamedis" class="konten"><strong>Tambah</strong></a>
          <a href="<?= base_url() ?>admin/kelolaparamedis" class="konten"><strong>Kelola</strong></a>
          <br>
        </div>
      </li>
      <li class="mt-10">
        <br>
        <a class="collapsible">Pasien</a>
        <div class="content">
          <a href="<?= base_url() ?>admin/cekbaru" class="konten"><strong>Baru</strong></a>
          <a href="<?= base_url() ?>admin/cekditugaskan" class="konten active"><strong>Ditugaskan</strong></a>
          <a href="<?= base_url() ?>admin/cekprosespengumpulan" class="konten"><strong>Dalam proses untuk pengumpulan sampel</strong></a>
          <a href="<?= base_url() ?>admin/cekdikumpulkan" class="konten"><strong>Sampel dikumpulkan</strong></a>
          <a href="<?= base_url() ?>admin/cekdikirimkelab" class="konten"><strong>Dikirim ke lab</strong></a>
          <a href="<?= base_url() ?>admin/cekterkirim" class="konten"><strong>Laporan terkirim</strong></a>
          <a href="<?= base_url() ?>admin/semualaporan" class="konten"><strong>Semua Laporan</strong></a>
        </div>
        <br>
      </li>
      <li class="mt-10">
        <a href="<?= base_url() ?>admin/carilaporan">Laporan</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <header style="padding: 30px 20px 60px 20px" class="bg-primary">
      <h1>Edit Paramedis</h1>
    </header>

    <?php
    $pid = intval($_GET['pid']);
    $query = mysqli_query($koneksi, "select * from tb_paramedis where id='$pid'");
    $cnt = 1;
    while ($row = mysqli_fetch_array($query)) {
    ?>

      <div class="card" style="margin-top: -25px; z-index: 99">
        <form name="profiladmin" method="post">
          <div class="card-header">
            <h2>Tanggal Registrasi : <?php echo $row['RegDate']; ?></h2>
          </div>
          <div class="card-body">
            <br>
            <div class="form-group">
              <label>Id Paramedis</label>
              <input type="text" class="form-control readonly" id="empid" name="empid" value="<?php echo $row['EmpID']; ?>" readonly="true">
            </div>
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukkan nama lengkap..." pattern="[A-Za-z ]+" title="letters only" value="<?php echo $row['FullName']; ?>" required="true">
            </div>
            <div class="form-group">
              <label>Nomor HP</label>
              <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Masukkan nomor HP..." pattern="[0-9]+" title="Hanya numerik saja" value="<?php echo $row['MobileNumber']; ?>" required="true">
            <?php } ?>
            <div class="form-group">
              <input type="submit" class="button bg-primary mb-3" name="update" id="udpate">
            </div>
        </form>
      </div>
  </div>
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