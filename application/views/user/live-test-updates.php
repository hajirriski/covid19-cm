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
        <a class="active" href="<?= base_url()?>user/livetest">Dashboard</a>
      </li>
      <br>
      <p>Covid-19 Checking</p>
      <li>
        <a class="mt-10 collapsible">Checking</a>
        <div class="content">
          <br>
          <a href="<?= base_url()?>user/index" class="konten"><strong>User baru</strong></a>
          <a href="<?= base_url()?>user/registered" class="konten"><strong>Sudah mendaftar</strong></a>
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
      <h1>Covid19 - Checking | Live Updates</h1>
    </header>
    <div class="card" style="margin-top: -25px; z-index: 99">
      <div class="card-header">
        <h2>Live Updates Dashboard</h2>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <form name="assignto" method="post">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kota</th>
                  <th>Total Check</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Kota</th>
                  <th>Total Check</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $query = mysqli_query($koneksi, "select tb_pasien.Kota as kota,count(tb_testrecord.id) as totaltes from tb_testrecord join tb_pasien on tb_pasien.NomorHP=tb_testrecord.noHP_Pasien group by tb_pasien.Kota");
                $count = 1;
                while ($row = mysqli_fetch_array($query)) {
                ?>

                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['kota']; ?></td>
                    <td><?php echo $row['totaltes']; ?></td>
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