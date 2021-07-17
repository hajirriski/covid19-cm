<?php
//koneksi database
include "konek.php";
error_reporting(0);

if (isset($_POST['submit'])) {
  //getting post values
  $nmrhp = $_POST['nomorhp'];
  $tipecek = $_POST['tipecek'];
  $waktucek = $_POST['waktucek'];
  $orderno = mt_rand(100000000, 999999999);
  $query = "insert into tb_testrecord(noHP_Pasien,TipeCek,WaktuCek,NomorPesanan) values('$nmrhp','$tipecek','$waktucek','$orderno');";
  $result = mysqli_multi_query($koneksi, $query);
  if ($result) {
    echo '<script>alert("Your test request submitted successfully. Order number is "+"' . $orderno . '")</script>';
    echo "<script>window.location.href='registered'</script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again.');</script>";
    echo "<script>window.location.href='registered'</script>";
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
      <a href="<?= base_url()?>home/index"><em>Covid-19</em> CMS</a>
    </div>
    <ul>
      <li>
        <a href="<?= base_url()?>user/livetest">Dashboard</a>
      </li>
      <br>
      <p>Covid-19 Checking</p>
      <li>
        <a class="mt-10 active collapsible">Checking</a>
        <div class="content">
          <br>
          <a href="<?= base_url()?>user/index" class="konten"><strong>User baru</strong></a>
          <a href="<?= base_url()?>user/registered" class="konten active"><strong>Sudah mendaftar</strong></a>
          <br>
        </div>
      </li>
      <li class="mt-10">
        <a href="<?= base_url()?>user/carilaporan">Laporan Cek</a>
      </li>
      <li class="mt-10">
        <a href="<?= base_url(); ?>admin/index">Admin</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <header style="padding: 30px 20px 60px 20px" class="bg-primary">
      <h1>Covid19 - Checking | Sudah Mendaftar</h1>
    </header>

    <form method="post">
      <div class="card" style="margin-top: -25px; z-index: 99">
        <div class="card-body">
          <div class="form-group">
            <label>Nomor HP yang Didaftarkan</label>
            <input type="text" class="form-control" id="regmobilenumber" name="regmobilenumber" placeholder="Please enter your registered mobile number"  title="Karakter numeric saja" required="true" >
          </div>
          <div class="form-group">
            <input type="submit" class="button bg-primary mb-3" name="cari" value="Cari">
          </div>
        </div>
      </div>
    </form>

    <?php if (isset($_POST['cari'])) { ?>
      <h3 align="center" style="color:red">Hasil Pencarian Nomor HP "<?php echo $_POST['regmobilenumber']; ?>"</h3>
      <?php
      $nmrhp = intval($_POST['regmobilenumber']);
      $sql = mysqli_query($koneksi, "select * from tb_pasien where NomorHP='$nmrhp'");
      $row = mysqli_num_rows($sql);
      if ($row > 0) {
        while ($result = mysqli_fetch_array($sql)) {
      ?>
          <div class="card" style="margin-top: -25px; z-index: 99">
            <form name="newtesting" method="post">
              <div class="card-header">
                <h2>Informasi Pribadi</h2>
              </div>
              <div class="card-body">
                <br>
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?php echo $result['NamaLengkap']; ?>" readonly="true">
                </div>
                <div class="form-group">
                  <label>Nomor HP</label>
                  <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" value="<?php echo $result['NomorHP']; ?>" readonly="true">
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="text" class="form-control" id="tgllahir" name="tgllahir" readonly="true" value="<?php echo $result['TanggalLahir']; ?>">
                </div>
                <div class="form-group">
                  <label>Identitas yang Terdaftar di Pemerintah</label>
                  <input type="text" class="form-control" id="kartuidentitas" name="kartuidentitas" value="<?php echo $result['KartuIdentitas']; ?>" readonly="true">
                </div>
                <div class="form-group">
                  <label>Nomor Identitas yang Didaftarkan</label>
                  <input type="text" class="form-control" id="no_kartuidentitas" name="no_kartuidentitas" value="<?php echo $result['no_KartuIdentitas']; ?>" readonly="true">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" id="alamat" name="alamat" required="true" readonly="true"><?php echo $result['Alamat']; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Kota</label>
                  <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $result['Kota']; ?>" readonly="true">
                </div>
                <br>
                <div class="card-header">
                  <h2>Informasi Cek COVID-19</h2>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Tipe Cek Covid-19</label>
                  <select class="form-control" id="tipecek" name="tipecek" required="true">
                    <option value="">Pilih</option>
                    <option value="Antigen">Antigen</option>
                    <option value="PCR">PCR</option>
                    <option value="Antibodi">Antibodi</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Time Slot for Test</label>
                  <input type="datetime-local" class="form-control" id="waktucek" name="waktucek" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <input type="submit" class="button bg-primary mb-3" name="submit" id="submit">
              </div>
            </form>
          </div>
  </div>

<?php }
      } else { ?>
<br>
<h4 align="center" style="color:red;">Tidak Ditemukan</h4>
<?php }
    } ?>
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