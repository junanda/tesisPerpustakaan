<div class="col-sm-12">
<h4>Detail Buku </h4>
	<div class="media">
		<?php
			require_once"koneksi.inc.php";
			if(isset($_GET['p']) && $_GET['p']=="readMore"){
				$sql=mysql_query("select a.id_buku,a.kode_buku,a.kode_rak,a.judul_buku,a.keterangan,a.img_buku,a.classifikasi, b.nama_class from buku a inner join classifikasi b on a.classifikasi=b.id_class where a.id_buku='".$_GET['idb']."'");
				if(mysql_num_rows($sql) > 0){
					$det=mysql_fetch_object($sql);
					echo"<a href='#' class='pull-left'>";
					echo"<img src='image/".$det->img_buku."' width='200px' alt='buku cover' class='media-object img-polaroid'>";
					echo"</a>";
					echo"<div class='media-body'>";
					echo"<h4 class='media-heading'>".$det->judul_buku."</h4>";
					echo $det->keterangan;
					echo"</div>";
				}else{
					echo"<div class='alert'>";
					echo"<strong>Mohon ma'/af</strong> data yang anda cari tidak ada";
					echo"</div>";
				}
			}
		?>
	</div>
</div>