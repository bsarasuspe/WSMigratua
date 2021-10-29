<?php
$xml = simplexml_load_file("../xml/UserCounter.xml");
$kop = $xml->n;
$kop--;
$xml->n = $kop;
$xml->asXML("../xml/UserCounter.xml");
?>