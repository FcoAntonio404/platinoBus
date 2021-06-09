$(document).ready(function () {
  $("#tablaMisBoletos").load("tablas/tablaMisBoletos.php");

  $("#frmRegistro").submit(function (event) {
    event.preventDefault();
    var nombre = $("#nombre").val();
    var apellidoP = $("#apellidoP").val();
    var apellidoM = $("#apellidoM").val();
    var correo = $("#correo").val();
    var telefono = $("#telefono").val();
    var nombreUser = $("#nombreUser").val();
    var pass = $("#pass").val();
    if (
      nombre == "" &&
      apellidoP == "" &&
      apellidoM == "" &&
      correo == "" &&
      telefono == "" &&
      nombreUser == "" &&
      pass == ""
    ) {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTexto(nombre, "Nombre(s)") == 1 &&
        validarTexto(apellidoP, "Apellido paterno") == 1 &&
        validarTexto(apellidoM, "Apellido materno") == 1 &&
        validarCorreo(correo, "Correo") == 1 &&
        validarTelefono(telefono, "Teléfono") == 1 &&
        validarUsuario(nombreUser, "Nombre de usuario") == 1 &&
        validarPass(pass, "contraseña") == 1
      ){
        $.ajax({
        url: "controlador/agregarUsuario.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function (r) {
          if (r != false && r != 2 && r == 1) {
            $("#frmRegistro")[0].reset();
            $("#modalRegistro").modal('hide');
            $("#modalIniciarSesion").modal('show');
            alertify.success("El registro se realizó con exito, inicie sesión");
          } else if (r == 2) {
            alertify.error("¡ERROR! Nombre de usuario ya existe");
          } else if(r == 3) {
            alertify.error("¡ERROR! Correo electrónico ya registrado");
          } else if(r == 4) {
            alertify.error("¡ERROR! Nombre de usuario y correo electrónico ya registrados");
          } else {
            alertify.error(
              "Falló el proceso de registro, verifique los datos"
            );
          }
        },
      });
      }
    }
    return false;
  });

  $("#frmEditarCliente").submit(function (event) {
    event.preventDefault();
    var nombre = $("#nombreAct").val();
    var apellidoP = $("#apellidoPAct").val();
    var apellidoM = $("#apellidoMAct").val();
    var correo = $("#correoAct").val();
    var telefono = $("#telefonoAct").val();
    var pass = $("#passAct").val();
    if (
      nombre == "" &&
      apellidoP == "" &&
      apellidoM == "" &&
      correo == "" &&
      telefono == ""
    ) {
      alertify.warning("A excepción del campo Contraseña, no debe haber campos vacios");
    } else {
      if (
        validarTexto(nombre, "Nombre(s)") == 1 &&
        validarTexto(apellidoP, "Ap. Paterno") == 1 &&
        validarTexto(apellidoM, "Ap. Materno") == 1 &&
        validarCorreo(correo, "Correo") == 1 &&
        validarTelefono(telefono, "Teléfono") == 1 &&
        (pass == "" || validarPass(pass, "Contraseña") == 1)
      ) {
        $.ajax({
          url: "controlador/actualizarCliente.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          success: function (r) {
            if (r == 1) {
              $("#frmEditarCliente")[0].reset();
              $("#modalEditarCliente").modal("hide");
              alertify.success("Se guardaron los cambios con exito");
              alertify.warning("Recargando información...");
              setTimeout(function () {
                location.reload();
              }, 2000);
            } else if (r == 2) {
              alertify.error("El nuevo correo ya se encuentra registrado, ¡Verifique!");
            } else if (r == 3) {
              alertify.error("Fallo al guardar cambios, verifique los datos.");
            } else {
              alertify.error("Fallo al guardar cambios, verifique los datos");
            }
          },
        });
      }
    }
    return false;
  });
});
function eliminarCliente(cliente) {
    alertify.confirm(
      "Eliminar cuenta",
      "¿Seguro de eliminar su cuenta? Este proceso es irreversible",
      function () {
        $.ajax({
          type: "POST",
          data: "cliente=" + cliente,
          url: "controlador/eliminarCliente.php",
          success: function (r) {
            if (r == 1) {
              alertify.success("¡Cuenta eliminada con exito!");
              alertify.warning("Reiniciando el sistema...");
              setTimeout(function () {
                self.location = "index.php";
              }, 2000);

            } else {
              alertify.error("No se pudo eliminar su cuenta");
            }
          },
        });
      },
      function () {}
    ); ///
  }

  function agregaFrmEditarPerfil(cliente) {
    $.ajax({
      type: "POST",
      data: "cliente=" + cliente,
      url: "controlador/obtenerDatosCliente.php",
      success: function (res) {
        datos = jQuery.parseJSON(res);
        $("#id_cliente").val(datos["idCliente"]);
        $("#nombreAct").val(datos["nombre"]);
        $("#apellidoPAct").val(datos["apellidoP"]);
        $("#apellidoMAct").val(datos["apellidoM"]);
        $("#correoAct").val(datos["correo"]);
        $("#telefonoAct").val(datos["telefono"]);
        $("#nombreUserAct").val(datos["usuario"]);
        console.log(datos);
      },
    });
  }