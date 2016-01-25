	<?php
	require_once"koneksi.inc.php";
	if(isset($_GET['idb']) && !empty($_GET['idb'])){
		$id=$_GET['idb'];
		$query=mysql_query("select * from buku where id_buku='".$id."'");
		$databuku=mysql_fetch_object($query);
	}
?>
<div class="span7">
	<h5>Form Edit Buku</h5>
	<form action="" method="POST" role="form" enctype="multipart/form-data">
		<input type="hidden" name="idBuku" value="<?php echo $id; ?>">
		<div class="form-group">
			<label>Kode Buku</label>
			<input type="text" name="kdbok" placeholder="Kode Buku" required class="span5" value="<?php echo $databuku->kode_buku;?>">
		</div>
		<div class="form-group">
			<label>Kode Rak</label>
			<input type="text" name="kdrak" placeholder="Kode Rak" required class="span5" value="<?php echo $databuku->kode_rak;?>">
		</div>
		<div class="form-group">
			<label>Judul Buku</label>
			<input type="text" name="judul" placeholder="Judul Buku" required class="span6" value="<?php echo $databuku->judul_buku;?>">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea class="span6" name="keterangan" rows="10" required><?php echo $databuku->keterangan; ?></textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</div>
		<br/>
	</form>
</div>
<div class="span4">
	<h5>Form Edit Image Buku</h5>
	<form action="proses/proUpdateCover.php" method="POST" role="form" enctype="multipart/form-data">
	<input type="hidden" name="idCover" value="<?php echo $id; ?>">
		<div class="form-group">
			<label>Cover Buku</label>
			<input type="file" name="cover" class="form-control" required>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
		</div>
	</form>
	<div>
		<?php
			if(empty($databuku->img_buku)){
				echo"<span class='warning'>Tidak ada Cover Buku</span>";
			}else{
				echo"<img src='image/".$databuku->img_buku."' class='img-polaoid' alt='Cover buku'>";
			}
		?>		
	</div>
</div>
<br style="clear:both;"/>