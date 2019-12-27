<?php
include_once '../includes/user.php';
include_once '../includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once '../tareas/crear.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once '../tareas/crear.php';
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
                <h2>INGRESAR TAREA </h2>
                <br>
									<div id="registro">
										<form action="../operaciones/add.php" method="POST" class="login-form">
											<div>

				                <input type= "hidden" id="fr" name="fr" value="<?php echo date("d/m/Y");?>" readonly>
											</div>
											<br>
											<div>
												<label>Descripcion</label>
												<input type="text" name="tarea" id="tarea" placeholder="Ingrese tarea">
											</div>
											<br>
											<div>
												<label>Terminada</label>
                        <select name="estado" id="estado">
                              <option value="si">si</option>
                              <option value="no">no</option>
                        </select>
											</div>
											<br>
											<div>
												<label>Fecha Vencimiento</label>
												<input type="text" name="fv" class="date" id="date" placeholder="DD/MM/AAAA">
											</div>
											<br>
											<div>
                        <?php $usuario = $user->getId();
                        include("../operaciones/conDB.php");
                        	$sql="SELECT * from usuario WHERE id = ".$usuario."";
                          $result=mysqli_query($conexion,$sql);
                          while($row=mysqli_fetch_array($result)){
                        ?>
												<input type="hidden" name="user" id="user" value="<?php echo $row ['user'];?>" >
                        <?php
                        }

                        ?>
											</div>
											<br>
								        <input type="submit" value="Registrar">
								    </form>
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
