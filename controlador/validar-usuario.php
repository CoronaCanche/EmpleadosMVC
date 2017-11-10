<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once '../modelo/empleados.php';
$modelo = new empleados();
	$user = $_POST['usuario'];
			//$pass = md5($_POST['password']);
			$pass = SHA1($_POST['password']);
			$rs = $modelo->get_validate_user($user, $pass);
			if ($rs->RecordCount() > 0) {
	    		if ($rs->fields[3] == 'I') {
	        		header("Location:../vista/login.html");
	    		} else {
	        		$_SESSION['id_empleado'] = $rs->fields[0];
	        		$_SESSION['nombre_empleado'] = utf8_decode($rs->fields[1]);
	        		$_SESSION['rol_empleado'] = $rs->fields[2];
                    $_SESSION['usuario'] = $rs->fields[4];
	        		header("Location:../vista/silab.php");
	    		}
			} 
			else {
	    		header("Location:../vista/login.html");
			}