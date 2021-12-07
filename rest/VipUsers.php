<?php
	// // Datuak eskuratzeko konstanteak ...
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
			}else{
				$sql = "SELECT * FROM vip";
				$data = Database::GauzatuKontsulta($cnx, $sql);
				while ($fila = $data->fetch_assoc()){
					echo "$fila[eposta]<br>";
				}
			}
			break;
		case 'POST': // idem POST
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
			break;
		case 'DELETE': //idel DELETE
			$arguments = $_REQUEST;
			$eposta=$arguments['eposta'];
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