<?php

include 'DbConfig.php';

global $zerbitzaria, $erabiltzailea, $gakoa, $db;
$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($nireSQLI->connect_error) {
    die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
}

if(isset($_POST['blokeatuta']) && $_POST['blokeatuta'] == "true"){
    $ema = $nireSQLI->query("UPDATE erabiltzaileak SET blokeatuta = 0 WHERE eposta = '".$_POST["eposta"]."'");
}else if(isset($_POST['blokeatuta'])){
    $ema = $nireSQLI->query("UPDATE erabiltzaileak SET blokeatuta = 1 WHERE eposta = '".$_POST["eposta"]."'");
}

header('Location: HandlingAccounts.php');
?>