<?php
$xml = simplexml_load_file("../xml/UserCounter.xml");
$kop = $xml->n;
$kop = $kop - 1;
$xml->n = $kop;
$xml->asXML("../xml/UserCounter.xml");
?>