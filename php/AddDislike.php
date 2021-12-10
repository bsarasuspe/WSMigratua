<?php

include 'DbConfig.php';

global $zerbitzaria, $erabiltzailea, $gakoa, $db;
$nireSQLI = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($nireSQLI->connect_error) {
    die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
}

if(isset($_POST['galdera_id'])){
    $ema = $nireSQLI->query("UPDATE questions SET dislikes = dislikes + 1  WHERE id='".$_POST["galdera_id"]."'");
};

?>