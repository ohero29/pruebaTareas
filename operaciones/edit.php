<?php
    $servidor = "localhost";
    $nombreusuario = "admin";
    $password = "123456";
    $db = "prueba";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if(isset($_POST['id'],$_POST['fr'], $_POST['tarea'], $_POST['estado'], $_POST['fv'],$_POST['user'])){
        $id = $_POST['id'];
        $fr = $_POST['fr'];
        $tarea = $_POST['tarea'];
        $estado = $_POST['estado'];
        $fv = $_POST['fv'];
        $user = $_POST['user'];

        $sql ="UPDATE tarea SET descripcion= '$tarea', estado= '$estado', fechavence= '$fv' WHERE id= $id.";

        if($conexion->query($sql) === true){
            echo "<script> alert('Tarea Actualizada');</script>";
            header('Location: ../tareas/actualizar.php');
            exit;

        }else{
            die("Error al insertar datos: " . $conexion->error);
        }

    }

?>
