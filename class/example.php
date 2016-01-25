<?php
class Proses{
	function __construct(){
		require_once "Stopword.php";
		require_once '../vendor/autoload.php';
		require_once "CosineSimilarity.php";
		$this->stop = new Stopword();
		$this->createStemmig = new \Sastrawi\Stemmer\StemmerFactory();
		$this->stemming = $this->createStemmig->createStemmer();
	}

	function Tokenisasi(){
		$text = $_POST['text'];
		
		$word = str_word_count(strtolower($text),1);
		$jumlah = count($word);

		/*echo"<b>Teks awal</b>";
		echo "<br/>".$text."<br/>";

		echo"<b>Hasil Tokenisasi</b>";
		echo"<table>";
		echo"<thead>";
		echo"<tr><th>Kata</th></tr>";
		echo"</thead>";
		echo"<tbody>";
		//print_r($word);
		foreach($word as $key=>$val){
			echo"<tr><td>".$val."</td></tr>";
		}
		echo"<tbody>";
		echo"</table>";	

		echo"<b>Jumlah kata : ".$jumlah."</b>";
		echo"<br/>";
		*/
		$word_count = array_count_values($word);
		arsort($word_count);
		$jumlah2 = count($word_count);
		/*echo"<b>Frekuensi Tokenisasi</b><br/>";
		echo"<table>";
		echo"<thead>";
		echo"<tr>";
		echo"<th>Kata</th>";
		echo"<th>Tokenisasi</th>";
		echo"</tr>";
		echo"</thead>";*/
		//$word_count = str_replace("-"," ",$word_count );
		$word_count2=(array_slice($word_count,0));
		/*echo"<tbody>";
		foreach ($word_count2 as $key2 => $val2) {
			echo"<tr>";
			echo"<td>".$this->stemming->stem($key2)."</td>";
			echo"<td>".$val2."</td>";
			echo"</tr>";
		}	
		echo"</tbody>";	
		echo"</table>";
		*/
		$keyword2 = $this->stop->getKeyword($text,$jumlah);
		/*echo"<h3>Hasil 9 Frekuensi teratas </h3><br/>";
		echo"<table>";
		echo"<thead>";
		echo"<tr>";
		echo"<th>Kata</th>";
		echo"<th>TF</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";*/
		$wordCount2 = (array_slice($keyword2,0, $jumlah));
		/*foreach($wordCount2 as $key4 => $val4){ 
			echo"<tr>";
			echo"<td>".$val4."</td>";
			echo"</tr>";
		}

		echo"</tbody>";
		echo"</table>";*/
		//print_r($wordCount2);
		echo"<br/>";
		$kal = implode(" ",$wordCount2);
		//$kal = implode(" ",$keyword2);
		print_r($kal);
		echo"<br/>";
		$kati =  $this->stemming->stem($kal);
		$kuli=explode(" ",$kati);
		print_r($kuli);
		//print_r($kati);
	}
	function Token2($kata){
		$word = str_word_count(strtolower($kata),1);
		$jumlah = count($word);		

		$word_count = array_count_values($word);
		arsort($word_count);
		$jumlah2 = count($word_count);

		$word_count2=(array_slice($word_count,0));

		$keyword2 = $this->stop->getKey($kata,$jumlah);

		$wordCount2 = (array_slice($keyword2,0, $jumlah));

		return $wordCount2;
	}

