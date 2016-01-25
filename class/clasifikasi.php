<?php

class Clasifikasi{
	private $cosine;
	private $svd;
	private $stopword;
	public $nilaidf="";
	
	function __construct(){
		require_once "koneksi.inc.php";
		require_once "CosineSimilarity.php";
		//require_once "../SingularValueDecomposition.php";
		//require_once "Stopword.php";
		$this->cosine = new CosineSimilarity();
		//$this->svd = new SingularValueDecomposition();
		//$this->stopword = new Stopword();
		//$this->createStemmig = new \Sastrawi\Stemmer\StemmerFactory();
		//$this->stemming = $this->createStemmig->createStemmer();
	}

	function classTraining($id){

		$sql=mysql_query("select kode_buku,kode_rak,judul_buku from buku where kode_buku='".$id."'");
		
	}
	function TokenBuku(){
		$sql=mysql_query("select kata,id_buku,tf from kata_buku");
		while($kata=mysql_fetch_object($sql)){
			$kaka[$kata->kata]=$kata->tf;
		}
		return $kaka;
	}
	function TokenQ($kata){
		$word = str_word_count(strtolower($kata),1);
		$jumlah = count($word);		

		$word_count = array_count_values($word);
		arsort($word_count);
		$jumlah2 = count($word_count);

		$word_count2=(array_slice($word_count,0));

		$keyword2 = $this->stopword->getKey($kata,$jumlah);

		$wordCount2 = (array_slice($keyword2,0, $jumlah));

		return $wordCount2;
	}
	function kataBuku($id){
		$sql=mysql_query("select kata from kata_buku where id_buku='".$id."'");
		while($kaki=mysql_fetch_object($sql)){
			$kata[]=$kaki->kata;	
		}

		return $kata;
	}

