<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <?php include 'DbConfig.php'; ?>
  <section class="main" id="s1">
    <div>

		<b>Erantzundako galderak</b>
		<div id="galderaKop" style="border:1px solid black; width:300px; margin:auto;">
			<?php
				if(isset($_SESSION["q_id"])){
					echo $_SESSION["q_erantzunda"]."/".$_SESSION["q_kop"];
				}else{
					echo "<script> window.location.href = 'Play.php';</script>";
				}
			?>

		</div>
		<br>
		<form id='amaitu' name='amaitu' method='post' action='EndGame.php'>
			<button type='submit' id='jolastu'>Irten jokotik</button>
		</form>
		<br><br>

		<?php
			if(sizeof($_SESSION["q_id"]) > 0){
			global $zerbitzaria, $erabiltzailea, $gakoa, $db;
			$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

			if($nireSQLI->connect_error) {
				die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
			}
			$ema = $nireSQLI->query("SELECT * FROM questions WHERE id='".$_SESSION["q_id"][0]."'");
			$datuak = $ema->fetch_assoc();
      		
      		echo '<h3>'.$datuak["galdera"].'</h3><br>';
      	
			if ($datuak['argazkia'] != "") {
				echo "<td>" . '<img src="data:image/*;base64,' . base64_encode($datuak['argazkia']) . '" height=160/>' . "</td>";
			} else {
				echo "<td>" . '<img src="../images/default_argazkia.png" height=75 width=75"/>' . "</td>";
			}

			$_SESSION['eZuzen'] = $datuak['eZuzen'];
			$erantzun_posibleak = array();
			array_push($erantzun_posibleak, $datuak['eZuzen']);
			array_push($erantzun_posibleak, $datuak['eOker1']);
			array_push($erantzun_posibleak, $datuak['eOker2']);
			array_push($erantzun_posibleak, $datuak['eOker3']);
			shuffle($erantzun_posibleak);

			echo '<form id="question" name="question" method="post" action="result.php"><br>';
			for($i = 0; $i < count($erantzun_posibleak); ++$i) {
				echo '<input type="radio" id="erantzuna" name="erantzuna" value="'.$erantzun_posibleak[$i].'">
					<label for="erantzuna">'.$erantzun_posibleak[$i].'</label>
					<br>';
			}
			echo '<br><input type="submit" name="submit" id="submit" value="Erantzun"></form>';
      	}else{
      		echo "<script> window.location.href = 'FinalResult.php';</script>";
      	}
      ?>

                
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
