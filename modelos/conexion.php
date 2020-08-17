<?php

Class Conexion{

	static public function conectar(){

		$hostname = getenv('DB_HOSTNAME');
		$database = getenv('DB_DATABASE');
		$username = getenv('DB_USERNAME');
 		$password = getenv('DB_PASSWORD');

		 $link = new PDO("mysql:host=$hostname;dbname=$database",
		 "$username",
		 "$password");

		$link->exec("set names utf8");

		return $link;

	}

}