	function popo(){
		$kode_buku = $_POST['kdbok'];
		$kode_rak = $_POST['kdrak'];
		$judul_buku = $_POST['judul'];
		$description = $_POST['keterangan'];

		$ququ=mysql_query("select id_buku from buku");
		$jml=mysql_num_rows($ququ);
		//$a=1;
		while($ket=mysql_fetch_object($ququ)){
			$totok[]=$this->kataBuku($ket->id_buku);
			//$totok[]=$ket->kata;
			//$a++;
		}
		foreach ($totok as $kk => $vl) {
			foreach ($vl as $aa) {
				$ksaq[]= $aa;
			}
		}
		
		$token = $this->TokenQ($description);
		$tokenDB = $this->TokenBuku();
		
		$gabung=array_merge($token,$tokenDB);
		
		foreach($gabung as $key => $val){
			//echo $key." = ".$val."<br/>";
			//mencari frekuensi dokument
			$this->nilaidf += $this->dfq($this->tfq($key,$token));

			$sqlDf=mysql_query("select COUNT(*) as N from kata_buku where kata='".$key."'");
			$nil=mysql_fetch_object($sqlDf);
			
			$this->nilaidf +=$nil->N;
			//menghitung jumlah idf

			$nilW = round($val * log10(($jml+1)/$this->nilaidf),2);
			
			$this->nilaidf=0;
		}
		
	}
	function pipi($ibuk){
		$uji=$ibuk;

		// ---------------------------- pembobotan tf idf --------------------------------------------------------------
		//ambil setiap record dalam tabel buku

		$sqlBUku=mysql_query("select * from buku");
		$jml = mysql_num_rows($sqlBUku);
		$sqlTerm=mysql_query("select id_kata,id_buku,kata,tf from kata_buku");
		$num_rows = mysql_num_rows($sqlTerm);
		while($tete=mysql_fetch_object($sqlTerm)){
			$kata = $tete->kata;
			$tf = $tete->tf;
			$id_kata = $tete->id_kata;
			$id_buku = $tete->id_buku;
			//menghitung beberapa jumlah dokument yang mengandung term ? 
			$sqlDF=mysql_query("select COUNT(id_kata) as n from kata_buku where kata='".$kata."'");
			$df=mysql_fetch_object($sqlDF);
			$this->nilaidf += $df->n;

			//menghitung bobot term
			$nilW = $tf * log10($jml/$this->nilaidf);
			//mysql_query("UPDATE kata_buku SET bobot='".$nilW."' where id_kata='".$id_kata."'");
			$bobot[$id_buku][$id_kata]=$nilW;
			$this->nilaidf=0;
			//clearstatcache();
		}
		foreach ($bobot as $doc => $arr) {
			if($doc!=$uji){
				$cs[$doc]=$this->cosine->similarity($bobot[$uji],$arr);
			}
		}
		arsort($cs);
		foreach($cs as $id => $cos){
			$sqlClass=mysql_query("select a.id_buku,a.classifikasi,b.nama_class from buku a inner join classifikasi b on a.classifikasi=b.id_class where id_buku='".$id."'");
			$jac=mysql_fetch_object($sqlClass);
			$hasil[$jac->id_buku]=$jac->nama_class;
			$kh[]=$cos;
		}
		
		for($i=0;$i<10;$i++){
			//echo $kh[$i]."<br/>";
			foreach($cs as $iddc=>$nidc){
				if($kh[$i] === $nidc){
					$kh2[$iddc] = $hasil[$iddc];
				}
			}
		}

		//print_r($kh2);
		//$hitu = array_count_values($hasil);
		$class=0;
		$nmCls="";
		$hitu = array_count_values($kh2);
		foreach ($hitu as $key => $value) {
			echo "Clasifikasi ".$key." ada ".$value."<br/>";
			if($class < $value){
				$class = $value;
				$nmCls = $key;
			}
		}
		
		$dif = '';
		//$sqlHasil=mysql_query("select nama_class from classifikasi where nama_class='".$dif."'");
		$sqlDidi=mysql_query("select id_buku,judul_buku,kode_buku,kode_rak,keterangan,img_buku from buku where id_buku='".$uji."'");
		$ambil=mysql_fetch_object($sqlDidi);
		echo"<div class='media'>";
		echo"<a class='pull-left' href='#'>";
		echo"<img class='media-object' src='images/".$ambil->img_buku."' style='width:200px;' alt='cover'/>";
		echo"</a>";
		echo"<div class='media-body'>";
			echo"<h4 class='media-heading'>".$ambil->judul_buku."</h4>";
			echo"Kode Rak : <b>".$ambil->kode_rak."</b><br/>";
			echo"Kode Buku : <b>".$ambil->kode_buku."</b><br/><br/>";
			echo $ambil->keterangan."<br/></br/>";
			echo"Classifikasi : <b style='color:red;'>".$nmCls."</b>";
		echo"</div>";
		echo"</div>";
		//echo "Jadi Buku <b>".$ambil->judul_buku."</b> merupakan classifikasi ".$nmCls;
		echo"<script>
			alert('selesai');
		</script>";

	}
	function CosineQ($weight,$p1,$p2){
		return number_format(($weight/($p1*$p2)),4);
	}
	function idfq($doc,$nil){
		return number_format(log10($doc/$nil),3);		
	}
	function tfq($kataq,$data=array()){
		if(isset($data[$kataq])){
			return $data[$kataq];
		}else{
			return 0;
		}
	}
	
	function tfq2($kataq,$kasa){
		if($kataq == $kasa){
			return 1;
		}else{
			return 0;
		}
	}

	function dfq($nilai){
		if($nilai != 0){
			return 1;
		}else{
			return 0;
		}
	}

	function wdtq($tf,$idf){
		return ($tf*$idf);
	}

	function weightQ($Q,$D){
		return number_format(($Q*$D),3);
	}

	function Pvector($nilai){
		return number_format(($nilai * $nilai),3);
	}

	function hasilAkar($dat){
		return number_format(sqrt($dat),3);
	}
	
	function classJadi($data=array()){
		$flip=array_flip($data);

	}
}