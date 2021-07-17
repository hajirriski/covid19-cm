<?php
error_reporting(0);
include "konek.php";
//DB conncetion
if ($_SESSION['aid'] == "") {
  die("<b>Oops!</b> Access Failed.
  <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
  <button type='button' onclick=location.href='index'>Back</button>");
} else {
  //Code for Assign to
  if (isset($_POST['submit'])) {
    $testid = intval($_GET['tid']);
    $ato = $_POST['assignto'];
    $assignto = explode("-", $ato);
    $aname = $assignto[0];
    $pid = $assignto[1];
    $status = 'Assigned';
    $assigntime = date('d-m-Y h:i:s A', time());
    $query = mysqli_query($koneksi, "update tb_testrecord set StatusLaporan='$status',AssigntoName='$aname',AssignedtoEmpId='$pid',AssignedTime='$assigntime' where id='$testid'");
    echo '<script>alert("Berhasil ditugaskan ke Paramedis.")</script>';
    echo "<script>window.location.href='carilaporan'</script>";
  }

  //Code for Take Action
  if (isset($_POST['takeaction'])) {
    $orderid = intval($_GET['oid']);
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $rby = $_SESSION['aid'];
    //For delivered Status
    if ($status == 'Delivered') :
      $uploadtime = date('d-m-Y h:i:s A', time());
      //For checking the image type
      $reportfile = $_FILES["report"]["name"];
      // get the image extension
      $extension = substr($reportfile, strlen($reportfile) - 4, strlen($reportfile));
      // allowed extensions
      $allowed_extensions = array(".doc", ".pdf", ".PDF");
      // Validation for allowed extensions .in_array() function searches an array for a specific value.
      if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Format tidak valid. Hanya format doc / pdf yang diizinkan');</script>";
      } else {
        //rename the image file
        $newreportfile = md5($reportfile) . time() . $extension;
        // Code for move image into directory
        move_uploaded_file($_FILES["report"]["tmp_name"], "filelaporan/" . $newreportfile);
        $query = mysqli_query($koneksi, "insert into tb_reporttracking(NomorPesanan,Status,Remark,RemarkBy) values('$orderid','$status','$remark','$rby')");
        $query2 = mysqli_query($koneksi, "update tb_testrecord set StatusLaporan='$status',LaporanAkhir='$newreportfile',WaktuUploadLaporan='$uploadtime' where NomorPesanan='$orderid'");
        echo '<script>alert("Status berhasil diperbarui")</script>';
        echo "<script>window.location.href='carilaporan'</script>";
      }

    // For other status
    else :
      $query = mysqli_query($koneksi, "insert into tb_reporttracking(NomorPesanan,Status,Remark,RemarkBy) values('$orderid','$status','$remark','$rby')");
      $query2 = mysqli_query($koneksi, "update tb_testrecord set StatusLaporan='$status' where NomorPesanan='$orderid'");
      echo '<script>alert("Status berhasil diperbarui")</script>';
      echo "<script>window.location.href='carilaporan'</script>";
    endif;
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
          <a class="active" href="<?= base_url() ?>admin/carilaporan">Laporan</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <header style="padding: 30px 20px 60px 20px" class="bg-primary">
        <h1>Laporan #<?php echo intval($_GET['oid']); ?></h1>
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
                <td><?php if ($row['StatusLaporan'] == '') :
                      echo "Belum diproses";
                    else :
                      echo $row['StatusLaporan'];
                    endif;

                    ?></td>
              </tr>

              <?php if ($row['AssignedtoEmpId'] != '') : ?>
                <tr>
                  <th align="left">Ditugaskan Ke</th>
                  <td><?php echo $row['AssigntoName']; ?>-(<?php echo $row['AssignedtoEmpId']; ?>)</td>
                </tr>

                <tr>
                  <th align="left">Tanggal Ditugaskan</th>
                  <td><?php echo $row['AssignedTime']; ?></td>
                </tr>
              <?php endif; ?>
              <?php if ($row['LaporanAkhir'] != '') : ?>
                <tr>
                  <th align="left">Report</th>
                  <?php $filelaporan = $row['LaporanAkhir']; ?>
                  <td><a href="<?= base_url(); ?>admin/download/<?= $filelaporan ?>" target="_blank">Download</a></td>
                </tr>

                <tr>
                  <th align="left">Report Delivered Time</th>
                  <td><?php echo $row['WaktuUploadLaporan']; ?></td>
                </tr>
              <?php endif; ?>
            </table>
            <?php if ($row['AssignedtoEmpId'] == '') :
            ?>
              <div class="form-group">
                <button type="button" class="tomboltabel bg-primary" data-toggle="modal" data-target="#assignto">Assign To</button>
              </div>
              <?php else :
              $rstatus = $row['StatusLaporan'];
              if ($rstatus == 'Assigned' || $rstatus == 'On the Way for Collection' || $rstatus == 'Sample Collected' || $rstatus == 'Sent to Lab') : ?>
                <button type="button" class="tomboltabel bg-primary" data-toggle="modal" data-target="#takeaction">Take Action</button>
            <?php
              endif;
            endif; ?>
          </div>
        <?php } ?>

        <?php
        $orderid = intval($_GET['oid']);
        $ret = mysqli_query($koneksi, "select * from tb_reporttracking join tb_admin on tb_admin.ID=tb_reporttracking.RemarkBy where tb_reporttracking.NomorPesanan='$orderid'");
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
        <!-- Assign Modal -->
        <div id="assignto" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 align="left">Assign to</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">

                <form method="post">
                  <p><select class="form-control" name="assignto" required="true">
                      <option value="">Pilih Paramedis</option>
                      <?php $sql = mysqli_query($koneksi, "select FullName,EmpID from tb_paramedis");
                      while ($result = mysqli_fetch_array($sql)) {
                      ?>
                        <option value="<?php echo $result['FullName'] . "-" . $result['EmpID']; ?>"><?php echo $result['FullName']; ?>-(<?php echo $result['EmpID']; ?>)</option>
                      <?php } ?>
                    </select></p>
                  <p>
                    <input type="submit" class="tomboltabel bg-primary" name="submit" id="submit">
                  </p>

              </div>
              <div class="modal-footer">
                <button type="button" class="tomboltabel bg-primary" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>

          </div>
        </div>

        <!-- Take Action Modal -->
        <div id="takeaction" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 align="left">Take Action</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                  <p> <select class="form-control" name="status" id="status" required="true">
                      <option value="">Select Action</option>
                      <?php

                      $query1 = mysqli_query($koneksi, "select StatusLaporan from tb_testrecord where NomorPesanan='$orderid'");
                      while ($result = mysqli_fetch_array($query1)) :
                        $reportstatus = $result['StatusLaporan'];
                      endwhile;
                      ?>

                      <?php if ($reportstatus == 'Assigned') : ?>
                        <option value="On the Way for Collection">On the Way for Collection</option>
                        <option value="Sample Collected">Sample Collected</option>
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>
                      <?php elseif ($reportstatus == 'On the Way for Collection') : ?>
                        <option value="Sample Collected">Sample Collected</option>
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>
                      <?php elseif ($reportstatus == 'Sample Collected') : ?>
                        <option value="Sent to Lab">Sent to Lab</option>
                        <option value="Delivered">Delivered</option>
                      <?php elseif ($reportstatus == 'Sent to Lab') : ?>
                        <option value="Delivered">Delivered</option>
                      <?php endif; ?>

                    </select></p>
                  <p id='reportfile'> Report <span style="color:red; font-size:12px;">(Doc and PDF formate allowed)</span> <input type="file" name="report" id="report"></p>
                  <p>
                    <textarea name="remark" class="form-control" required="true" placeholder="Remark (Max 500 Characters)" maxlength="500" rows="5"></textarea>
                  </p>
                  <p>
                    <input type="submit" class="tomboltabel bg-primary" name="takeaction" id="submit">
                  </p>

              </div>
              <div class="modal-footer">
                <button type="button" class="tomboltabel bg-primary" data-dismiss="modal">Close</button>
              </div>
              </form>
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
        <script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>
        <script type="text/javascript">
          //For report file
          $('#reportfile').hide();
          $(document).ready(function() {
            $('#status').change(function() {
              if ($('#status').val() == 'Delivered') {
                $('#reportfile').show();
                jQuery("#report").prop('required', true);
              } else {
                $('#reportfile').hide();
              }
            })
          })
        </script>
  </body>

  </html>
<?php } ?>