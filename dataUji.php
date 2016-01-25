<div class="span5">
	<h4>Input Judul Buku</h4>
	<form action="" method="POST">
		<label>Judul Buku</label>
		<input type="text" name="kdbook" class="span4" placeholder="Kode Buku" required><br/>
		<input type="submit" class="btn btn-primary" value="proses">
	</form>
</div>
<div class="span6">
	<p>Hasil</p>
</div>
<?php
	if(isset($_POST['kdbook'])){
		require_once"class/clasifikasi.php";
		$caca = new Clasifikasi();
		$caca->classTraining($_POST['kdbook']);
	}
?>