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
	}else{
		
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
      Aukeratu gai bat eta hasi jolasten!<br><br>

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
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
