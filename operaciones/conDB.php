<?php
$servidor = "localhost";
$nombreusuario = "admin";
$password = "123456";
$db = "prueba";

$conexion = new mysqli($servidor, $nombreusuario, $password, $db);

if($conexion->connect_error){
    die("Conexión fallida: " . $conexion->connect_error);

}
?>
