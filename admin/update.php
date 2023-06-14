<?php

require "../koneksi.php";

$kodebarang = $_POST['kode_barang'];
$namabarang = $_POST['nama_barang'];
$idJenis = $_POST['id_jenis'];
$namamerek = $_POST['nama_merek'];
$hargajual = $_POST['harga_jual'];
$stock = $_POST['stock'];
$idSupplier = $_POST['id_supplier'];
$gambar = $_FILES['gambar']['name'];

// cari nama jenis berdasarkan idJenis
// $result = $koneksi->query($sql);
$row = $result->fetch_assoc();
$namaJenis = $row["nama_jenis"];

// cari id supplier
// $query = "SELECT * FROM supplier WHERE id_supplier=$id_supplier";
// $hasil = $koneksi->query($query);
// $baris = $hasil->fetch_assoc();
// $id_supplier = $baris["id_supplier"];


if ($gambar != "") {
    $acc = array('png', 'jpg', 'jpeg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $random = rand(1, 999);
    $gambar_baru = $random . '-' . $gambar;

    if (in_array($ekstensi, $acc) === true) {
        move_uploaded_file($file_tmp, '../product/' . $gambar_baru);

        $query = "UPDATE barang SET nama_barang = '$namabarang', idJenis = '$idJenis', nama_jenis = '$namaJenis', nama_merek = '$namamerek', harga_jual = '$hargajual', stock = '$stock', id_supplier = '$idSupplier', gambar = '$gambar_baru' WHERE kode_barang = '$kodebarang'";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else { ?>
            <script>
                alert('Data Berhasil Diedit!');
                window.location.assign('home.php');
            </script>
        <?php
        }
    } else { ?>
        <script>
            alert('Format gambar hanya png, jpg, dan jpeg!!');
            window.location.assign("edit.php?kode_barang=<?= $kodebarang ?>");
        </script>
    <?php
    }
} else {
    $query = "UPDATE barang SET nama_barang = '$namabarang', idJenis = '$idJenis', nama_jenis = '$namaJenis', nama_merek = '$namamerek', harga_jual = '$hargajual', stock = '$stock', id_supplier = '$idSupplier', gambar = 'default.png' WHERE kode_barang = '$kodebarang'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else { ?>
        <script>
            alert('Data Berhasil Diedit!');
            window.location.assign('home.php');
        </script>
<?php
    }
}

?>