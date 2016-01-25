					  <ul class="nav">
						  	<li class="tab">
						  		<a href="dashboard.php" ><i class="icon-home"></i> Beranda</a>
						  	</li>
							<li class="dropdown">
							  <a href="javascript:void(0);" id="drop5" role="button" class="dropdown-toggle" data-toggle="dropdown"><b class="caret"></b> Manajemen Buku</a>
							  <ul class="dropdown-menu" aria-labelledby="label3">
								<li><a href="?p=file"><i class="icon-arrow-down"></i> Input Buku Training</a></li>
								<li><a href="?p=buku"><i class="icon-arrow-down"></i> Input Buku Uji</a></li>
							  </ul>
							</li>
							<li class="tab">
						  		<a href="?p=dataUji" ><i class="icon-list-alt"></i> Data Uji</a>
						  	</li>
						  	<li class="tab">
						  		<a href="?p=dataBuku" ><i class="icon-list-alt"></i> Daftar Buku</a>
						  	</li>
					  </ul>
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i> <?php echo $_SESSION['nama'];?> <i class="caret"></i>
							</a>
							<ul class="dropdown-menu" aria-labelledby="drop3">
								<li><a href="?p=keluar"> <i class="icon-off"></i> Logout</a></li>
							</ul>

						</li>
					</ul>