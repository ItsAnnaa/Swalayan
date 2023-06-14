<?php

require "../koneksi.php";

$kode_barang = $_GET['kode_barang'];

$query = "DELETE FROM barang WHERE kode_barang ='$kode_barang'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else { ?>
    <script>
        alert('Data Berhasil Dihapus!');
        window.location.assign('home.php');
    </script>
<?php
}
?>