$(document).ready(function () {
  $("#tablaDatatable").load("tablas/tablaEmpleados.php");

  $("#frmAlta").submit(function (event) {
    event.preventDefault();
    var terminal = $("#terminal").val();
    var nombreEmp = $("#nombreEmp").val();
    var apellidoPEmp = $("#apellidoPEmp").val();
    var apellidoMEmp = $("#apellidoMEmp").val();
    var direccionEmp = $("#direccionEmp").val();
    var telefonoEmp = $("#telefonoEmp").val();
    var fechaEmp = $("#fechaEmp").val();
    var rolEmp = $("#rolEmp").val();
    var usuarioEmp = $("#nombreUserEmp").val();
    var passEmp = $("#passEmp").val();
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
      ){
        $.ajax({
        url: "controlador/agregarEmpleado.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        cache: false,
        success: function (r) {
          if (r != false && r != 2 && r == 1) {
            $("#frmAlta")[0].reset();
            $("#tablaDatatable").load("tablas/tablaEmpleados.php");
            alertify.success("El registro se realizó con exito");
          } else if (r == 2) {
            alertify.error("¡ERROR! Nombre de usuario ya existe");
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

  $("#frmEditarEmp").submit(function (event) {
    event.preventDefault();
    var terminal = $("#terminalEmpAct").val();
    var nombreEmp = $("#nombreEmpAct").val();
    var apellidoPEmp = $("#apellidoPEmpAct").val();
    var apellidoMEmp = $("#apellidoMEmpAct").val();
    var direccionEmp = $("#direccionEmpAct").val();
    var telefonoEmp = $("#telefonoEmpAct").val();
    var fechaEmp = $("#fechaEmpAct").val();
    var rolEmp = $("#rolEmpAct").val();
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
      usuarioEmp == ""
    ) {
      alertify.warning("A excepción del campo Nueva contraseña, no debe haber campos vacios");
    } else {
      //if (passEmp == "" || validarPass(passEmp, "Contraseña") == 1)
        if (
          validarTerminalRol(terminal, "Termninal") == 1 &&
          validarTexto(nombreEmp, "Nombre(s)") == 1 &&
          validarTexto(apellidoPEmp, "Apellido paterno") == 1 &&
          validarTexto(apellidoMEmp, "Apellido materno") == 1 &&
          validarDireccion(direccionEmp, "Dirección") == 1 &&
          validarTelefono(telefonoEmp, "Teléfono") == 1 &&
          validarFecha(fechaEmp, "Fecha de ingreso laboral") == 1 &&
          validarTerminalRol(rolEmp, "Rol") == 1 &&
          (passEmp == "" || validarPass(passEmp, "Contraseña") == 1)
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
                $("#frmEditarEmp")[0].reset();
                $("#modalEditarEmp").modal("hide");
                $("#tablaDatatable").load("tablas/tablaEmpleados.php");
                alertify.success("Se guardaron los cambios con exito");
              } else {
                $("#tablaDatatable").load("tablas/tablaEmpleados.php");
                alertify.error("Falló el proceso, verifique los datos");
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

  function agregaFrmEditar(empleado) {
    $.ajax({
      type: "POST",
      data: "empleado=" + empleado,
      url: "controlador/obtenerDatosEmpleado.php",
      success: function (res) {
        datos = jQuery.parseJSON(res);
        $("#id_empleado").val(datos["idEmpleado"]);
        $("#terminalEmpAct").val(datos["idTerminal"]);
        $("#nombreEmpAct").val(datos["nombreEmp"]);
        $("#apellidoPEmpAct").val(datos["apellidoPEmp"]);
        $("#apellidoMEmpAct").val(datos["apellidoMEmp"]);
        $("#direccionEmpAct").val(datos["direccionEmp"]);
        $("#telefonoEmpAct").val(datos["telefonoEmp"]);
        $("#fechaEmpAct").val(datos["fechaEmp"]);
        $("#rolEmpAct").val(datos["rolEmp"]);
        $("#nombreUserEmpAct").val(datos["usuarioEmp"]);
      },
    });
  }