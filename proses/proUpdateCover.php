<?php
	require_once "../koneksi.inc.php";

	if(isset($_POST)){
		$idbuk=$_POST['idCover'];
		if(!empty($_POST['idCover'])){
			$targetDir="../image/";
			$targetFile=$targetDir . basename($_FILES["cover"]["name"]);
			$file_name = $_FILES["cover"]["name"];
			if(move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFile)){
				$queryUpdate=mysql_query("update buku set img_buku='".$file_name."' where id_buku='".$idbuk."'");
				if($queryUpdate){
					echo"<script>
						alert('Cover Buku berhasil diupdate');
						location.href='../dashboard.php?p=readMore&idb=".$idbuk."';
					</script>";
				}else{
					echo"<script>
						alert('Cover Buku gagal diupdate');
						location.href='../dashboard.php?p=editBuku&idb=".$idbuk."';
					</script>";
				}
			}
		}else{
			echo"<script>
				alert('file tidak boleh kosong');
				location.href='../dashboard.php?p=editBuku&idb=".$idbuk."';
			</script>";
		}
	}
