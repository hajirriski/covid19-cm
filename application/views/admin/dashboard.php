<?php
error_reporting(0);
//DB conncetion
if ($_SESSION['aid'] == "") {
  die("<b>Oops!</b> Access Failed.
  <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
  <button type='button' onclick=location.href='index'>Back</button>");
}
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
      <a href="<?= base_url() ?>home"><em>Covid-19</em> CMS</a>
    </div>
    <ul>
      <li>
        <a class="active" href="<?= base_url() ?>admin/dashboard">Dashboard</a>
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
        <a class="collapsible">Pasien</a>
        <div class="content">
          <br>
          <a href="<?= base_url() ?>admin/cekbaru" class="konten"><strong>Baru</strong></a>
          <a href="<?= base_url() ?>admin/cekditugaskan" class="konten"><strong>Ditugaskan</strong></a>
          <a href="<?= base_url() ?>admin/cekprosespengumpulan" class="konten"><strong>Dalam proses untuk pengumpulan sampel</strong></a>
          <a href="<?= base_url() ?>admin/cekdikumpulkan" class="konten"><strong>Sampel dikumpulkan</strong></a>
          <a href="<?= base_url() ?>admin/cekdikirimkelab" class="konten"><strong>Dikirim ke lab</strong></a>
          <a href="<?= base_url() ?>admin/cekterkirim" class="konten"><strong>Laporan terkirim</strong></a>
          <a href="<?= base_url() ?>admin/semualaporan" class="konten"><strong>Semua Laporan</strong></a>
          <br>
        </div>
      </li>
      <li class="mt-10">
        <a href="<?= base_url() ?>admin/carilaporan">Laporan</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <header style="padding: 30px 20px 60px 20px" class="bg-primary">
      <h1>Covid19 - Checking | Live Updates</h1>
    </header>
    <div class="card" style="margin-top: -25px; z-index: 99">
      <div class="card-header">
        <h2>Ini Dashboard</h2>
      </div>
      <div>
        <div class="card-body">
          <div class="feature">
            <div class="container-fluid">
              <div class="row align-items-center">
                <table width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/semualaporan">Total Cek</a></h2>
                            <br><br>
                            <a>7</a>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/cekditugaskan">Total Ditugaskan</a></h2>
                            <br><br>
                            <h2>3</h2>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/cekprosespengumpulan">Proses Pengumpulan</a></h2>
                            <br><br>
                            <a>3</a>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/cekdikumpulkan">Sampel Dikumpulkan</a></h2>
                            <br><br>
                            <a>3</a>
                          </div>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/cekdikirimkelab">Dikirim ke Lab</a></h2>
                            <br><br>
                            <h2>3</h2>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/cekterkirim">Laporan Terkirim</a></h2>
                            <br><br>
                            <h2>3</h2>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2>Total Registrasi Pasien</h2>
                            <br><br>
                            <h2>3</h2>
                          </div>
                        </div>
                      </th>
                      <th>
                        <div>
                          <div class="feature-content">
                            <i class="fas fa-virus"></i>
                            <h2><a href="<?= base_url() ?>admin/kelolaparamedis">Total Registrasi Paramedis</a></h2>
                            <br><br>
                            <h2>3</h2>
                          </div>
                        </div>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
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