<?php
error_reporting(0);
//koneksi database
include "konek.php";
if ($_SESSION['aid'] == "") {
  die("<b>Oops!</b> Access Failed.
    <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
    <button type='button' onclick=location.href='index'>Back</button>");
} else {
  if ($_GET['action'] == 'delete') {
    $pid = intval($_GET['pid']);
    $query = mysqli_query($koneksi, "delete from tb_paramedis where id='$pid'");
    echo '<script>alert("Data terhapus")</script>';
    echo "<script>window.location.href='kelolaparamedis'</script>";
  }
}
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
        <a class="active collapsible">Paramedis</a>
        <div class="content">
          <br>
          <a href="<?= base_url() ?>admin/tambahparamedis" class="konten"><strong>Tambah</strong></a>
          <a href="<?= base_url() ?>admin/kelolaparamedis" class="konten active"><strong>Kelola</strong></a>
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
      <h1>Kelola Paramedis</h1>
    </header>
    <div class="card" style="margin-top: -25px; z-index: 99">
      <div class="card-header">
        <h2>Kelola Paramedis</h2>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Id Paramedis</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Tanggal Reg.</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Id Paramedis</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Tanggal Reg.</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $query = mysqli_query($koneksi, "select * from tb_paramedis");
              $cnt = 1;
              while ($row = mysqli_fetch_array($query)) {
              ?>

                <tr>
                  <td><?php echo $cnt;
                      $cnt++; ?></td>
                  <td><?php echo $row['EmpID']; ?></td>
                  <td><?php echo $row['FullName']; ?></td>
                  <td><?php echo $row['MobileNumber']; ?></td>
                  <td><?php echo $row['RegDate']; ?></td>
                  <td>
                    <a href="edit-paramedis.php?pid=<?php echo $row['id']; ?>"><img src="assets/images/edit.png" alt="edit" style="width:17px;height:17px; margin-left:20px;"></a> |
                    <a href="<?= base_url() ?>admin/kelolaparamedis?pid=<?php echo $row['id']; ?>&&action=delete" onclick="return confirm('Apakah Anda ingin menghapus data ini?');"><i class="fa fa-trash" aria-hidden="true" style="color:red" title="Delete this record"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
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