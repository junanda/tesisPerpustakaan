<div class="col-sm-8">
	<h5>Form Buku Training</h5>
	<form action="proses/simpanFile.php" method="POST" role="form" enctype="multipart/form-data">
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
				<label>Klasifikasi</label>
				<select name="class">
					<?php
						$sqlq=mysql_query("select id_class,nama_class from classifikasi");
						while($class=mysql_fetch_object($sqlq)){
							echo"<option value='".$class->id_class."'>".$class->nama_class."</option>";
						}
					?>
				</select>
		</div>
		<div class="form-group">
			<label>Cover</label>
			<input type="file" name="cover" id="cover" class="form-control" >
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</div>
		<br/>
	</form>
</div>