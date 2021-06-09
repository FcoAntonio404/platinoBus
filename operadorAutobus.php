<?php
session_start();
if (!isset($_SESSION['usuarioNombre']) || $_SESSION['usuarioTipo'] != "4") {
  echo '<script language = javascript>
	        alert("Debe iniciar sesión para acceder a este contenido")
	        self.location = "index.php"
	      </script>';
}
require_once "modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();
$operador = $_SESSION["usuarioID"];
$consultaEmp = "SELECT (SELECT nombre_ter FROM terminales WHERE terminales.id_terminal = empleados.id_terminal)AS terminal, nombre_emp, apellidop_emp, apellidom_emp, direccion_emp, telefono_emp, fecha_ingreso_laboral, usuario_emp, contrasena_emp FROM empleados WHERE id_empleado = '$operador'";
$result = $conexion->query($consultaEmp);
$mostrar = $result->fetch_array(MYSQLI_NUM);
$consultaAutobus = "SELECT numero_autobus, placa, capacidad_asientos, estado FROM autobuses WHERE id_empleado = '$operador'";
$result = $conexion->query($consultaAutobus);
$mostrarAutobus = $result->fetch_array(MYSQLI_NUM);
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
                    <h3 class="d-inline-block mb-2 text-info"><span class="fa fa-address-book-o"></span> Datos del operador:</h3>
                    <hr>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Terminal actual:</b> <b class="text-danger"> <?php echo $mostrar[0] ?> </b> </p>
                    </div>
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
                      <p><b>Direcci&oacute;n:</b> <?php echo $mostrar[4] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Tel&eacute;fono:</b> <?php echo $mostrar[5] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Fecha de ingreso laboral:</b> <?php echo $mostrar[6] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Usuario:</b> <?php echo $mostrar[7] ?></p>
                    </div>
                    <div class="input-group flex-nowrap mt-1 mb-1">
                      <p><b>Contraseña:</b> <?php echo $mostrar[8] ?></p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!---- Fin de sección perfil ----->
            <!---- Sección autobus ----->
            <div class="col-md-5 align-middle">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <div class="card-body">
                    <?php
                    if (!empty($mostrarAutobus)) {
                    ?>
                      <h3 class="d-inline-block mb-2 text-info"><span class="fa fa-bus"></span> Datos del autobus:</h3>
                      <hr>
                      <div class="input-group flex-nowrap mt-1 mb-1">
                        <p><b>N&uacute;mero de autobus:</b> <?php echo $mostrarAutobus[0] ?></p>
                      </div>
                      <div class="input-group flex-nowrap mt-1 mb-1">
                        <p><b>Placa:</b> <?php echo $mostrarAutobus[1] ?></p>
                      </div>
                      <div class="input-group flex-nowrap mt-1 mb-1">
                        <p><b>Asientos:</b> <?php echo $mostrarAutobus[2] ?></p>
                      </div>
                      <div class="input-group flex-nowrap mt-1 mb-1">
                        <p><b>Estado:</b> <?php echo ($mostrarAutobus[3] == 'c') ? "Circulación" : (($mostrarAutobus[3] == 'm') ? "Mantenimiento" : "Suspendido") ?> </p>
                      </div>
                    <?php
                    } else {
                    ?>
                      <h3 class="d-inline-block mb-2 text-danger"><span class="fa fa-exclamation-circle"></span> Sin datos</h3>
                      <hr>
                      <p>Por el momento, usted no tiene autobus asignado</p>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!---- Fin de sección autobus ----->
            <!-- Modal Editar -->
            <div class="modal fade" id="modalTerminalDestino" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #FF6038;color: white; font-weight: bold;">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-map-marker"></span> Registrar llegada:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <form id="frmLlegada" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="input-group flex-nowrap mt-2 mb-2">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="inputGroupSelect01">Terminal:</label>
                                </div>
                                <input type="text" id="id_empleado" name="id_empleado" class="form-control" value="<?php echo $_SESSION['usuarioID']?>" style="display:none;">
                                <select class="custom-select" id="terminal" name="terminal">
                                  <option value="0" selected>Elija</option>

                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" id="submitEditar" name="submitEditar" class="btn btn-primary">Actualizar</button>
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
<script src="js/operadorAutobus.js"></script>