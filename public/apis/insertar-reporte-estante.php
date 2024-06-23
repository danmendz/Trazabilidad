<?php
	require_once 'conexion.php';
	date_default_timezone_set('America/Mexico_City');

	$datos = isset($_GET['datos']) ? $_GET['datos'] : '';
	$estante = isset($_GET['id_estante']) ? $_GET['id_estante'] : '';

	$separador = "-";
	$separada = explode($separador, $datos);

	$codigo_proyecto = $separada[0]."-".$separada[1];
	$codigo_partida = $datos;

	function verificarRegistro($codigo_proyecto, $codigo_partida, $estante) {
	    global $conn;
	    $sql = "SELECT * FROM reportes_estante
	            WHERE codigo_proyecto = '$codigo_proyecto'
	            	AND codigo_partida = '$codigo_partida'
					AND id_estante = '$estante'";
	    $ejecutarConsulta = $conn->query($sql);

	    if ($ejecutarConsulta->num_rows > 0) {
	    	return true;
	    } else {
	    	return false;
	    }
	}

	function verificarRegistroSalida($codigo_proyecto, $codigo_partida, $estante) {
	    global $conn;
	    $sql = "SELECT * FROM reportes_estante
	            WHERE codigo_proyecto = '$codigo_proyecto'
	            	AND codigo_partida = '$codigo_partida'
					AND accion = 'salida'
					AND id_estante = '$estante'";
	    $ejecutarConsulta = $conn->query($sql);

	    if ($ejecutarConsulta->num_rows > 0) {
	    	return true;
	    } else {
	    	return false;
	    }
	}

	function verificarRegistroDuplicado($codigo_proyecto, $codigo_partida, $estante) {
	    global $conn;
	    $fecha = date('Y-m-d');
	    $hora = date('H:i:s');

	    $hora_hace_2_minutos = date('H:i:s', strtotime('-2 minutes'));

	    $sql = "SELECT COUNT(*) as cantidad_registros FROM reportes_estante
	            WHERE codigo_proyecto = '$codigo_proyecto'
	                AND codigo_partida = '$codigo_partida'
	                AND id_estante = '$estante'
	                AND fecha = '$fecha'
	                AND hora BETWEEN '$hora_hace_2_minutos' AND '$hora'";

	    $result = $conn->query($sql);

	    if ($result && $result->num_rows > 0) {
	        $row = $result->fetch_assoc();
	        $cantidad_registros = $row['cantidad_registros'];

	        if ($cantidad_registros > 0) {
	            return true;
	        }
	    }

	    return false;
	}

	function insertarRegistro($codigo_proyecto, $codigo_partida, $estante, $accion) {
        global $conn;
    
        $stmt = $conn->prepare("CALL insertarRegistro(?, ?, ?, ?)");
	    $stmt->bind_param("ssis", $codigo_proyecto, $codigo_partida, $estante, $accion);
	    
	    return $stmt->execute();
    }

	if (verificarRegistro($codigo_proyecto, $codigo_partida, $estante)) {
	    if (verificarRegistroDuplicado($codigo_proyecto, $codigo_partida, $estante)) {
	        header("HTTP/1.1 400 Bad Request");
	        echo "Registro duplicado en menos de 2 minutos. No se puede insertar el registro.";
	    } else {
	        if (verificarRegistroSalida($codigo_proyecto, $codigo_partida, $estante)) {
	            header("HTTP/1.1 400 Bad Request");
	            echo "Ya existe un registro salida para esta partida.";
	        } else {
	            if (insertarRegistro($codigo_proyecto, $codigo_partida, $estante, "salida")) {
	                header("HTTP/1.1 200 OK");
	                echo "Registro salida insertado correctamente.";
	            } else {
	                header("HTTP/1.1 500 Internal Server Error");
	                echo "Error al insertar el registro de salida.";
	            }
	        }
	    }
	} else {
	    if (verificarRegistroDuplicado($codigo_proyecto, $codigo_partida, $estante)) {
	        header("HTTP/1.1 400 Bad Request");
	        echo "Registro duplicado en menos de 2 minutos. No se puede insertar el registro.";
	    } else {
	        if (insertarRegistro($codigo_proyecto, $codigo_partida, $estante, "entrada")) {
	            header("HTTP/1.1 200 OK");
	            echo "Registro entrada insertado correctamente.";
	        } else {
	            header("HTTP/1.1 500 Internal Server Error");
	            echo "Error al insertar el registro de entrada.";
	        }
	    }
	}
?>