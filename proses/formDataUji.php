<?php
require_once"../koneksi.inc.php";
require_once"../class/example.php";
if(isset($_POST)){
	if(!empty($_POST['kdrak'])){
		$ket = $_POST['keterangan'];
		$sql=mysql_query("insert into buku (kode_buku,kode_rak,judul_buku,keterangan) values ('".$_POST['kdbok']."','".$_POST['kdrak']."','".$_POST['judul']."','".$_POST['keterangan']."')");
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
					location.href='../dashboard.php?p=classjadi&didi=".$idbuku."';
				</script>";	
				
			}
		}else{
			echo "ljdhfk";
		}
	}else{
		echo"kosong";
	}
}else{
	echo"mnbk";
}