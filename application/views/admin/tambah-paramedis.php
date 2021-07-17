<?php
error_reporting(0);
//koneksi database
include "konek.php";
if ($_SESSION['aid'] == "") {
    die("<b>Oops!</b> Access Failed.
    <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
    <button type='button' onclick=location.href='index'>Back</button>");
} else {


    if (isset($_POST['submit'])) {
        //getting post values
        $empid = $_POST['idpegawai'];
        $fname = $_POST['namalengkap'];
        $mnumber = $_POST['nomorhp'];
        $query = "insert into tb_paramedis(EmpID,FullName,MobileNumber) values('$empid','$fname','$mnumber')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            echo '<script>alert("Paramedis berhasil dibuat.")</script>';
            echo "<script>window.location.href='tambahparamedis'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='tambahparamedis'</script>";
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
                <li class="mt-10 active">
                    <a class="active collapsible">Paramedis</a>
                    <div class="content">
                        <br>
                        <a href="<?= base_url() ?>admin/tambahparamedis" class="konten active"><strong>Tambah</strong></a>
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
                </li>
                <li class="mt-10">
                    <a href="<?= base_url() ?>admin/carilaporan">Laporan</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            <header style="padding: 30px 20px 60px 20px" class="bg-primary">
                <h1>Tambah Paramedis</h1>
            </header>
            <div class="card" style="margin-top: -25px; z-index: 99">
                <form name="tambahparamedis" method="post">
                    <div class="card-header">
                        <h2>Informasi Pribadi</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Id Paramedis</label>
                            <input type="text" class="form-control" id="idpegawai" name="idpegawai" placeholder="Masukkan id paramedis..." required="true">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Masukkan nama lengkap..." pattern="[A-Za-z ]+" title="Hanya alfabet" required="true">
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" id="nomorhp" name="nomorhp" placeholder="Masukkan nomor hp" pattern="[0-9]+" title="Karakter numerik saja" required="true">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="button bg-primary mb-3" name="submit" id="submit"></a>
                        </div>

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
<?php } ?>