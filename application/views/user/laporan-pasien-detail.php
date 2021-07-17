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
          <a href="<? base_url()?>user/registered" class="konten"><strong>Sudah mendaftar</strong></a>
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
      <h1>Covid19 - Checking | Laporan Cek</h1>
    </header>

    <?php
    $testid = intval($_GET['tid']);
    $query = mysqli_query($koneksi, "select * from tb_testrecord join tb_pasien on tb_pasien.NomorHP=tb_testrecord.noHP_Pasien where tb_testrecord.id='$testid'");
    while ($row = mysqli_fetch_array($query)) {
    ?>
      <div class="card" style="margin-top: -25px; z-index: 99">
        <div class="card-body">
          <div class="card-header">
            <h2>Informasi Pribadi</h2>
          </div>
          <table class="table table-bordered" width="100%" cellspacing="0">
            <tr>
              <th align="left">Nama Lengkap</th>
              <td><?php echo $row['NamaLengkap']; ?></td>
            </tr>
            <tr>
              <th align="left">Nomor HP</th>
              <td><?php echo $row['NomorHP']; ?></td>
            </tr>
            <tr>
              <th align="left">Tanggal Lahir</th>
              <td><?php echo $row['TanggalLahir']; ?></td>
            </tr>
            <tr>
              <th align="left">Kartu Identitas</th>
              <td><?php echo $row['KartuIdentitas']; ?></td>
            </tr>
            <tr>
              <th align="left">no Kartu Identitas</th>
              <td><?php echo $row['no_KartuIdentitas']; ?></td>
            </tr>
            <tr>
              <th align="left">Alamat</th>
              <td><?php echo $row['Alamat']; ?></td>
            </tr>
            <tr>
              <th align="left">Kota</th>
              <td><?php echo $row['Kota']; ?></td>
            </tr>
            <tr>
              <th align="left">Tanggal Registrasi</th>
              <td><?php echo $row['TanggalRegistrasi']; ?></td>
            </tr>
          </table>
        </div>

        <div class="card-header">
          <h2>Informasi Cek</h2>
        </div>
        <div class="card-body">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <tr>
              <th align="left">Nomor Pesanan</th>
              <td><?php echo $row['NomorPesanan']; ?></td>
            </tr>
            <tr>
              <th align="left">Tipe Cek</th>
              <td><?php echo $row['TipeCek']; ?></td>
            </tr>
            <tr>
              <th align="left">Waktu Cek</th>
              <td><?php echo $row['WaktuCek']; ?></td>
            </tr>
            <tr>
              <th align="left">Status Laporan</th>
              <td><?php if ($row['ReportStatus'] == '') :
                    echo "Belum diproses";
                  else :
                    echo $row['ReportStatus'];
                  endif;

                  ?></td>
            </tr>

            <?php if ($row['AssignedtoEmpId'] != '') : ?>
              <tr>
                <th align="left">Assign To</th>
                <td><?php echo $row['AssigntoName']; ?>-(<?php echo $row['AssignedtoEmpId']; ?>)</td>
              </tr>

              <tr>
                <th align="left">Assigned Date</th>
                <td><?php echo $row['AssignedTime']; ?></td>
              </tr>
            <?php endif; ?>
            <?php if ($row['FinalReport'] != '') : ?>
              <tr>
                <th>Report</th>
                <td><a href="reportfiles/<?php echo $row['FinalReport']; ?>" target="_blank">Download</a></td>
              </tr>

              <tr>
                <th>Report Delivered Time</th>
                <td><?php echo $row['ReportUploadTime']; ?></td>
              </tr>
            <?php endif; ?>
          </table>
      </div>
    <?php } ?>

    <?php
    $orderid = intval($_GET['oid']);
    $ret = mysqli_query($koneksi, "select * from tb_reporttracking
join tb_admin on tb_admin.ID=tb_reporttracking.RemarkBy
where tb_reporttracking.NomorPesanan='$orderid'");
    $num = mysqli_num_rows($ret);
    ?>

      <div class="card-header">
        <h2>Riwayat Pelacakan Cek</h2>
      </div>
      <?php if ($num > 0) {
      ?>
        <table class="table table-bordered" width="100%" cellspacing="0">
          <tr>
            <th>Remark</th>
            <th>Status</th>
            <th>Remark Date</th>
            <th>Remark By</th>
            <?php while ($result = mysqli_fetch_array($ret)) { ?>
          </tr>
          <tr>
            <td><?php echo $result['Remark']; ?></td>
            <td><?php echo $result['Status']; ?></td>
            <td><?php echo $result['PostingTime']; ?></td>
            <td><?php echo $result['AdminName']; ?></td>
          </tr>

        <?php }
        ?>

        </table>
      <?php
        //end if   
      } else { ?>
        <br>
        <h4 align="center" style="color:red"> Riwayat Pelacakan Cek Tidak Ditemukan </h4>
      <?php } ?>
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