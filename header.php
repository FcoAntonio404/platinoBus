 <header>
   <nav class="navbar nav-pills fixed-top navbar-expand-md navbar-dark bg-dark shadow-sm">
     <div class="container-fluid">
       <a class="navbar-brand" href="index.php"><img src="img/PB_Icon.png" alt="logotipo" class="d-inline-block align-top" width="25" height="30"> PlatinoBus</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="menu">
         <ul class="navbar-nav me-auto mb-2 mb-md-0 text-center">
           <?php
            if (!isset($_SESSION['usuarioNombre'])) {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="terminales.php">Terminales</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#contacto" tabindex="-1" aria-disabled="true">Contacto</a>
             </li>
             <li class="nav-item">
               <button type="button" class="btn btn-sm m-1 btn-outline-secondary" data-toggle="modal" data-target="#modalIniciarSesion">Iniciar sesión</button>
             </li>
             <li class="nav-item">
               <button type="button" class="btn btn-sm m-1 btn-info" data-toggle="modal" data-target="#modalRegistro">Registrarse</button>
             </li>
           <?php
            } else if ($_SESSION['usuarioTipo'] == "1") {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="administradorTerminales.php">Terminales</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="administradorRutas.php">Rutas</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="administradorAutobuses.php">Autobuses</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="administradorEmpleados.php">Empleados</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="terminalesAdmin.php">Boletos</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="administradorClientes.php">Clientes</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" tabindex="-1" aria-disabled="true"><?php echo ' Bienvenido: @' . $_SESSION['usuarioNombre']; ?> </a>
             </li>
             <li class="nav-item">
               <a class="btn btn-sm m-1 btn-info" href="controlador/logout.php">Cerrar sesión</a>
             </li>
           <?php
            } else if ($_SESSION['usuarioTipo'] == "2") {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="index.php">Rutas</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="verificadorBoletos.php">Boletos</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" tabindex="-1" aria-disabled="true"><?php echo ' Bienvenido: EV-' . $_SESSION['usuarioNombre']; ?> </a>
             </li>
             <li class="nav-item">
               <a class="btn btn-sm m-1 btn-info" href="controlador/logout.php">Cerrar sesión</a>
             </li>
           <?php
            } else if ($_SESSION['usuarioTipo'] == "3") {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="verificadorBoletos.php">Verificar boletos</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" tabindex="-1" aria-disabled="true"><?php echo ' Bienvenido: VB-' . $_SESSION['usuarioNombre']; ?> </a>
             </li>
             <li class="nav-item">
               <a class="btn btn-sm m-1 btn-info" href="controlador/logout.php">Cerrar sesión</a>
             </li>
           <?php
            } else if ($_SESSION['usuarioTipo'] == "4") {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="operadorAutobus.php">Autobus</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " data-toggle="modal" data-target="#modalTerminalDestino" onclick="agregaFrmTerminalDestino('<?php echo $_SESSION['usuarioID'] ?>')">Registar llegada</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" tabindex="-1" aria-disabled="true"><?php echo ' Bienvenido: OP-' . $_SESSION['usuarioNombre']; ?> </a>
             </li>
             <li class="nav-item">
               <a class="btn btn-sm m-1 btn-info" href="controlador/logout.php">Cerrar sesión</a>
             </li>
           <?php
            } else if ($_SESSION['usuarioTipo'] == "5") {
            ?>
             <li class="nav-item">
               <a class="nav-link " href="terminales.php">Terminales</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="index.php">Rutas</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " data-toggle="modal" data-target="#modalMisBoletos">Mis boletos</a>
             </li>
             <li class="nav-item">
               <a class="nav-link " href="usuarioGestion.php">Mi perfil</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" tabindex="-1" aria-disabled="true"><?php echo ' Bienvenido: ' . $_SESSION['usuarioNombre']; ?> </a>
             </li>
             <li class="nav-item">
               <a class="btn btn-sm m-1 btn-info" href="controlador/logout.php">Cerrar sesión</a>
             </li>
           <?php
            }
            ?>
         </ul>
       </div>
     </div>
   </nav>
 </header>
 <!-- Modal Registro -->
 <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header" style="background-color: #17a2b8;color: white; font-weight: bold;">
         <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar cuenta:</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="container-fluid">
           <form id="frmRegistro" enctype="multipart/form-data">
             <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="input-group flex-nowrap mt-2 mb-2">
                     <div class="input-group-prepend">
                       <span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                     </div>
                     <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre(s)" aria-label="Username" aria-describedby="addon-wrapping">
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-6">
                   <div class="input-group flex-nowrap mt-2 mb-2">
                     <div class="input-group-prepend">
                       <span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                     </div>
                     <input type="text" id="apellidoP" name="apellidoP" class="form-control" placeholder="Ap. Paterno" aria-label="Username" aria-describedby="addon-wrapping">
                   </div>
                 </div>
                 <div class="col-md-6">
                   <div class="input-group flex-nowrap mt-2 mb-2">
                     <div class="input-group-prepend">
                       <span class="input-group-text" id="addon-wrapping"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                     </div>
                     <input type="text" id="apellidoM" name="apellidoM" class="form-control" placeholder="Ap. Materno" aria-label="Username" aria-describedby="addon-wrapping">
                   </div>
                 </div>
               </div>
               <div class="input-group flex-nowrap mt-2 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                 </div>
                 <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo electronico" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="input-group flex-nowrap mt-3 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-phone" aria-hidden="true"></i></span>
                 </div>
                 <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Tel&eacute;fono celular (10 d&iacute;gitos)" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="input-group flex-nowrap  mt-3 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-user" aria-hidden="true"></i></span>
                 </div>
                 <input type="text" id="nombreUser" name="nombreUser" class="form-control" placeholder="Nombre de usuario (max. 15 caracteres)" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="input-group flex-nowrap  mt-3 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                 </div>
                 <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña (max. 16 caracteres)" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="row">
                 <div class="col-md-12 mb-3">
                   <div class="alert alert-primary " role="alert" id="OKE" style="display:none;">
                     <label> Todos los datos son obligatorios.
                       Verifique el campo: <strong id="msm"></strong>;
                       <span> </span>
                     </label>
                   </div>
                 </div>
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
               <button type="submit" id="submitRegistroUsuario" name="submitRegistroUsuario" class="btn btn-primary">Crear cuenta</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Inicio de sesión -->
 <div class="modal fade" id="modalIniciarSesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header" style="background-color: #17a2b8;color: white; font-weight: bold;">
         <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-in" aria-hidden="true"></i> Iniciar sesi&oacute;n:</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="container-fluid">
           <form id="frmIniciarSesion" action="controlador/login.php" method="POST" enctype="multipart/form-data">
             <div class="card-body">
               <div class="input-group flex-nowrap mt-2 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-user" aria-hidden="true"></i></span>
                 </div>
                 <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="input-group flex-nowrap mt-3 mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock" aria-hidden="true"></i></span>
                 </div>
                 <input type="password" id="passAuntenticar" name="passAuntenticar" class="form-control" placeholder="Contraseña" aria-label="Username" aria-describedby="addon-wrapping">
               </div>
               <div class="row">
                 <div class="col-md-12 mb-3">
                   <div class="alert alert-danger" role="alert" id="alertError" style="display:none;">
                     <label> El usuario <strong>no esta registrado</strong>,verifique.
                     </label>
                   </div>
                 </div>
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
               <button type="submit" id="submitLogin" name="submitLogin" class="btn btn-primary">Iniciar sesión</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- Modal Consultar Mis Boletos -->
 <div class="modal fade" id="modalMisBoletos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header" style="background-color: #338FB6;color: white; font-weight: bold;">
         <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-ticket"></span> Consultar boletos:</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body text-center">
         <div class="container-fluid">
           <h3 class="d-inline-block mb-2 text-info"><span class="fa fa-ticket"></span> Boletos comprados:</h3>
           <div id="tablaMisBoletos" class="mt-3"></div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- Fin de modal -->