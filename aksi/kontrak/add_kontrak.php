<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data Kontrak
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No Kontrak</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="no_kontrak" name="no_kontrak" placeholder="ex : KT001/MBWI/05/22" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Client</label>
				<div class="col-sm-4">
					<select class="form-control" name="nm_client" id="nm_client" required>
						<option value="" selected disabled>--- No Client | Nama Client ---</option>
						<?php
						$sql = $koneksi->query("SELECT * FROM tb_klien");
						while ($data = $sql->fetch_assoc()) {

						?>
							<option value="<?php echo $data['nm_client'] ?>"><?php echo $data['no_client'] . " | " ?><?php echo $data['nm_client'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nilai Kontrak</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="rupiah" name="nilai_kontrak" placeholder="ex : Rp1.000.000.000" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
				<div class="col-sm-4">
					<select class="form-control" name="nama_pro" id="id_jenispro" required>
						<option value="" selected disabled>--- Kode Pekerjaan | Keterangan ---</option>
						<?php
						$sql = $koneksi->query("SELECT * FROM tb_jenisproyek");
						while ($data = $sql->fetch_assoc()) {

						?>
							<option value="<?php echo $data['nama_pro'] ?>"><?php echo $data['kode_pro'] . " | " ?><?php echo $data['nama_pro'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Pembayaran</label>
				<div class="col-sm-4" style="margin-top: 7px;">
					<div class="form-check" style="font-size: 18px; margin-bottom: 5px;">
						<input class=" form-check-input" type="radio" name="jenis_pembayaran" id="exampleRadios1" value="Termin Progress Payment" required>
						<label class="form-check-label" for="exampleRadios1" style="font-size: 20px;">
							Termin Progress Payment
						</label>
					</div>
					<div class="form-check" style="font-size: 18px; margin-bottom: 5px;">
						<input class=" form-check-input" type="radio" name="jenis_pembayaran" id="exampleRadios1" value="Turn Key Payment">
						<label class="form-check-label" for="exampleRadios2" style="font-size: 20px;">
							Turn Key Payment
						</label>
					</div>
					<div class="form-check" style="font-size: 18px; margin-bottom: 5px;">
						<input class=" form-check-input" type="radio" name="jenis_pembayaran" id="exampleRadios1" value="Full Payment">
						<label class="form-check-label" for="exampleRadios1" style="font-size: 20px;">
							Full Payment
						</label>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tanggal Kontrak</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="date" name="tgl_kontrak" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Lama Kontrak</label>
				<div class="col-sm-2">
					<input type="number" class="form-control" name="lama_kontrak" required>

				</div>
				<div class="col-sm-2">
					<input class="form-control" value="Bulan" readonly>
				</div>


			</div>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
				<a href="?page=data_kontrak" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
	</form>
</div>

<?php

if (isset($_POST['Simpan'])) {

	//mulai proses simpan data
	$sql_simpan = "INSERT INTO tb_kontrak (id_kontrak,no_kontrak,nm_client,nama_pro,nilai_kontrak,jenis_pembayaran,tgl_kontrak,lama_kontrak) VALUES (
        '',
		'" . $_POST['no_kontrak'] . "',
		'" . $_POST['nm_client'] . "',
		'" . $_POST['nama_pro'] . "',
		'" . $_POST['nilai_kontrak'] . "',
		'" . $_POST['jenis_pembayaran'] . "',
		'" . $_POST['tgl_kontrak'] . "',
		'" . $_POST['lama_kontrak'] . "'
		
		)";
	// var_dump($sql_simpan);
	// die();
	$query_simpan = mysqli_query($koneksi, $sql_simpan);
	mysqli_close($koneksi);

	if ($query_simpan) {
		echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data_kontrak';
          }
      })</script>";
	} else {
		echo "<script>
      Swal.fire({title: 'Tambah Data Gagal No Kontrak Sudah Ada',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data_kontrak';
          }
      })</script>";
	}
}
//selesai proses simpan data
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
	var rupiah = document.getElementById("rupiah");
	rupiah.addEventListener("keyup", function(e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, "Rp. ");
	});

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, "").toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? "." : "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
		return prefix == undefined ? rupiah : rupiah ? "Rp" + rupiah : "";
	}
</script>