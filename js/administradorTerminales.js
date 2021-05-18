$(document).ready(function () {
  $("#tablaTerminales").load("tablas/tablaTerminales.php");

  var $input = $("#imagen");
  var extensiones = ["png", "jpg", "jpeg"];

  $input.on("change", function (e) {
    var file = this.files[0];
    if (!validarExtension(file)) {
      alertify.warning("La imágen no cumple el formato (JPEG/JPG/PNG)");
      $("#imagen").val("");
    }
  });

  function validarExtension(file) {
    var file_name = file.name;
    var file_extension = file_name.split(".").pop();
    return extensiones.includes(file_extension);
  }

  $("#frmAltaTerminal").submit(function (event) {
    event.preventDefault();
    var nombreTer = $("#nombreTer").val();
    var direccionTer = $("#direccionTer").val();
    var ciudadTer = $("#ciudadTer").val();
    var estadoTer = $("#estadoTer").val();
    var telefonoTer = $("#telefonoTer").val();
    var imagen = $("#imagen").val();
    if (
      nombreTer == "" &&
      direccionTer == "" &&
      ciudadTer == "" &&
      estadoTer == "" &&
      telefonoTer == "" &&
      imagen == ""
    ) {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTexto(nombreTer, "Nombre Terminal") == 1 &&
        validarDireccion(direccionTer, "Dirección") == 1 &&
        validarTexto(ciudadTer, "Ciudad") == 1 &&
        validarTexto(estadoTer, "Estado") == 1 &&
        validarTelefono(telefonoTer, "Teléfono") == 1 &&
        validarImagen(imagen, "Imágen") == 1 
      ) {
        $.ajax({
          url: "controlador/agregarTerminal.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          success: function (r) {
            if (r != false && r != 2 && r == 1) {
              $("#frmAltaTerminal")[0].reset();
              $("#tablaTerminales").load("tablas/tablaTerminales.php");
              alertify.success("El registro se realizó con exito");
            } else if (r == 2) {
              alertify.error("¡ERROR!, Nombre de terminal ya existe");
            } else if(r == 3){
              alertify.error("¡ERROR!, La imagen no se pudo guardar");
            } else{
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

  $("#frmEditarTer").submit(function (event) {
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
              $("#frmEditarEmp")[0].reset();
              $("#modalEditarEmp").modal("hide");
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
function eliminarTerminal(terminal) {
    alertify.confirm(
      "Eliminar a una terminal",
      "Eliminar una terminal puede causar la pérdida de demás datos importantes ¿Seguro de eliminar esta terminal?",
      function () {
        $.ajax({
          type: "POST",
          data: "terminal=" + terminal,
          url: "controlador/eliminarTerminal.php",
          success: function (r) {
            if (r == 1) {
              $("#tablaTerminales").load("tablas/tablaTerminales.php");
              alertify.success("¡La termianl se ha eliminado con exito!");
            } else {
              $("#tablaTerminales").load("tablas/tablaTerminales.php");
              alertify.error("No se pudo eliminar la terminal");
            }
          },
        });
      },
      function () {}
    ); ///
  }

  function agregaFrmEditarTerminal(terminal) {
    var empleados = $("#empleado");
    var html = '';
    $.ajax({
      type: "POST",
      data: "terminal=" + terminal,
      url: "controlador/obtenerDatosTerminal.php",
      success: function (res) {
        datos = JSON.parse(res);
        $("#id_terminal").val(datos["idTerminal"]);
        $("#nombreTerAct").val(datos["nombreTer"]);
        $("#direccionTerAct").val(datos["direccionTer"]);
        $("#ciudadTerAct").val(datos["ciudadTer"]);
        $("#estadoTerAct").val(datos["estadoTer"]);
        //$("#empleado").val(datos["idEmpleado"]);
        $("#telefonoTerAct").val(datos["telefonoTer"]);
        $("#img").attr("src", "img/terminales/"+datos["imagen"]);
        console.log(datos);
        console.log(datos["empleados"]);

        empleados.find("option").remove();

        $(datos["empleados"]).each(function (i,v) {
          html += '<option value="'+v.id_empleado+'">'+ v.nombre_emp + ' ' + v.apellidop_emp + '</option>';
          
        });
        empleados.append(html);
        console.log(html);

      },
    });
  }