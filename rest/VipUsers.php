<?php
	// // Datuak eskuratzeko konstanteak ...
/*	DEFINE("_HOST_", "localhost");
	DEFINE("_PORT_", "8080");
	DEFINE("_USERNAME_", "root");
	DEFINE("_DATABASE_", "quiz");
	DEFINE("_PASSWORD_", ""); */

	DEFINE("_HOST_", "localhost");
	DEFINE("_PORT_", "8080");
	DEFINE("_USERNAME_", "bsarasua001");
	DEFINE("_DATABASE_", "db_bsarasua001");
	DEFINE("_PASSWORD_", "KEDMwEWdzFmchNnY"); 
	require_once 'Database.php';

	$method = $_SERVER['REQUEST_METHOD'];
	$resource = $_SERVER['REQUEST_URI'];

	try {
		$cnx = Database::Konektatu();
		switch ($method) {
		case 'GET': // GET eskaera bat tratatzeko kodea
			if (isset($_GET['eposta'])){
					$arguments = $_GET;
					$eposta = $arguments['eposta'];
					$sql = "SELECT * FROM vip WHERE eposta = '$eposta'";
					$data = Database::GauzatuKontsulta($cnx, $sql);
					if (($data->num_rows) > 0){
						echo "$eposta erabiltzailea VIPa da.";
					}else{
						echo "$eposta erabiltzailea ez da VIPa.";
					}
			}else if(isset($_GET['top'])){
					$arguments = $_GET;
					$sql = "SELECT * FROM vip ORDER BY zuzenak DESC";
					$data = Database::GauzatuKontsulta($cnx, $sql);
					$i = 0;
					while ($fila = $data->fetch_assoc()){	
						if($i < $arguments['amount']){
							echo "<b>$fila[eposta]</b> - $fila[zuzenak] galdera asmatu<br>";
						}
						$i = $i + 1;
					}
			}else{
				$sql = "SELECT * FROM vip";
				$data = Database::GauzatuKontsulta($cnx, $sql);
				while ($fila = $data->fetch_assoc()){
					echo "$fila[eposta]<br>";
				}
			}
			break;
		case 'POST': // idem 
			if(!isset($_POST["okerra"]) && !isset($_POST["zuzena"])){
				$arguments = $_POST;
				$result = 0;
				$eposta = $arguments['eposta'];
				$sql = "INSERT INTO vip(eposta) VALUES ('$eposta');";
				$num=Database::GauzatuEzKontsulta($cnx, $sql);
				if ($num == 0){
					echo json_encode(array('VIP da dagoeneko.' => $eposta));
				}else {
					echo json_encode(array('VIP sortua' => $eposta));
				}
			}else if(isset($_POST["zuzena"])){
				$arguments = $_REQUEST;
				$eposta = $arguments['eposta'];
				$sql = "UPDATE vip SET zuzenak = zuzenak + 1 WHERE eposta ='".$eposta."'";
				$data = Database::GauzatuKontsulta($cnx, $sql);
			}else if(isset($_POST["okerra"])){
				$arguments = $_REQUEST;
				$eposta = $arguments['eposta'];
				$sql = "UPDATE vip SET okerrak = okerrak + 1 WHERE eposta ='".$eposta."'";
				$data = Database::GauzatuKontsulta($cnx, $sql);
			}

			break;
		case 'DELETE': //idel DELETE
			$arguments = $_REQUEST;
			$eposta = $arguments['eposta'];
			$sql = "SELECT * FROM vip WHERE eposta = '$eposta'";
			$data = Database::GauzatuKontsulta($cnx, $sql);
			if (($data->num_rows) > 0){
					$sql = "DELETE FROM vip WHERE eposta = '$eposta'";
					$result = Database::GauzatuEzKontsulta($cnx, $sql);
					echo json_encode(array('Row deleted' => $eposta));
				}else{
					echo json_encode(array('Ez dago helbide elektronikoa' => $eposta));
				}
			break;
	}

	Database::Deskonektatu($cnx);

	} catch (Exception $ex) {
		header('HTTP/1.0 400 Bad Request');
	}
?>