<?php
include_once '../includes/user.php';
include_once '../includes/user_session.php';


$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once '../tareas/consultar.php';

}else if(isset($_POST['username']) && isset($_POST['password'])){

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once '../tareas/consultar.php';
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <section id="intro">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-12">
            <div class="block">
              <div class="section-title">
                <h2>CONSULTAR TAREAS</h2>
                <br>
								<div id="grupoTablas">
								  <ul>
								    <li><a href="#tab-1">Todas</a></li>
								    <li><a href="#tab-2">Mis Tareas</a></li>
								    <li><a href="#tab-3">Pendientes</a></li>
										<li><a href="#tab-4">Finalizadas</a></li>
										<li><a href="#tab-5">Fecha Vencimiento</a></li>
								  </ul>
<!--Todas las tareas -->
								  <div id="tab-1">

                    <?php include("../operaciones/conDB.php"); ?>

																		<div>
																			<form method="GET" action="consultar.php">
										                	<table border="1" id="todos" >
																				<tr>
																					<td>id</td>
																					<td>Fecha Registro</td>
																					<td>Descripción</td>
																					<td>Terminada</td>
																					<td>Fecha Vencimiento</td>
																					<td>Autor</td>

																				</tr>

																				<?php
																				$sql="SELECT * from tarea";
																				$result=mysqli_query($conexion,$sql);

																				while($row=mysqli_fetch_array($result)){
																				 ?>
																				 <tr>
																				 	<td><?php echo $row['id'] ?></td>
																				 	<td><?php echo $row['fecharegistro'] ?></td>
																				 	<td><?php echo $row['descripcion'] ?></td>
																				 	<td><?php echo $row['estado'] ?></td>
																					<td><?php echo $row['fechavence'] ?></td>
                                          <?php $usuario = $row['Autor'];
                                            $sql="SELECT * from usuario WHERE id = ".$usuario."";
                                            $result2=mysqli_query($conexion,$sql);
                                            while($row2=mysqli_fetch_array($result2)){
                                          ?>

                                          <td><?php echo $row2['user'] ?></td>
                                          <?php
                                          }

                                          ?>
																				 </tr>
																				 <?php
																				 }
																				   $conexion->close();
																				 ?>
										                	</table>
																			</form>
																		</div>
								  </div>
	<!--CierreTodas las tareas -->

	<!--Mis tareas -->
								  <div id="tab-2">
										  <?php include("../operaciones/conDB.php"); ?>
										<div>
											<form method="GET" action="consultar.php">
		                	<table border="1" id="todos" >
												<tr>
													<td>id</td>
													<td>Fecha Registro</td>
													<td>Descripción</td>
													<td>Terminada</td>
													<td>Fecha Vencimiento</td>
													<td>Autor</td>

												</tr>

												<?php
                        $id= $user->getId();
												$sql="SELECT * from tarea WHERE autor = ".$id."";
												$result=mysqli_query($conexion,$sql);

												while($row=mysqli_fetch_array($result)){
												 ?>
												 <tr>
												 	<td><?php echo $row['id'] ?></td>
												 	<td><?php echo $row['fecharegistro'] ?></td>
												 	<td><?php echo $row['descripcion'] ?></td>
												 	<td><?php echo $row['estado'] ?></td>
													<td><?php echo $row['fechavence'] ?></td>
                          <?php $usuario = $row['Autor'];
                            $sql="SELECT * from usuario WHERE id = ".$usuario."";
                            $result2=mysqli_query($conexion,$sql);
                            while($row2=mysqli_fetch_array($result2)){
                          ?>

                          <td><?php echo $row2['user'] ?></td>
                          <?php
                          }

                          ?>
												 </tr>
												 <?php
												 }
												   $conexion->close();
												 ?>
		                	</table>
											</form>
										</div>
								  </div>
	<!--Cierre mis tareas -->
	<!--Tareas Pendientes -->
								  <div id="tab-3">
									  <?php include("../operaciones/conDB.php"); ?>
											<div>
												<form method="GET" action="consultar.php">
			                	<table border="1" id="todos" >
													<tr>
														<td>id</td>
														<td>Fecha Registro</td>
														<td>Descripción</td>
														<td>Terminada</td>
														<td>Fecha Vencimiento</td>
														<td>Autor</td>

													</tr>

													<?php
                          $id= $user->getId();
													$sql="SELECT * from tarea WHERE autor = ".$id." and estado = 'no'";
													$result=mysqli_query($conexion,$sql);

													while($row=mysqli_fetch_array($result)){
													 ?>
													 <tr>
													 	<td><?php echo $row['id'] ?></td>
													 	<td><?php echo $row['fecharegistro'] ?></td>
													 	<td><?php echo $row['descripcion'] ?></td>
													 	<td><?php echo $row['estado'] ?></td>
														<td><?php echo $row['fechavence'] ?></td>
                            <?php $usuario = $row['Autor'];
                              $sql="SELECT * from usuario WHERE id = ".$usuario."";
                              $result2=mysqli_query($conexion,$sql);
                              while($row2=mysqli_fetch_array($result2)){
                            ?>

                            <td><?php echo $row2['user'] ?></td>
                            <?php
                            }

                            ?>
													 </tr>
													 <?php
													 }
													   $conexion->close();
													 ?>
			                	</table>
												</form>
											</div>
								  </div>
	<!--CierreTareas pemdientes -->
	<!--Tareas Finalizadas -->
									<div id="tab-4">
										  <?php include("../operaciones/conDB.php"); ?>
  									<div>
  										<form method="GET" action="consultar.php">
  										<table border="1" id="todos" >
  											<tr>
  												<td>id</td>
  												<td>Fecha Registro</td>
  												<td>Descripción</td>
  												<td>Terminada</td>
  												<td>Fecha Vencimiento</td>
  												<td>Autor</td>
  											</tr>
  											<?php
                        $id= $user->getId();
  											$sql="SELECT * from tarea WHERE autor = ".$id." and estado = 'si'";
  											$result=mysqli_query($conexion,$sql);

  											while($row=mysqli_fetch_array($result)){
  											 ?>
  											 <tr>
  												<td><?php echo $row['id'] ?></td>
  												<td><?php echo $row['fecharegistro'] ?></td>
  												<td><?php echo $row['descripcion'] ?></td>
  												<td><?php echo $row['estado'] ?></td>
  												<td><?php echo $row['fechavence'] ?></td>
                          <?php $usuario = $row['Autor'];
                            $sql="SELECT * from usuario WHERE id = ".$usuario."";
                            $result2=mysqli_query($conexion,$sql);
                            while($row2=mysqli_fetch_array($result2)){
                          ?>

                          <td><?php echo $row2['user'] ?></td>
                          <?php
                          }

                          ?>
  											 </tr>
  											 <?php
  											 }
  												 $conexion->close();
  											 ?>
  										</table>
  										</form>
  									</div>
								  </div>
<!--CierreTareas Finalizadas -->
<!--Fecha Vencimiento -->
									<div id="tab-5">
										  <?php include("../operaciones/conDB.php"); ?>
										<div>
											<form method="GET" action="consultar.php">
											<table border="1" id="todos" >
												<tr>
													<td>id</td>
													<td>Fecha Registro</td>
													<td>Descripción</td>
													<td>Terminada</td>
													<td>Fecha Vencimiento</td>
													<td>Autor</td>

												</tr>

												<?php

												$sql="SELECT * from tarea where autor = ".$id." and estado = 'no' order by fechavence";
												$result=mysqli_query($conexion,$sql);

												while($row=mysqli_fetch_array($result)){
												 ?>
												 <tr>
													<td><?php echo $row['id'] ?></td>
													<td><?php echo $row['fecharegistro'] ?></td>
													<td><?php echo $row['descripcion'] ?></td>
													<td><?php echo $row['estado'] ?></td>
													<td><?php echo $row['fechavence'] ?></td>
                          <?php $usuario = $row['Autor'];
                            $sql="SELECT * from usuario WHERE id = ".$usuario."";
                            $result2=mysqli_query($conexion,$sql);
                            while($row2=mysqli_fetch_array($result2)){
                          ?>

                          <td><?php echo $row2['user'] ?></td>
                          <?php
                          }

                          ?>
												 </tr>
												 <?php
												 }
													 $conexion->close();
												 ?>
											</table>
											</form>
										</div>
								  </div>
<!--CierreFecha Vencimiento -->
								</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
		<script>
		  $( function() {
		    $( "#grupoTablas" ).tabs();
		    } );
		</script>
    </body>
</html>
