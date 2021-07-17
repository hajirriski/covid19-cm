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
        <a href="<?= base_url() ?>home"><em>Covid-19</em> CMS</a>
      </div>
      <ul>
        <li>
          <a href="<?= base_url() ?>admin/dashboard">Dashboard</a>
        </li>
        <br>
        <p>Covid-19 Checking </p>
        <li class="mt-10 active">
          <a class="collapsible">Paramedis</a>
          <div class="content">
            <br>
            <a href="<?= base_url() ?>admin/tambahparamedis" class="konten"><strong>Tambah</strong></a>
            <a href="<?= base_url() ?>admin/kelolaparamedis" class="konten"><strong>Kelola</strong></a>
            <br>
          </div>
        </li>
        <li class="mt-10">
          <a class="active collapsible">Pasien</a>
          <div class="content">
            <br>
            <a href="<?= base_url() ?>admin/cekbaru" class="konten"><strong>Baru</strong></a>
            <a href="<?= base_url() ?>admin/cekditugaskan" class="konten"><strong>Ditugaskan</strong></a>
            <a href="<?= base_url() ?>admin/cekprosespengumpulan" class="konten"><strong>Dalam proses untuk pengumpulan sampel</strong></a>
            <a href="<?= base_url() ?>admin/cekdikumpulkan" class="konten"><strong>Sampel dikumpulkan</strong></a>
            <a href="<?= base_url() ?>admin/cekdikirimkelab" class="konten"><strong>Dikirim ke lab</strong></a>
            <a href="<?= base_url() ?>admin/cekterkirim" class="konten"><strong>Laporan terkirim</strong></a>
            <a href="<?= base_url() ?>admin/semualaporan" class="konten active"><strong>Semua Laporan</strong></a>
            <br>
          </div>
        </li>
        <li class="mt-10">
          <a href="<?= base_url() ?>admin/carilaporan">Laporan</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <?php
      $caridata = $_POST['caridata'];
      ?>
      <header style="padding: 30px 20px 60px 20px" class="bg-primary">
        <h1>Semua Laporan</h1>
      </header>
      <div class="card" style="margin-top: -25px; z-index: 99">
        <div class="card-header">
          <h2>Semua Laporan</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <form name="assignto" method="post">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nomor Pesanan</th>
                    <th>Nama Pasien</th>
                    <th>Nomor HP</th>
                    <th>Tipe Cek</th>
                    <th>Waktu Cek</th>
                    <th>Tanggal Registrasi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Nomor Pesanan</th>
                    <th>Nama Pasien</th>
                    <th>Nomor HP</th>
                    <th>Tipe Cek</th>
                    <th>Waktu Cek</th>
                    <th>Tanggal Registrasi</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $query = mysqli_query($koneksi, "select tb_testrecord.NomorPesanan,tb_pasien.NamaLengkap,tb_pasien.NomorHP,tb_testrecord.TipeCek,tb_testrecord.WaktuCek,tb_testrecord.TanggalRegistrasi,tb_testrecord.id as testid from tb_testrecord
join tb_pasien on tb_pasien.NomorHP=tb_testrecord.noHP_Pasien 
    ");
                  $count = 1;
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $row['NomorPesanan']; ?></td>
                      <td><?php echo $row['NamaLengkap']; ?></td>
                      <td><?php echo $row['NomorHP']; ?></td>
                      <td><?php echo $row['TipeCek']; ?></td>
                      <td><?php echo $row['WaktuCek']; ?></td>
                      <td><?php echo $row['TanggalRegistrasi']; ?></td>
                      <td>
                        <a href="<?= base_url() ?>admin/laporandetail?tid=<?php echo $row['testid']; ?>&&oid=<?php echo $row['NomorPesanan']; ?>" class="tomboltabel bg-primary">View Details</a>
                      </td>
                    </tr>
                  <?php $count++;
                  } ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
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
<?php } ?>