<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Data Buku</a>
				<div class="span5 pull-right">
					<form action="#" method="POST" class="navbar-form pull-right">
					<input type="text" class="span3" name="cari" placeholder="masukkan data yang ingin dicari"/>
					<button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i>Cari Data</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class='col-sm-9'>
	<h5>Buku Perpustakaan</h5>
	<?php
		require_once"koneksi.inc.php";
		$sql=mysql_query("select * from buku order by id_buku desc limit 5");
		$jumlahBuku=mysql_num_rows($sql);
		echo"<table class='table'>";
		echo"<tbody>";
		if($jumlahBuku>0){
			while($buku=mysql_fetch_object($sql)){
				$ket = substr($buku->keterangan, 0,400);
				echo"<tr>";
				if(empty($buku->img_buku)){
					echo"<td width='15%'>No Image</td>";	
				}else{
					echo"<td width='15%'><img src='image/".$buku->img_buku."' class='img-polaroid'>	</td>";
				}
			
				echo"<td><b>".$buku->judul_buku."</b> <br/><small>".$ket;
				if(isset($_SESSION['nama']) && $_SESSION['login']==true){
					echo" <a href='beranda.php?p=readMore&idb=".$buku->id_buku."'>Readmore</a></small></td>";
				}else{
					echo" <a href='index.php?p=readMore&idb=".$buku->id_buku."'>Readmore</a></small></td>";
				}
				echo"</tr>";
			}
		}else{
			echo"<tr>";
			echo"<td>Tidak Ada Data Buku</td>";
			echo"</tr>";
		}
		echo"</tbody>";
		echo"</table>";
	?>
</div>