<?php
	require_once "class/clasifikasi.php";

	$buku = $_REQUEST['didi'];
	$class = new Clasifikasi();
	
	$class->pipi($buku);