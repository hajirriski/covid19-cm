<?php
//DB conncetion
include "konek.php";
error_reporting(0);
//validating Session
if ($_SESSION['aid'] == "") {
  die("<b>Oops!</b> Access Failed.
  <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
  <button type='button' onclick=location.href='index'>Back</button>");
} else {
  if (isset($_POST['update'])) {
    $adminid = $_SESSION['aid'];
    $aname = $_POST['adminname'];
    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];

    $query = mysqli_query($koneksi, "update tb_admin set AdminName='$aname', MobileNumber ='$mobno', Email= '$email' where ID='$adminid'");
    if ($query) {
      echo '<script>alert("Profile has been updated")</script>';
      echo "<script>window.location.href='dashboard'</script>";
    } else {
      echo '<script>alert("Something Went Wrong. Please try again.")</script>';
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
        <a class="mt-10 collapsible">Paramedis</a>
        <div class="content">
          <br>
          <a href="<?= base_url() ?>admin/tambahparamedis" class="konten"><strong>Tambah</strong></a>
          <a href="<?= base_url() ?>admin/kelolaparamedis" class="konten"><strong>Kelola</strong></a>
          <br>
        </div>
      </li>
      <li class="mt-10">
        <a class="collapsible">Pasien</a>
        <div class="content">
          <br>
          <a href="<?= base_url() ?>admin/cekbaru" class="konten"><strong>Baru</strong></a>
          <a href="<?= base_url() ?>admin/cekditugaskan" class="konten active"><strong>Ditugaskan</strong></a>
          <a href="<?= base_url() ?>admin/cekprosespengumpulan" class="konten"><strong>Dalam proses untuk pengumpulan sampel</strong></a>
          <a href="<?= base_url() ?>admin/cekdikumpulkan" class="konten"><strong>Sampel dikumpulkan</strong></a>
          <a href="<?= base_url() ?>admin/cekdikirimkelab" class="konten"><strong>Dikirim ke lab</strong></a>
          <a href="<?= base_url() ?>admin/cekterkirim" class="konten"><strong>Laporan terkirim</strong></a>
          <a href="<?= base_url() ?>admin/semualaporan" class="konten"><strong>Semua Laporan</strong></a>
          <br>
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
      <h1>Profil Admin</h1>
    </header>

    <?php
    $adminid = $_SESSION['aid'];
    $ret = mysqli_query($koneksi, "select * from tb_admin where ID='$adminid'");
    $cnt = 1;
    while ($row = mysqli_fetch_array($ret)) {
    ?>

      <div class="card" style="margin-top: -25px; z-index: 99">
        <form name="profiladmin" method="post">
          <div class="card-header">
            <h2>Tanggal Registrasi : <?php echo $row['AdminRegdate']; ?></h2>
          </div>
          <div class="card-body">
            <br>
            <div class="form-group">
              <label>Nama Admin</label>
              <input type="text" class="form-control" name="adminname" value="<?php echo $row['AdminName']; ?>" required='true'>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" value="<?php echo $row['AdminuserName']; ?>" readonly='true'>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" required='true'>
            </div>
            <div class="form-group">
              <label>Nomor Kontak</label>
              <input type="text" class="form-control" name="mobilenumber" value="<?php echo $row['MobileNumber']; ?>" required='true'>
            <?php } ?>
            <div class="form-group">
              <input type="submit" class="button bg-primary mb-3" name="update" id="submit">
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