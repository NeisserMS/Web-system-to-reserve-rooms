<?php

Class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=eu-cdbr-west-03.cleardb.net;dbname=heroku_c52fdbbfef36bbd",
						"bed3337fb04d4b",
						"0442fb7e");

		$link->exec("set names utf8");

		return $link;

	}


}