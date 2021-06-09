<?php
session_start();
if (!isset($_SESSION['usuarioNombre']) || $_SESSION['usuarioTipo'] != "5") {
  echo '<script language = javascript>
	        alert("Debe iniciar sesión para acceder a este contenido")
	        self.location = "index.php"
	      </script>';
}
require_once "modelo/conexion.php";
require_once "modelo/funciones.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();
$cliente = $_SESSION["usuarioID"];
$sql = "SELECT id_cliente, nombre_cli, apellidop_cli, apellidom_cli, correo_electronico, telefono_cli, usuario_cli, contrasena_cli FROM cliente WHERE id_cliente = '$cliente'";
$result = $conexion->query($sql);
$mostrar = $result->fetch_array(MYSQLI_NUM);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "scripts.php"; ?>

  <style>
    body {
      padding-top: 50px;
      padding-left: 0px;
      padding-right: 0px;
      margin: 0px;
      margin-left: 0px;
    }

    #footer {
      background-color: rgba(83, 105, 116, 0.568);
    }

    .fc th {
      padding: 10px 0px;
      vertical-align: middle;
      background: #F2F2F2;
    }
  </style>

  <title>Platino Bus</title>
</head>

<body>
  <?php require_once "header.php"; ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card text-center border-0">
          <div class="row mb-2 mt-4 d-flex justify-content-around">
            <!---- Sección perfil ----->
            <div class="col-md-5 align-middle">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <div class="card-body">
                    <h3 class="d-inline-block mb-2 text-info"><span class="fa fa-address-book-o"></span> Mi perfil:</h3>

                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Nombre(s):</b> <?php echo $mostrar[1] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Ap. Paterno:</b> <?php echo $mostrar[2] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Ap. Materno:</b> <?php echo $mostrar[3] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Correo:</b> <?php echo $mostrar[4] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Teléfono:</b> <?php echo $mostrar[5] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Usuario:</b> <?php echo $mostrar[6] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Contraseña:</b> <?php echo $mostrar[7] ?></p>
                    </div>
                    <button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#modalEditarCliente" onclick="agregaFrmEditarPerfil('<?php echo $mostrar[0] ?>')">Editar perfil</button>
                    <button type="button" class="btn btn-danger" onclick="eliminarCliente('<?php echo $mostrar[0] ?>')">Eliminar cuenta</button>
                  </div>
                </div>
              </div>
            </div>
            <!---- Fin de sección perfil ----->
            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #F39C12;color: white; font-weight: bold;">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-pencil"></span> Editar perfil:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <form id="frmEditarCliente" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="input-group flex-nowrap mt-1 mb-1">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="nombreAct">Nombre(s)</label>
                                </div>
                                <input type="text" id="id_cliente" name="id_cliente" class="form-control" value="" style="display:none;">
                                <input type="text" id="nombreAct" name="nombreAct" class="form-control" value="">
                              </div>
                            </div>
                          </div>
                          <div class="input-group flex-nowrap mt-2 mb-2">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="apellidoPAct">Ap. Paterno</label>
                            </div>
                            <input type="text" id="apellidoPAct" name="apellidoPAct" class="form-control" value="">
                          </div>
                          <div class="input-group flex-nowrap mt-2 mb-2">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="apellidoMAct">Ap. Materno</label>
                            </div>
                            <input type="text" id="apellidoMAct" name="apellidoMAct" class="form-control" value="">
                          </div>
                          <div class="input-group flex-nowrap mt-2 mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="correoAct" name="correoAct" class="form-control" value="" placeholder="Correo electrónico">
                          </div>
                          <div class="input-group flex-nowrap mt-2 mb-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" id="telefonoAct" name="telefonoAct" class="form-control" value="" placeholder="10 d&iacute;gitos">
                          </div>
                          <div class="input-group flex-nowrap  mt-2 mb-2">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="nombreUserAct">Usuario</label>
                            </div>
                            <input type="text" id="nombreUserAct" name="nombreUserAct" class="form-control" value="" readonly>
                          </div>
                          <div class="input-group flex-nowrap  mt-2 mb-3">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="passAct">Contraseña</label>
                            </div>
                            <input type="text" id="passAct" name="passAct" class="form-control" placeholder="Contraseña (max. 16 caracteres)">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" id="submitEditar" name="submitEditar" class="btn btn-primary">Guardar cambios</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin de modal -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once "footer.php"; ?>
</body>

</html>
<script src="js/validaciones.js"></script>
<script src="js/usuarioRegistro.js"></script>