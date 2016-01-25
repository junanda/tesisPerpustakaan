<?php
require_once"../koneksi.inc.php";
require_once"../class/example.php";

if(isset($_POST)){
	if(!empty($_POST['kdrak'])){
		if(!empty($_FILES["cover"]["name"])){
			$targetDir="../image/";
			$targetFile=$targetDir . basename($_FILES["cover"]["name"]);
			$file_name = $_FILES["cover"]["name"];
			if(move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile)){
				$ket = $_POST['keterangan'];
				$sql=mysql_query("insert into buku (kode_buku,kode_rak,judul_buku,keterangan,classifikasi,img_buku) values ('".$_POST['kdbok']."','".$_POST['kdrak']."','".$_POST['judul']."','".$_POST['keterangan']."','".$_POST['class']."','".$file_name."')");
				if($sql){
					$exu = new Proses();
					$idbuku = mysql_insert_id();
					$dataTerm = $exu->Token2($ket);
					if(is_array($dataTerm)){
						foreach($dataTerm as $key=>$val){
							$sqlq=mysql_query("insert into kata_buku (id_buku,kata,tf) values ('".$idbuku."','".$key."','".$val."')");
						}
						echo"<script>
							alert('berhasil');
							location.href='../dashboard.php?p=file';
						</script>";	
					}
				}else{
					echo"<script>
						alert('gagal diinputkan');
						location.href='../dashboard.php?p=file';
					</script>";	
				}
			}else{
				echo"<script>
					alert('maaf gambar gagal diupluad');
					location.href='../dashboard.php?p=file';
				</script>";	
			}
		}
		
	}else{
		echo"<script>
			alert('mohon maaf data harus diisi semua');
			location.href='../dashboard.php?p=file';
		</script>";	
	}
}else{
	echo"<script>
		alert('mohon maaf bisa diisi ulang data anda');
		location.href='../dashboard.php?p=file';
	</script>";	
}