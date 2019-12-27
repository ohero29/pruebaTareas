<?php
include_once '../includes/user.php';
include_once '../includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once '../tareas/actualizar.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once '../tareas/actualizar.php';
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'login.php';
    }
}else{
    //echo "login";
    include_once 'login.php';
}

?>

      <?php
        include("../header1.php");
      ?>
    <section id="intro">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-12">
            <div class="block">
              <div class="section-title">
                <h3>EDITAR TAREAS </h3>
                <br>

                  <div>
                    <table border="1" id="todos" >
                      <tr>
                        <td>id</td>
                        <td>Fecha Registro</td>
                        <td>Descripción</td>
                        <td>Terminada</td>
                        <td>Fecha Vencimiento</td>
                        <td>Autor</td>
                        <td></td>
                      </tr>

                      <?php

                        include("../operaciones/conDB.php");
                      $id= $user->getId();
                      $sql="SELECT * from tarea WHERE autor = ".$id."";
                      $result=mysqli_query($conexion,$sql);

                      while($row=mysqli_fetch_array($result)){
                       ?>
                      <form method="POST" action="../operaciones/edit.php">
                       <tr>
                        <td> <input type="text" name="id" value="<?php echo $row['id'] ?>" readonly> </td>
                        <td> <input type="text" name="fr" value="<?php echo $row['fecharegistro'] ?>" readonly> </td>
                        <td><input type="text" name="tarea" value="<?php echo $row['descripcion'] ?>"></td>
                        <td><select name="estado" ><option value="<?php echo $row['estado'] ?>"><?php echo $row['estado'] ?></option>
                              <option value="si">si</option>
                              <option value="no">no</option>
                            </select></td>
                        <td><input type="text" class="date" id="date" name="fv" value="<?php echo $row['fechavence'] ?>"></td>
                        <?php $usuario = $user->getId();
                          $sql="SELECT * from usuario WHERE id = ".$usuario."";
                          $result2=mysqli_query($conexion,$sql);
                          while($row2=mysqli_fetch_array($result2)){
                        ?>
                        <td><input type="text" name="user" value="<?php echo $row2['user'] ?>" readonly ></td>
                        <?php
                        }

                        ?>
                        <td><input type="submit" value="Guardar"></td>
                       </tr>
                      </form>
                       <?php
                       }
                         $conexion->close();
                       ?>
                    </table>

                  </div>

              </div>
            </div>
          </div><!-- .col-md-7 close -->
        </div>
      </div>
    </section>
    <script>
        $(document).ready(function(){
      $('.date').mask('00/00/0000');
    });
    </script>
    </body>
</html>
