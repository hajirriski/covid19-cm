<?php
date_default_timezone_set('Asia/Jakarta');
$engi = "mysql";
$host = "localhost";
$dbse = "covidcms-db";
$user = "root";
$pass = "";

$koneksi = mysqli_connect($host, $user, $pass, $dbse);
if (!$koneksi){
        die("Connection Failed:".mysqli_connect_error());
}
?>
