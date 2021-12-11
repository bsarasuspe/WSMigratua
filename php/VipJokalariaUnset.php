<?php
	session_start();
	unset($_SESSION["vip_jokalaria"]);
	header('Location: Play.php');
?>