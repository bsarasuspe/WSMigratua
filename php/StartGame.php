<?php
	session_start();
	if(isset($_POST['gaia'])){
		include 'DbConfig.php';
		global $zerbitzaria, $erabiltzailea, $gakoa, $db;
		$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

		if($nireSQLI->connect_error) {
			die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
		}
		$ema = $nireSQLI->query("SELECT id FROM questions WHERE gaia='".$_POST["gaia"]."'");

		$_SESSION["q_id"] = array();
		$_SESSION["q_erantzunda"] = '0';
		$_SESSION["aux_gaia"] = $_POST["gaia"];
		$_SESSION["q_egoki"] = '0';
		$_SESSION["q_gaizki"] = '0';
		for ($x = 0; $x < $ema->num_rows; $x++){
			$ema->data_seek($x);
			$datuak = $ema->fetch_assoc();
			array_push($_SESSION["q_id"], $datuak['id']);
		}
		shuffle($_SESSION["q_id"]);
		$_SESSION["q_kop"] = sizeof($_SESSION["q_id"]);
		header('Location: Question.php');
		//echo "<script> window.location.href = 'Question.php';</script>";
	}
?>