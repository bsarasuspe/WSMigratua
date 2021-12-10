<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <?php include 'DbConfig.php'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php

	if(!isset($_SESSION["gaiak_erantzunda"])){
		$_SESSION["gaiak_erantzunda"] = array();
	}

	if(!isset($_SESSION["q_erantzunda_id"])){
		$_SESSION["q_erantzunda_id"] = array();
	}
	
  	if(isset($_SESSION["q_id"])){
  		if(sizeof($_SESSION["q_id"]) > 0){
			echo "<script> window.location.href = 'Question.php';</script>";
  		}else{
  			echo "<script> window.location.href = 'FinalResult.php';</script>";
  		}
  	}
  ?>
  <section class="main" id="s1">
    <div>

      <h2>Jolastu</h2>
      <br>
      Aukeratu gai bat eta hasi jolasten!<br>
      Gai bateko galderak amaitzen badira ezingo duzu gai horretan jolastu berriz saioa hasi arte.<br><br>

		<center><table style="text-align:center;" border="1" cellpadding="5">
			<thead>
                    <th>Gaiak</th>
                    <th>Jolastu</th>
			</thead>
			<tbody>

      <?php
		global $zerbitzaria, $erabiltzailea, $gakoa, $db;
		$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

		if($nireSQLI->connect_error) {
			die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
		}

		$ema = $nireSQLI->query("SELECT gaia FROM questions GROUP BY gaia");

		for ($x = 0; $x < $ema->num_rows; $x++){
			$ema->data_seek($x);
			$datuak = $ema->fetch_assoc();
			if(!in_array($datuak["gaia"], $_SESSION["gaiak_erantzunda"])){
				echo "<tr>";
				echo "<td>" .$datuak['gaia']. "</td>";
				echo "<td><form id='jolastu' name='jolastu' method='post' action='StartGame.php'>
							  <input id='gaia' name='gaia' type='hidden' value='$datuak[gaia]'>
							  <button type='submit' id='jolastu'>Jolastu</button>
							  </form></td>";
			}
		}
      ?>
      	</tbody>
	</table>  </center>

	<?php
		if(!isset($_SESSION["eposta"])){
			echo "<br><br>
					<h4>Gorde lortutako emaitzak</h4>";
			if(!isset($_SESSION["vip_jokalaria"])){
				echo "<br>
						VIP erabiltzailea bazara, sartu zure eposta eta gorde puntuak:
						<br><br>
						<form id='vip' name='vip' method='post' action=''>
								  <input type='text' id='vip_eposta' name='vip_eposta' placeholder='Sartu hemen zure eposta'>
								  <button type='submit' id='vipsubmit'>Sartu</button>
								  </form>";
			}else{
				echo "<br>Erantzun zuzen eta akats guztiak $_SESSION[vip_jokalaria] erabiltzailean gordeko dira hemendik aurrera.
				<br><br>
				<form id='vip' name='vip' method='post' action=''>
								  <input type='hidden' id='vip_eposta' name='vip_eposta' placeholder='Sartu hemen zure eposta'>
								  <button type='submit' id='vipsubmit'>Utzi emaitzak gordetzeari</button>
								  </form>
				";
			}
		}

		if (isset($_POST['vip_eposta'])){
        $curl = curl_init();
        $eposta = $_POST['vip_eposta'];
        $url = "https://sw.ikasten.io/~bsarasua001/rest/VipUsers/".$eposta;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($curl);
        //echo $str; 
        curl_close($curl);
        $vipstr = "$_POST[vip_eposta] erabiltzailea VIPa da.";
        if (strcmp($str, $vipstr) !== 0) {
        	echo "<br>";
        	echo $str;
        }else{
        	$_SESSION["vip_jokalaria"] = $_POST["vip_eposta"];
        	echo "<script> window.location.href = 'Play.php';</script>";

        }
        
    }

	?>

    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
