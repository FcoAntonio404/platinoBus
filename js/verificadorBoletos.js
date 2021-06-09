$(document).ready(function () {
  $("#tablaDatatable").load("tablas/tablaBoletos.php");

  $("#frmAltaAutobuses").submit(function (event) {
    event.preventDefault();
    var empleado = $("#empleado").val();
    var numeroBus = $("#numeroBus").val();
    var placaBus = $("#placaBus").val();
    var asientos = $("#asientos").val();
    if (empleado == "0" && numeroBus == "" && placaBus == "" && asientos == "Elija") {
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
            alertify.error("¡ERROR! Número de autobus o de placa ya existe");
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

  $("#frmEditarAutobus").submit(function (event) {
    event.preventDefault();
    var empleado = $("#empleadoAct").val();
    var placa = $("#placaBusAct").val();
    var estado = $("#estadoAct").val();
    if (
      empleado == "" &&
      placa == "" &&
      estado == "Elija"
    ) {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTerminalRol(empleado, "Operador") == 1 &&
        validarPlaca(placa, "Número de placa") == 1 &&
        validarEstado(estado, "Estado del autobus") == 1
      ) {
        $.ajax({
          url: "controlador/actualizarAutobus.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          success: function (r) {
            if (r == 1) {
              $("#frmEditarAutobus")[0].reset();
              $("#modalEditarAutobus").modal("hide");
              $("#tablaDatatable").load("tablas/tablaAutobuses.php");
              alertify.success("Se guardaron los cambios con exito");
            } else if (r == 2) {
              $("#tablaDatatable").load("tablas/tablaAutobuses.php");
              alertify.error("¡ERROR! Número de placa ya registrado");
            } else {
              $("#tablaDatatable").load("tablas/tablaAutobuses.php");
              alertify.error("Falló el proceso, verifique los datos");
            }
          },
        });
      }
    }
    return false;
  });
});
function eliminarAutobus(autobus) {
    alertify.confirm(
      "Eliminar un autobus",
      "¿Seguro de eliminar este registro?",
      function () {
        $.ajax({
          type: "POST",
          data: "autobus=" + autobus,
          url: "controlador/eliminarAutobus.php",
          success: function (r) {
            if (r == 1) {
              $("#tablaDatatable").load("tablas/tablaAutobuses.php");
              alertify.success("¡Registro eliminado con exito!");
            } else {
              $("#tablaDatatable").load("tablas/tablaAutobuses.php");
              alertify.error("No se pudo eliminar el registro");
            }
          },
        });
      },
      function () {}
    ); ///
  }

  function agregaFrmEditarEstado(boleto) {
    $.ajax({
      type: "POST",
      data: "boleto=" + boleto,
      url: "controlador/obtenerDatosBoleto.php",
      success: function (res) {
        datos = jQuery.parseJSON(res);
        $("#id_boleto").val(datos["idBoleto"]);
        $("#ruta").val(datos["origen"] + " - " + datos["destino"]);
        $("#horario").val(datos["horario"]);
        $("#fechaSalida").val(datos["fecha"]);
        $("#asiento").val(datos["asiento"]);
        $("#estado").val(datos["estado"]);
        console.log(datos);
      },
    });
  }