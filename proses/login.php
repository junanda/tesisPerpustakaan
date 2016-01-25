<?php
session_start();
require_once"../koneksi.inc.php";
if($_POST['username']){
	$user=$_POST['username'];
	$pass=md5($_POST['password']);

	$sql=mysql_query("select * from admin where username='".$user."' and password='".$pass."'");
	$jml = mysql_num_rows($sql);
	if($jml>0){
		$data=mysql_fetch_object($sql);
		$_SESSION['nama']=$data->nama;
		$_SESSION['login']=true;
		echo"<script>
			alert('Selamat Datang ".$_SESSION['nama']."');
			location.href='../dashboard.php';
		</script>";
	}else{
		echo"<script>
			alert('username atau password anda salah');
			location.href='../index.php';
		</script>";
	}
}