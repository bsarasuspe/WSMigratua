<?php
	session_start();
		unset($_SESSION["q_id"]);
		unset($_SESSION["q_erantzunda"]);
		unset($_SESSION["q_egoki"]);
		unset($_SESSION["q_gaizki"]);
		header('Location: Play.php');
?>