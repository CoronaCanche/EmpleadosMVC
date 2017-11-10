<?php
session_start();
if (!isset($_SESSION['id_empleado']) && !isset($_SESSION['nombre_empleado']) && !isset($_SESSION['rol_empleado'])) {
    header("location:../controlador/terminar-sesion.php");
}