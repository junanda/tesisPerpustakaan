<!DOCTYPE html>
<html>
<head>
	<title>Form File</title>
</head>
<body>
<form action="" method="POST">
	<input type="file" name="file" id="file">
	<input type="submit" value="tampilkan" name="tampil">
</form>
<?php
	if(isset($_POST['tampil'])){
		$file = $_POST['file'];

		$file = "dataTraining/baru/".$file;
		$txt_file = file_get_contents($file);
		$rows = explode("\n", $txt_file);
		
		for($i=3;$i<=count($rows);$i++){
			$ket .= $rows[$i];
		}
		//echo $ket;
?>
		<form action="proses/simpanFile.php" method="POST">
			<p>
				<label>No. Lemari</label>
				<input type="text" name="nole"  class="span4" value="<?php echo $rows[1];?>">
			</p>
			<p>
				<label>No. Buku</label>
				<input type="text" name="nobok" class="span4" value="<?php echo $rows[2];?>">
			</p>
			<p>
				<label>Judul buku</label>
				<input type="text" name="judul" class="span9" value="<?php echo $rows[0];?>" size="70">
			</p>
			<p>
				<label>Keterangan</label>
				<textarea name="keterangan" rows="20" cols="90" class="span9" ><?php echo $ket;?></textarea>
			</p>
			<p>
				<label>Klasifikasi</label>
				<select name="class">
					<?php
						$sqlq=mysql_query("select id_class,nama_class from classifikasi");
						while($class=mysql_fetch_object($sqlq)){
							echo"<option value='".$class->id_class."'>".$class->nama_class."</option>";
						}
					?>
				</select>
			</p>
			<input type="submit" value="simpan">
		</form>
<?php
	}
?>
</body>
</html>