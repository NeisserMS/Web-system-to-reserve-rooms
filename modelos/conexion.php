<?php

class Conexion
{

	static public function conectar()
	{
		/*

		$hostname = getenv('DB_HOSTNAME');
		$database = getenv('DB_DATABASE');
		$username = getenv('DB_USERNAME');
 		$password = getenv('DB_PASSWORD');

		 $link = new PDO("mysql:host=$hostname;dbname=$database",
		 "$username",
		 "$password");
*/
		$link = new PDO(
			"mysql:host=eu-cdbr-west-03.cleardb.net;dbname=heroku_c52fdbbfef36bbd",
			"bed3337fb04d4b",
			"0442fb7e"
		);


		$link->exec("set names utf8");

		return $link;
	}
}
