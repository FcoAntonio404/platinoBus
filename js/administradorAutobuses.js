$(document).ready(function () {
  $("#tablaDatatable").load("tablas/tablaAutobuses.php");

  $("#frmAltaAutobuses").submit(function (event) {
    event.preventDefault();
    var empleado = $("#empleado").val();
    var numeroBus = $("#numeroBus").val();
    var placaBus = $("#placaBus").val();
    var asientos = $("#asientos").val();
    if (empleado == "Elija" && numeroBus == "" && placaBus == "" && asientos == "Elija") {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTerminalRol(empleado, "Operador") == 1 &&
        validarNumeroTres(numeroBus, "No. de Autobus") == 1 &&
        validarPlaca(placaBus, "No. de Placa") == 1 &&
        validarTerminalRol(asientos, "Asientos") == 1
      ){
        $.ajax({
        url: "controlador/agregarAutobus.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function (r) {
          if (r != false && r != 2 && r == 1) {
            $("#frmAltaAutobuses")[0].reset();
            $("#tablaDatatable").load("tablas/tablaAutobuses.php");
            alertify.success("El registro se realizó con exito");
          } else if (r == 2) {
            alertify.error("¡ERROR!, Número de autobus o de placa ya existe");
          } else {
            alertify.error(
              "Fallo al realizar el registro, verifique los datos"
            );
          }
        },
      });
      }
    }
    return false;
  });

  $("#frmEditarAutobuses").submit(function (event) {
    event.preventDefault();
    var terminal = $("#terminalEmpAct").val();
    var nombreEmp = $("#nombreEmpAct").val();
    var apellidoPEmp = $("#apellidoPEmpAct").val();
    var apellidoMEmp = $("#apellidoMEmpAct").val();
    var direccionEmp = $("#direccionEmpAct").val();
    var telefonoEmp = $("#telefonoEmpAct").val();
    var fechaEmp = $("#fechaEmpAct").val();
    var rolEmp = $("#rolEmpAct").val();
    var usuarioEmp = $("#nombreUserEmpAct").val();
    var passEmp = $("#passEmpAct").val();
    if (
      terminal == "Elija" &&
      nombreEmp == "" &&
      apellidoPEmp == "" &&
      apellidoMEmp == "" &&
      direccionEmp == "" &&
      telefonoEmp == "" &&
      fechaEmp == "" &&
      rolEmp == "Elija" &&
      usuarioEmp == "" &&
      passEmp == ""
    ) {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTerminalRol(terminal, "Termninal") == 1 &&
        validarTexto(nombreEmp, "Nombre(s)") == 1 &&
        validarTexto(apellidoPEmp, "Apellido paterno") == 1 &&
        validarTexto(apellidoMEmp, "Apellido materno") == 1 &&
        validarDireccion(direccionEmp, "Dirección") == 1 &&
        validarTelefono(telefonoEmp, "Teléfono") == 1 &&
        validarFecha(fechaEmp, "Fecha de ingreso laboral") == 1 &&
        validarTerminalRol(rolEmp, "Rol") == 1 &&
        validarUsuario(usuarioEmp, "Usuario") == 1 &&
        validarPass(passEmp, "Contraseña") == 1
      ) {
        $.ajax({
          url: "controlador/actualizarEmpleado.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          success: function (r) {
            if (r == 1) {
              $("#frmEditarAutobuses")[0].reset();
              $("#modalEditarAutobuses").modal("hide");
              $("#tablaDatatable").load("tablas/tablaEmpleados.php");
              alertify.success("Se guardaron los cambios con exito");
            } else {
              $("#tablaDatatable").load("tablas/tablaEmpleados.php");
              alertify.error("Fallo al guardar cambios, verifique los datos");
            }
          },
        });
      }
    }
    return false;
  });
});
function eliminarEmpleado(empleado) {
    alertify.confirm(
      "Eliminar a un empleado",
      "¿Seguro de eliminar este registro?",
      function () {
        $.ajax({
          type: "POST",
          data: "empleado=" + empleado,
          url: "controlador/eliminarEmpleado.php",
          success: function (r) {
            if (r == 1) {
              $("#tablaDatatable").load("tablas/tablaEmpleados.php");
              alertify.success("¡Registro eliminado con exito!");
            } else {
              $("#tablaDatatable").load("tablas/tablaEmpleados.php");
              alertify.error("No se pudo eliminar el registro");
            }
          },
        });
      },
      function () {}
    ); ///
  }

  function agregaFrmEditarAutobus(autobus) {
    $.ajax({
      type: "POST",
      data: "autobus=" + autobus,
      url: "controlador/obtenerDatosAutobus.php",
      success: function (res) {
        datos = jQuery.parseJSON(res);
        $("#id_autobus").val(datos["idAutobus"]);
        $("#empleadoAct").val(datos["idEmpleado"]);
        $("#numeroBusAct").val(datos["numeroAutobus"]);
        $("#placaBusAct").val(datos["numPlaca"]);
        $("#asientosAct").val(datos["asientos"]);
        $("#estadoAct").val(datos["estado"]);
        console.log(datos);
      },
    });
  }