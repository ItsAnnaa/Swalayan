<?php

require "../koneksi.php";

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input Barang - Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
	<div class="data bg-dark">
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<center><img src="../img/orang3.png" alt="" style="width: 600px;" class="mt-5"></center>
				</div>
				<div class="col">
					<h2 class="text-center text-light mt-3">Edit Barang</h2>
					<form action="update.php" method="post" enctype="multipart/form-data">
						<?php

						$kodebarang = $_GET['kode_barang'];
						$result = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang = '$kodebarang'");
						$row = mysqli_fetch_assoc($result);

						$query = "SELECT * FROM supplier";
						$hasil = $koneksi->query($query);
						$bariss = [];
						while ($baris = mysqli_fetch_assoc($hasil)) {
							$bariss[] = $baris;
						}

						?>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['kode_barang'] ?>" name="kode_barang" readonly class="form-control" style="width: 400px; margin-top: 75px;">
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['nama_barang'] ?>" name="nama_barang" placeholder="Nama Barang" class="form-control" style="width: 400px;">
							</div>
						</center>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['idJenis'] ?>" name="idJenis" placeholder="Jenis" class="form-control" style="width: 400px;" hidden>
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<select style="width: 400px;" class="form-control" name="id_jenis">
									<option value=<?= $row["idJenis"] ?> data-option="A"><?= $row["nama_jenis"] ?></option>
								</select>
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['nama_merek'] ?>" name="nama_merek" placeholder="Merk" class="form-control" style="width: 400px;">
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['harga_jual'] ?>" name="harga_jual" placeholder="Harga" class="form-control" style="width: 400px;">
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<input type="text" value="<?php echo $row['stock'] ?>" name="stock" placeholder="Stock" class="form-control" style="width: 400px;">
							</div>
						</center><br>
						<center>
							<div class="form-group">
								<select style="width: 400px;" class="form-control" name="id_supplier">
									<?php foreach ($bariss as $baris) :  ?>
										<?php if ($baris["id_supplier"] == $row["id_supplier"]) { ?>
											<option value=<?= $baris["id_supplier"] ?> selected data-option="A"><?= $baris["id_supplier"] ?></option>
										<?php } else { ?>
											<option value=<?= $baris["id_supplier"] ?> data-option="A"><?= $baris["id_supplier"] ?></option>
										<?php } ?>
									<?php endforeach;  ?>
								</select>
							</div>
						</center><br>
						<center>
							<center>
								<div class="form-group">
									<img src="../product/<?php echo $row['gambar'] ?>" alt="" style="width: 120px; float: left; margin-bottom : 5px;"><br>
									<input type="file" value="../product/<?php echo $row['gambar'] ?>" name="gambar" placeholder="" class="form-control" style="width: 400px;">
								</div>
							</center><br>
							<center>
								<button type="submit" class="btn btn-success" name="input" style="margin-right: 20px; width: 180px; height: 50px;background: #EA7C69;box-shadow: 0px 8px 24px rgba(234, 124, 105, 0.4); border-color:transparent; border-radius: 8px; ">INPUT</button>
								<button type="reset" class="btn btn-danger" name="reset" style="width: 180px; height: 50px;background:#393939; border: 2px solid #EA7C69; border-radius: 10px; ">RESET</button>
							</center>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>