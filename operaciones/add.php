<?php
    $servidor = "localhost";
    $nombreusuario = "admin";
    $password = "123456";
    $db = "prueba";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if(isset($_POST['fr'], $_POST['tarea'], $_POST['estado'], $_POST['fv'],$_POST['user'])){
        $fr = $_POST['fr'];
        $tarea = $_POST['tarea'];
        $estado = $_POST['estado'];
        $fv = $_POST['fv'];
        $user = $_POST['user'];

        $sql = "INSERT INTO tarea (fecharegistro, descripcion, estado, fechavence, Autor)
                            VALUES('$fr','$tarea','$estado', '$fv', '$user')";

        if($conexion->query($sql) === true){
            echo "<script>alert('Tarea Creada');</script>";
            header('Location: ../tareas/crear.php');
            exit;
            
        }else{
            die("Error al insertar datos: " . $conexion->error);
        }

    }

?>
