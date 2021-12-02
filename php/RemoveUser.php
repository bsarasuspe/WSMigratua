<?php

include 'DbConfig.php';

global $zerbitzaria, $erabiltzailea, $gakoa, $db;
$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($nireSQLI->connect_error) {
    die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
}

if(isset($_POST['eposta'])){
    $ema = $nireSQLI->query("DELETE FROM erabiltzaileak WHERE eposta = '".$_POST["eposta"]."'");
}

header('Location: HandlingAccounts.php');
?>