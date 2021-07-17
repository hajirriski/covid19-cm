
<?= link_tag('assets/css/topbar-style.css'); ?>
<nav id="menu" class="main-nav" role="navigation">
  <ul class="main-menu">
    <?php
    include "konek.php";
    $tampilNama = mysqli_query($koneksi, "select * from tb_admin where AdminuserName='$_SESSION[username]'");
    $nama = mysqli_fetch_array($tampilNama);
    ?>
    <li class="has-submenu"><a><?php echo $nama['AdminName'] ?> </a>
      <ul class="sub-menu">
        <li><a href="<?= base_url() ?>admin/profil">Profil</a></li>
        <li><a href="<?= base_url() ?>admin/logout">Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>