	function example2(){
		//data dokument
		$doc1 = "Tokoh politik dari berbagai partai mengadakan rapat untuk membahas koalisi baru menjelang pemilu 2014 dan beberapa pilkada 2012 dan 2013.";
		$doc2 = "Partai politik sudah tidak dapat dipercaya. Sebagian besar partai mengutamakan kepentingan partai daripada kebutuhan rakyat";
		$doc3 = "Partai demokrat memenangkan pemilu 2009 karena figur SBY. Partai Golkar berusaha menang pada 2012. Pertandingan 2 partai ini akan seru";
		$doc4 = "Pertandingan pertama antara Persema dan Persebaya diadakan di Malang. Ini akan menguntungkan tuan rumah";
		$doc5 = "Sebagian besar wasit di Indonesia sulit dipercaya. Beberapa pertandingan sepakbola sering tidak adil. Tim nasional perlu pembenahan Total.";
		$doc6 = "Suap menyuap sudah lazim di negeri Ini. Pemilu ada suap. Pilkada juga suap Mungkin pula saat Pilpres.";
		$doc7 = "Beberapa pertandingan sepakbola yang dilakoni persebaya pada masa kampanye Pilkada 2010 Kota surabaya akan ditunda.";
		$doc8 = "Sepakbola Indonesia memang belum bangkit. Manajemen tim, pertandingan dan tiket perlu ditingkatkan, bukan hanya fokus pada kemenangan tim.";
		/*
		$classsifi = array("politik"=>array("D1","D2","D3"),
						   "Olehraga"=>array("D4","D7","D8")
						   );
						   */
		$classsifi=array("D1"=>"Politik",
						 "D2"=>"Politik",
						 "D3"=>"Politik",
						 "D4"=>"Olahraga",
						 "D7"=>"Olahraga",
						 "D8"=>"Olahraga"
						 );
		$hasilDoc1 = $this->Token2($doc1);
		$hasilDoc2 = $this->Token2($doc2);
		$hasilDoc3 = $this->Token2($doc3);
		$hasilDoc4 = $this->Token2($doc4);
		$hasilDoc5 = $this->Token2($doc5);
		//$hasilDoc6 = $this->Token2($doc6);
		$hasilDoc7 = $this->Token2($doc7);
		$hasilDoc8 = $this->Token2($doc8);
		/*
		print_r($hasilDoc1);
		echo"<br/>";
		print_r($hasilDoc2);
		echo"<br/>";
		print_r($hasilDoc3);
		echo"<br/>";
		print_r($hasilDoc4);
		echo"<br/>";
		print_r($hasilDoc5);
		echo"<br/>";
		print_r($hasilDoc7);
		echo"<br/>";
		print_r($hasilDoc8);
		echo"Diatasa hasilnya <br/>";*/
		$gabungan = array_merge($hasilDoc1,$hasilDoc2,$hasilDoc3,$hasilDoc4,$hasilDoc5,$hasilDoc7,$hasilDoc8);
		//echo"<br/>";
		//echo"Gabungan 2 array<br/>";
		//print_r($gabungan);
		//echo"<br/>";
		//echo"Array dengan tidak digabung<br/>";
		//print_r($term);
		/*echo"<table width='100%' border='1' style='font-size:11px;'>";
		echo"<thead>";
		echo"<tr>";
		echo"<th rowspan='2'>Term</th>";
		echo"<th colspan='8'>tf</th>";
		echo"<th>idf</th>";
		echo"<th colspan='7'>wdt = tf.idf</th>";
		echo"<th colspan='6'>WDQ*WDI</th>";
		echo"<th colspan='7'>Panjang Vektor</th>";
		echo"</tr>";
		echo"<tr>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>df</th>";
		echo"<th>log(n/df)</th>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";*/
		$nilaidf="";
		$wdtq="";$wdtd1="";$wdtd2="";$wdtd3="";$wdtd4="";$wdtd5="";$wdtd6="";

		$wq1=""; $wq2=""; $wq3=""; $wq4=""; $wq5=""; $wq6="";
			//totala panjang vector perdokumen
		$pvq=""; $pvq1="";$pvq2="";$pvq3="";$pvq4="";$pvq5="";$pvq6="";

		foreach ($gabungan as $key => $value) {
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc5));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc1));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc2));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc3));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc4));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc7));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc8));
			//memberikan nilai wdt
			$wdtq=$this->wdtq($this->tfq($key,$hasilDoc5),$this->idfq(7,$nilaidf));
			$wdtd1=$this->wdtq($this->tfq($key,$hasilDoc1),$this->idfq(7,$nilaidf));
			$wdtd2=$this->wdtq($this->tfq($key,$hasilDoc2),$this->idfq(7,$nilaidf));
			$wdtd3=$this->wdtq($this->tfq($key,$hasilDoc3),$this->idfq(7,$nilaidf));
			$wdtd4=$this->wdtq($this->tfq($key,$hasilDoc4),$this->idfq(7,$nilaidf));
			$wdtd5=$this->wdtq($this->tfq($key,$hasilDoc7),$this->idfq(7,$nilaidf));
			$wdtd6=$this->wdtq($this->tfq($key,$hasilDoc8),$this->idfq(7,$nilaidf));

			//hasil total penjumlahan weightQ tiap doc
			$wq1 += $this->weightQ($wdtq,$wdtd1);
			$wq2 += $this->weightQ($wdtq,$wdtd2);
			$wq3 += $this->weightQ($wdtq,$wdtd3);
			$wq4 += $this->weightQ($wdtq,$wdtd4);
			$wq5 += $this->weightQ($wdtq,$wdtd5);
			$wq6 += $this->weightQ($wdtq,$wdtd6);
			//totala panjang vector perdokumen
			$pvq +=	$this->Pvector($wdtq);
			$pvq1 +=	$this->Pvector($wdtd1);
			$pvq2 +=	$this->Pvector($wdtd2);
			$pvq3 +=	$this->Pvector($wdtd3);
			$pvq4 +=	$this->Pvector($wdtd4);
			$pvq5 +=	$this->Pvector($wdtd5);
			$pvq6 +=	$this->Pvector($wdtd6);

			/*echo"<tr>";
			echo"<td align='center'>".$key."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc5)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc1)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc2)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc3)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc4)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc7)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc8)."</td>";
			echo"<td align='center'>".$nilaidf."</td>";
			echo"<td align='center'>".$this->idfq(7,$nilaidf)."</td>";
			echo"<td align='center'>".$wdtq."</td>";
			echo"<td align='center'>".$wdtd1."</td>";
			echo"<td align='center'>".$wdtd2."</td>";
			echo"<td align='center'>".$wdtd3."</td>";
			echo"<td align='center'>".$wdtd4."</td>";
			echo"<td align='center'>".$wdtd5."</td>";
			echo"<td align='center'>".$wdtd6."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd1)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd2)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd3)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd4)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd5)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd6)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtq)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd1)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd2)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd3)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd4)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd5)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd6)."</td>";
			echo"</tr>"	;*/
			$nilaidf=0;
		}
		/*
		echo"<tr>";
		echo"<td colspan='17'></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq1."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq2."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq3."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq4."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq5."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq6."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq1."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq2."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq3."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq4."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq5."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq6."</b></td>";
		echo"</tr>";
		echo"<tr>";
		echo"<td colspan='17'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq1)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq2)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq3)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq4)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq5)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq6)."</b></td>";
		echo"</tr>";
		echo"</tbody>";
		echo"</table>";*/
		$urut=array();
		//$cs = new CosineSimilarity();
		//cosine rumus cosine = totalWeigh tiap doc / (hasilAkarQ * hasilAkarDoc^n)
		$urut["D1"] = $this->CosineQ($wq1,$this->hasilAkar($pvq),$this->hasilAkar($pvq1));
		//echo "Nilai Cosine Doc1 = ". $this->CosineQ($wq1,$this->hasilAkar($pvq),$this->hasilAkar($pvq1))."<br/>";
		$urut["D2"] = $this->CosineQ($wq2,$this->hasilAkar($pvq),$this->hasilAkar($pvq2));
		//echo "Nilai Cosine Doc2 = ". $this->CosineQ($wq2,$this->hasilAkar($pvq),$this->hasilAkar($pvq2))."<br/>";
		$urut["D3"] = $this->CosineQ($wq3,$this->hasilAkar($pvq),$this->hasilAkar($pvq3));
		//echo "Nilai Cosine Doc3 = ". $this->CosineQ($wq3,$this->hasilAkar($pvq),$this->hasilAkar($pvq3))."<br/>";
		$urut["D4"] = $this->CosineQ($wq4,$this->hasilAkar($pvq),$this->hasilAkar($pvq4));
		//echo "Nilai Cosine Doc4 = ". $this->CosineQ($wq4,$this->hasilAkar($pvq),$this->hasilAkar($pvq4))."<br/>";
		$urut["D7"] = $this->CosineQ($wq5,$this->hasilAkar($pvq),$this->hasilAkar($pvq5));
		//echo "Nilai Cosine Doc7 = ". $this->CosineQ($wq5,$this->hasilAkar($pvq),$this->hasilAkar($pvq5))."<br/>";
		$urut["D8"] = $this->CosineQ($wq6,$this->hasilAkar($pvq),$this->hasilAkar($pvq6));
		//echo "Nilai Cosine Doc8 = ". $this->CosineQ($wq6,$this->hasilAkar($pvq),$this->hasilAkar($pvq6))."<br/>";

		Arsort($urut);

		//print_r($urut);
		foreach($urut as $doc=>$nil){
			//echo $doc." = ".$nil."<br/>";
			$kq[]=$nil;
		}
		//echo"K = 4 <br/>";
		
		for($i=0;$i<4;$i++){
			//echo $kq[$i]."<br/>";
			foreach($urut as $doc=>$nil){
				if($nil === $kq[$i]){
					$dodo[]=$classsifi[$doc];
				}
			}	
		}
		//print_r($classsifi);
		//echo"<br/>";
		//print_r($dodo);
		$clk=array_count_values($dodo);
		$ff=array_flip($clk);
		//echo"<br/>";
		//print_r($ff);
		//echo"<br/>";
		echo "Dok 5 Merupakan Classifikasi ".$ff[max($clk)];
	}

	function exampleQ(){
		//data dokument
		$doc1 = "Tokoh politik dari berbagai partai mengadakan rapat untuk membahas koalisi baru menjelang pemilu 2014 dan beberapa pilkada 2012 dan 2013.";
		$doc2 = "Partai politik sudah tidak dapat dipercaya. Sebagian besar partai mengutamakan kepentingan partai daripada kebutuhan rakyat";
		$doc3 = "Partai demokrat memenangkan pemilu 2009 karena figur SBY. Partai Golkar berusaha menang pada 2012. Pertandingan 2 partai ini akan seru";
		$doc4 = "Pertandingan pertama antara Persema dan Persebaya diadakan di Malang. Ini akan menguntungkan tuan rumah";
		$doc5 = "Beberapa pertandingan sepakbola yang dilakoni persebaya pada masa kampanye Pilkada 2010 Kota surabaya akan ditunda.";
		$doc6 = "Sepakbola Indonesia memang belum bangkit. Manajemen tim, pertandingan dan tiket perlu ditingkatkan, bukan hanya fokus pada kemenangan tim.";
		$kunci = "menang pertandingan";

		$hasilDoc1 = $this->Token2($doc1);
		$hasilDoc2 = $this->Token2($doc2);
		$hasilDoc3 = $this->Token2($doc3);
		$hasilDoc4 = $this->Token2($doc4);
		$hasilDoc5 = $this->Token2($doc5);
		$hasilDoc6 = $this->Token2($doc6);
		$hasilKunci = $this->Token2($kunci);

		print_r($hasilDoc1);
		echo"<br/>";
		print_r($hasilDoc2);
		echo"<br/>";
		print_r($hasilDoc3);
		echo"<br/>";
		print_r($hasilDoc4);
		echo"<br/>";
		print_r($hasilDoc5);
		echo"<br/>";
		print_r($hasilDoc6);
		echo"<br/>";
		print_r($hasilKunci);

		$gabungan = array_merge($hasilDoc1,$hasilDoc2,$hasilDoc3,$hasilDoc4,$hasilDoc5,$hasilDoc6,$hasilKunci);
		echo"<br/>";
		echo"Gabungan 2 array<br/>";
		print_r($gabungan);
		echo"<br/>";
		//echo"Array dengan tidak digabung<br/>";
		//print_r($term);
		echo"<table width='100%' border='1' style='font-size:11px;'>";
		echo"<thead>";
		echo"<tr>";
		echo"<th rowspan='2'>Term</th>";
		echo"<th colspan='8'>tf</th>";
		echo"<th>idf</th>";
		echo"<th colspan='7'>wdt = tf.idf</th>";
		echo"<th colspan='6'>WDQ*WDI</th>";
		echo"<th colspan='7'>Panjang Vektor</th>";
		echo"</tr>";
		echo"<tr>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>df</th>";
		echo"<th>log(n/df)</th>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"<th>Q</th>";
		echo"<th>D1</th>";
		echo"<th>D2</th>";
		echo"<th>D3</th>";
		echo"<th>D4</th>";
		echo"<th>D5</th>";
		echo"<th>D6</th>";
		echo"</tr>";
		echo"</thead>";
		echo"<tbody>";
		foreach ($gabungan as $key => $value) {
			$nilaidf += $this->dfq($this->tfq($key,$hasilKunci));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc1));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc2));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc3));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc4));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc5));
			$nilaidf += $this->dfq($this->tfq($key,$hasilDoc6));
			//memberikan nilai wdt
			$wdtq=$this->wdtq($this->tfq($key,$hasilKunci),$this->idfq(7,$nilaidf));
			$wdtd1=$this->wdtq($this->tfq($key,$hasilDoc1),$this->idfq(7,$nilaidf));
			$wdtd2=$this->wdtq($this->tfq($key,$hasilDoc2),$this->idfq(7,$nilaidf));
			$wdtd3=$this->wdtq($this->tfq($key,$hasilDoc3),$this->idfq(7,$nilaidf));
			$wdtd4=$this->wdtq($this->tfq($key,$hasilDoc4),$this->idfq(7,$nilaidf));
			$wdtd5=$this->wdtq($this->tfq($key,$hasilDoc5),$this->idfq(7,$nilaidf));
			$wdtd6=$this->wdtq($this->tfq($key,$hasilDoc6),$this->idfq(7,$nilaidf));

			//hasil total penjumlahan weightQ tiap doc
			$wq1 += $this->weightQ($wdtq,$wdtd1);
			$wq2 += $this->weightQ($wdtq,$wdtd2);
			$wq3 += $this->weightQ($wdtq,$wdtd3);
			$wq4 += $this->weightQ($wdtq,$wdtd4);
			$wq5 += $this->weightQ($wdtq,$wdtd5);
			$wq6 += $this->weightQ($wdtq,$wdtd6);
			//totala panjang vector perdokumen
			$pvq +=	$this->Pvector($wdtq);
			$pvq1 +=	$this->Pvector($wdtd1);
			$pvq2 +=	$this->Pvector($wdtd2);
			$pvq3 +=	$this->Pvector($wdtd3);
			$pvq4 +=	$this->Pvector($wdtd4);
			$pvq5 +=	$this->Pvector($wdtd5);
			$pvq6 +=	$this->Pvector($wdtd6);

			echo"<tr>";
			echo"<td align='center'>".$key."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc5)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc1)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc2)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc3)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc4)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc7)."</td>";
			echo"<td align='center'>".$this->tfq($key,$hasilDoc8)."</td>";
			echo"<td align='center'>".$nilaidf."</td>";
			echo"<td align='center'>".$this->idfq(7,$nilaidf)."</td>";
			echo"<td align='center'>".$wdtq."</td>";
			echo"<td align='center'>".$wdtd1."</td>";
			echo"<td align='center'>".$wdtd2."</td>";
			echo"<td align='center'>".$wdtd3."</td>";
			echo"<td align='center'>".$wdtd4."</td>";
			echo"<td align='center'>".$wdtd5."</td>";
			echo"<td align='center'>".$wdtd6."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd1)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd2)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd3)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd4)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd7)."</td>";
			echo"<td align='center'>".$this->weightQ($wdtq,$wdtd8)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtq)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd1)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd2)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd3)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd4)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd5)."</td>";
			echo"<td align='center'>".$this->Pvector($wdtd6)."</td>";
			echo"</tr>"	;
			$nilaidf=0;
		}
		echo"<tr>";
		echo"<td colspan='17'></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq1."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq2."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq3."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq4."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq5."</b></td>";
		echo"<td align='center'><b style='color:blue;'>".$wq6."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq1."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq2."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq3."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq4."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq5."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$pvq6."</b></td>";
		echo"</tr>";
		echo"<tr>";
		echo"<td colspan='17'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq1)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq2)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq3)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq4)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq5)."</b></td>";
		echo"<td align='center'><b style='color:red;'>".$this->hasilAkar($pvq6)."</b></td>";
		echo"</tr>";
		echo"</tbody>";
		echo"</table>";
		$urut=array();
		//$cs = new CosineSimilarity();
		//cosine rumus cosine = totalWeigh tiap doc / (hasilAkarQ * hasilAkarDoc^n)
		$urut[] = $this->CosineQ($wq1,$this->hasilAkar($pvq),$this->hasilAkar($pvq1));
		echo "Nilai Cosine Doc1 = ". $this->CosineQ($wq1,$this->hasilAkar($pvq),$this->hasilAkar($pvq1))."<br/>";
		$urut[] = $this->CosineQ($wq2,$this->hasilAkar($pvq),$this->hasilAkar($pvq2));
		echo "Nilai Cosine Doc2 = ". $this->CosineQ($wq2,$this->hasilAkar($pvq),$this->hasilAkar($pvq2))."<br/>";
		$urut[] = $this->CosineQ($wq3,$this->hasilAkar($pvq),$this->hasilAkar($pvq3));
		echo "Nilai Cosine Doc3 = ". $this->CosineQ($wq3,$this->hasilAkar($pvq),$this->hasilAkar($pvq3))."<br/>";
		$urut[] = $this->CosineQ($wq4,$this->hasilAkar($pvq),$this->hasilAkar($pvq4));
		echo "Nilai Cosine Doc4 = ". $this->CosineQ($wq4,$this->hasilAkar($pvq),$this->hasilAkar($pvq4))."<br/>";
		$urut[] = $this->CosineQ($wq5,$this->hasilAkar($pvq),$this->hasilAkar($pvq5));
		echo "Nilai Cosine Doc7 = ". $this->CosineQ($wq5,$this->hasilAkar($pvq),$this->hasilAkar($pvq5))."<br/>";
		$urut[] = $this->CosineQ($wq6,$this->hasilAkar($pvq),$this->hasilAkar($pvq6));
		echo "Nilai Cosine Doc8 = ". $this->CosineQ($wq6,$this->hasilAkar($pvq),$this->hasilAkar($pvq6))."<br/>";

		Arsort($urut);

		print_r($urut);
		
	}
	
	function CosineQ($weight,$p1,$p2){
		return number_format(($weight/($p1*$p2)),4);
	}
	function idfq($doc,$nil){
		return number_format(log10($doc/$nil),3);
	}
	function tfq($kataq,$data=array()){
		if(array_key_exists($kataq,$data)){
			return $data[$kataq];
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