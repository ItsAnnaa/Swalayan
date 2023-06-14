<?php
session_start();
require "../koneksi.php";
if (!isset($_SESSION['username'])) { ?>
    <script type="text/javascript">
        // alert('Username atau Password Salah!');
        window.location.assign('../login.php');
    </script>
<?php
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Admin</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/680ecce84d.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-style: normal;
            color: #fff;
            background-color: #393C49;
            overflow-x: hidden;
            position: relative;
            padding-bottom: 70px;
        }

        .container-fluid {
            max-width: 1390px;
            margin: auto;
        }

        .logo {
            font-family: Times New Roman;
            font-size: 36px;
            font-weight: bold;
            padding-left: 10px;
        }

        footer {
            margin-top: 100px;
            border-top-color: #fff;
            border-top-style: solid;
            border-top-width: medium;
        }

        .logo-footer {
            font-size: 24px;
            font-family: Times New Roman;
            font-weight: bold;
            padding-top: 15px;
        }

        .subslogan {
            font-family: Calibri;
            font-size: 16px;
            color: #fff;
            margin-top: -13px;
        }

        .list-group-item {
            color: #fff;
            ;
            list-style: none;
        }
    </style>
</head>

<body>
    <center>
        <h2 class="text-light" style="font-family: 'Poppins', sans-serif;font-style: normal;">DAFTAR BARANG</h2>
    </center><br>
    <div class="container-fluid" >
        <div class="card" style="background-color: #1F1D2B">
            <div class="card-header">
                <a class="btn btn-outline-success" style="border-color:#fff; color: #fff;" href="tambah_barang.php">
                    Tambah Barang
                </a>
            </div>
            <div class="card-body" >
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="color: #fff">
                            <tr class="text-center"  style="color: #fff">
                                <th width="5%">No </th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sql = "SELECT * FROM barang";
                            $result = $koneksi->query($sql);
                            $rows = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $rows[] = $row;
                            }

                            $no = 1;

                            ?>

                            <?php foreach ($rows as $row) : ?>

                                <tr class='text-center' style="color: #fff">
                                    <td><?= $no++ ?></td>
                                    <td> <?= $row['kode_barang'] ?> </td>
                                    <td> <?= $row['nama_barang'] ?> </td>
                                    <td> <?= $row['nama_jenis'] ?> </td>
                                    <td> <?= $row['nama_merek'] ?> </td>
                                    <td> <?= $row['harga_jual'] ?> </td>
                                    <td> <?= $row['stock'] ?> </td>
                                    <td> <img src="../product/<?php echo $row['gambar']; ?>" style="width:110px; height:110; border-radius:90px;"> </td>
                                    <td>
                                        <!-- <a href="edit.php?id=//= $row['kode_barang'] ?>" class="btn btn-warning"> -->
                                        <a href="edit.php?kode_barang=<?= $row['kode_barang'] ?>" class="btn btn-warning" style="background: #EA7C69;box-shadow: 0px 8px 24px rgba(234, 124, 105, 0.4); border-color:transparent; border-radius: 8px;">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete.php?kode_barang=<?= $row['kode_barang'] ?>" class="btn btn-danger" style="background: #EA7C69;box-shadow: 0px 8px 24px rgba(234, 124, 105, 0.4); border-color:transparent; border-radius: 8px;" onclick="return confirm('Anda Yakin ingin menghapus produk ini?')">
                                            <i class="fa fa-trash" ></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="../logout.php" class="sidebar-item" style="text-decoration:none; font-family: 'Poppins', sans-serif; font-style: medium; color:#fff " onclick="toggleActive(this)">Logout
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 17L21 12L16 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21 12H9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>