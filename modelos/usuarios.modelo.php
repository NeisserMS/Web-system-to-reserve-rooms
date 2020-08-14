<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/
	static public function mdlRegistroUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, password, email, foto, modo, verificacion, email_encriptado) VALUES (:nombre, :password, :email, :foto, :modo, :verificacion, :email_encriptado)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":email_encriptado", $datos["email_encriptado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function mdlMostrarUsuario($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id_u = :id_u");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_u", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();

		$stmt = null;

	}

}