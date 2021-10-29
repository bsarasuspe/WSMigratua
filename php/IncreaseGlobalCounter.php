<?php
$xml = simplexml_load_file("../xml/UserCounter.xml");
$kop = $xml->p;
$kop++;
$xml->p = $kop;
$xml->asXML("../xml/UserCounter.xml");
?>