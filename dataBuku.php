<div class="col-sm-9">
	<h5>Daftar Data Buku</h5>
			<?php
				$batas=10;
				$pg=isset($_GET['pg'])?$_GET['pg']:"";
				if(empty($pg)){
					$posisi=0;
					$pg=1;
				}else{
					$posisi=($pg - 1) * $batas;
				}
				$jumlahData = mysql_num_rows(mysql_query("select judul_buku from buku"));
				$query=mysql_query("select * from buku order by id_buku desc limit ".$posisi.", ".$batas);
				$jumlah=mysql_num_rows($query);
				echo"<p><strong>Jumlah Data ".$jumlahData." Buku</strong></p>";
				echo"<table class='table'>";
				echo"<tbody>";
				if($jumlah > 0){
					while($buku=mysql_fetch_object($query)){
						$ket = substr($buku->keterangan, 0,400);
						echo"<tr>";
						if(empty($buku->img_buku)){
							echo"<td width='15%'>No Image</td>";	
						}else{
							echo"<td width='15%'><img src='image/".$buku->img_buku."' class='img-polaroid'>	</td>";
						}
						
						echo"<td><b>".$buku->judul_buku."</b> | <a href='dashboard.php?p=editBuku&idb=".$buku->id_buku."'><small>Edit Buku</small></a><br/><small>".$ket." <a href='dashboard.php?p=readMore&idb=".$buku->id_buku."'>Readmore</a></small></td>";
						echo"</tr>";
					}
				}else{
					echo"<tr>";
					echo"<td>Tidak Ada Data Buku</td>";
					echo"</tr>";
				}
			?>	
		</tbody>
	</table>
	<div class="pagination">
		<ul>
			<?php
				
				$jumlahHal=ceil($jumlahData/$batas);
				if($pg > 1){
					$link = $pg-1;
					$prev = "<li><a href='dashboard.php?p=dataBuku&pg=".$link."'>Prev</a></li>";
				}else{
					$prev = "<li class='disabled'><a href='#'>Prev</a></li>";
				}

				$nmr = '';
				for($i=1;$i<=$jumlahHal;$i++){
					if($i == $pg){
						$nmr .= "<li class='active'><a href='#'>".$i."</a></li>";
					}else{
						$nmr .= "<li><a href='dashboard.php?p=dataBuku&pg=".$i."'>".$i."</a></li>";
					}
				}

				if($pg < $jumlahHal){
					$Link = $pg + 1;
					$next = "<li><a href='dashboard.php?p=dataBuku&pg=".$Link."'>Next</a></li>";
				}else{
					$next = "<li class='disabled'><a href='#'>Next</a></li>";
				}

				echo $prev . $nmr . $next;
			?>
		</ul>
	</div>
</div>