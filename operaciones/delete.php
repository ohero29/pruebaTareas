<?php
    $servidor = "localhost";
    $nombreusuario = "admin";
    $password = "123456";
    $db = "prueba";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $sql = "DELETE FROM tarea WHERE id = $id";

        if($conexion->query($sql) === true){
            echo "<script> alert('Tarea Eliminada');</script>";
            header('Location: ../tareas/borrar.php');
            exit;

        }else{
            die("Error al insertar datos: " . $conexion->error);
        }

    }

?>
