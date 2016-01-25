<!DOCTYPE html>
<html>
<head>
	<title>Perpus LSA</title>
	<link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="asset/css/bootstrap-responsive.min.css" type="text/css" />
	<link rel="stylesheet" href="asset/css/docs.css" type="text/css" />
	<script src="asset/js/jquery.js"></script>
	<script src="asset/js/bootstrap.js" type="text/javascript"></script>
	<script src="asset/js/bootstrap-dropdown.js" type="text/javascript"></script>
	<script src="asset/js/app.js" type="text/javascript"></script>
	<script type="text/javascript">
		var site = "http://localhost/tesisPerpus/";
		var loading_image_large = "asset/images/loading_large.gif";
		var loading_image_small = "asset/images/loading.gif";
			$(function() {
					// Setup drop down menu
				$('.dropdown-toggle').dropdown();
					// Fix input element click problem
				$('.dropdown input, .dropdown label').click(function(e) {
					e.stopPropagation();
				});
			});
		</script>
</head>
<body>
	<br/>
		<div class="container">
		<div class="navbar">
			<div class="navbar-inner">
				<a class="brand" href="">My Library App</a>
				<!--navdropdown-->
					<?php
						require_once "template/navi.php";
					?>
				<!--endnavdropdown-->	
			</div>
		</div>
		</div>
		<!--middle-->
		<div class="container">
			<div class="well" style="min-height:400px;">
				<div id="content">
					<?php
						if(isset($_GET['p'])){
							switch($_GET['p']){
								case"readMore":
									require_once"readMore.php";
								break;
							}
						}else{
							require_once"bera.php";
						}
					?>
				</div>
			</div>
		</div>
		<!--end-Middle-->
		<footer>
			<?php
				require_once "template/footer.php";
			?>
		</footer>
</body>
</html>