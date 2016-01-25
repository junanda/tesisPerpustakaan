					<ul class="nav">
						<li class="active" onclick='load("bera.php","#content");switch_tab(this);'><a href="javascript:void(0);"><i class="icon-home"></i> Beranda</a></li>
						<li class="tab" onclick='load("index/daftar_m","#content");switch_tab(this);'><a href="javascript:void(0);"><i class="icon-list-alt"></i> Daftar Buku</a></li>
						<li class="tab" onclick='load("index/informasi","#content");switch_tab(this);'><a href="javascript:void(0);"><i class="icon-bullhorn"></i> Informasi Perpustakaan</a></li>
					</ul>
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="" id="drop4" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i> Sign In <b class="caret"></b>
							</a>
							<ul class="dropdown-menu" aria-labelledby="drop4">
								<li>
									<form action="proses/login.php" method="POST">
										<input type="text" style="margin:10px;" name="username" placeholder="Username"/>
										<input type="password" style="margin:10px;" name="password" placeholder="Password"/>
										<input type="checkbox" style="margin:10px;" name="remember" value="remember" />Remember Me
										<input type="submit" class="btn btn-primary" style="margin:10px;" name="submit" value="Sign In"/>
									</form>
								</li>
							</ul>
						</li>
					</ul>