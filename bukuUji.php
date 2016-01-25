<div class="col-sm-8">
	<h5>Form Buku Baru</h5>
	<form action="proses/formDataUji.php" method="POST" role="form" enctype="multipart/form-data">
		<div class="form-group">
			<label>Kode Buku</label>
			<input type="text" name="kdbok" placeholder="Kode Buku" required class="span5">
		</div>
		<div class="form-group">
			<label>Kode Rak</label>
			<input type="text" name="kdrak" placeholder="Kode Rak" required class="span5">
		</div>
		<div class="form-group">
			<label>Judul Buku</label>
			<input type="text" name="judul" placeholder="Judul Buku" required class="span7">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea class="span7" name="keterangan" rows="10" required></textarea>
		</div>
		<div class="form-group">
			<label>Cover</label>
			<input type="file" name="cover" class="form-control" >
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</div>
		<br/>
	</form>
</div>