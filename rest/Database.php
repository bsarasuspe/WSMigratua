<?php
	class Database {
		public static function Konektatu() {
			$nireSQLI = new mysqli(_HOST_, _USERNAME_, _PASSWORD_, _DATABASE_);
			if($nireSQLI->connect_error) {
				die("DB-ra konexio bat egitean errore bat egon da: " . $nireSQLI->connect_error);
			}
			return $nireSQLI;
		}
		public static function GauzatuKontsulta($link, $sql) {
			$result = $link->query($sql);
			return $result;
		}
		public static function GauzatuEzKontsulta($link, $sql) {
			if (!$link->query($sql)) {
				return 0;
			}else{
				return 1;
			}
		}
		public static function Deskonektatu($link) {
			$link->close();
		}
	}
?>