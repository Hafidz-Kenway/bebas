<?php
$host = "localhost";
$user = "root";
$pass = "@S3m4r4ng123";
$name = "sig_map4";

$koneksi = mysqli_connect($host, $user, $pass, $name);
if (mysqli_connect_errno()) {
    echo "Koneksi database mysqli gagal!!! : " . mysqli_connect_error();
}
//mysqli_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");
