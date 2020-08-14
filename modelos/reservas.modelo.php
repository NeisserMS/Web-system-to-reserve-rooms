<?php

require_once "conexion.php";

Class ModeloReservas{

	/*=============================================
	MOSTRAR HABITACIONES-RESERVAS-CATEGORIAS CON INNER JOIN
	=============================================*/
	
	static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.tipo_h = $tabla3.id  WHERE id_h = :id_h");

		$stmt -> bindParam(":id_h", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Codigo Reserva Singular
	=============================================*/

	static public function mdlMostrarCodigoReserva($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo_reserva = :codigo_reserva");

		$stmt -> bindParam(":codigo_reserva", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}

	/*=============================================
	Guardar Reserva
	=============================================*/

	static public function mdlGuardarReserva($tabla, $datos){

		$connection = Conexion::conectar();
		$stmt = $connection->prepare("INSERT INTO $tabla(id_habitacion, id_usuario, pago_reserva, numero_transaccion, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida) VALUES (:id_habitacion, :id_usuario, :pago_reserva, :numero_transaccion, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida)");

		$stmt->bindParam(":id_habitacion", $datos["id_habitacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_reserva", $datos["pago_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_transaccion", $datos["numero_transaccion"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $datos["codigo_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $datos["descripcion_reserva"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $datos["fecha_salida"], PDO::PARAM_STR);

		if($stmt->execute()){

			$id = $connection->lastInsertId();

			return $id;

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar Reservas por Usuario
	=============================================*/

	static public function mdlMostrarReservasUsuario($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id_reserva DESC LIMIT 5");

		$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	Crear testimonio Vacío
	=============================================*/
	static public function mdlCrearTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_res, id_us, id_hab, testimonio, aprobado) VALUES (:id_res, :id_us, :id_hab, :testimonio, :aprobado)");

		$stmt->bindParam(":id_res", $datos["id_res"], PDO::PARAM_STR);
		$stmt->bindParam(":id_us", $datos["id_us"], PDO::PARAM_STR);
		$stmt->bindParam(":id_hab", $datos["id_hab"], PDO::PARAM_STR);
		$stmt->bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok"; 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar testimonios
	=============================================*/

	static public function mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.*,  $tabla4.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_hab = $tabla2.id_h INNER JOIN $tabla3 ON $tabla1.id_res = $tabla3.id_reserva INNER JOIN $tabla4 ON $tabla1.id_us = $tabla4.id_u WHERE $item = :$item ORDER BY id_testimonio DESC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	Actualizar testimonio
	=============================================*/

	static public function mdlActualizarTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET testimonio = :testimonio WHERE id_testimonio = :id_testimonio");

		$stmt -> bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_testimonio", $datos["id_testimonio"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}


}