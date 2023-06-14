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
$sql = "SELECT * FROM nama_jenis WHERE idJenis=$idJenis";
$result = $koneksi->query($sql);
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

        $query = "INSERT INTO barang VALUES ('$kodebarang', '$namabarang', '$idJenis', '$namaJenis', '$namamerek', '$hargajual', '$stock', '$idSupplier', '$gambar_baru')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else { ?>
            <script>
                alert('Data Berhasil Ditambahkan!');
                window.location.assign('home.php');
            </script>
        <?php
        }
    } else { ?>
        <script>
            alert('Format gambar hanya png, jpg, dan jpeg!!');
            window.location.assign('tambah_barang.php');
        </script>
    <?php
    }
} else {
    $query = "INSERT INTO barang VALUES ('$kodebarang', '$namabarang', '$idJenis', '$namaJenis', '$namamerek', '$hargajual', '$stock', '$idSupplier', 'default.png')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else { ?>
        <script>
            alert('Data Berhasil Ditambahkan!');
            window.location.assign('home.php');
        </script>
<?php
    }
}

?>