$(document).ready(function () {
    $("#tablaRutas").load("tablas/tablaRutas.php");
  
    $("#frmAltaRuta").submit(function (event) {
      event.preventDefault();
      var origen = $("#terminalOrigen").val();
      var destino = $("#terminalDestino").val();
      var autobus = $("#autobus").val();
      var horario = $("#horario").val();
      var precio = $("#precio").val();
      if (
        origen == "0" &&
        horario == "" &&
        precio == ""
      ) {
        alertify.warning("Ingrese todos los datos solicitados");
      } else {
        
        if (
          validarTerminalRol(origen, "Terminal Origen") == 1 &&
          validarTerminalRol(destino, "Terminal Destino") == 1 &&
          validarTerminalRol(autobus, "Autobus") == 1 &&
          //validarTexto(horario, "Horario") == 1 &&
          validarPrecio(precio, "Precio") == 1
        ) {
          //alert(origen + "/" + destino +"/" + autobus +"/"+ horario +"/" + precio);
          //return false;
          $.ajax({
            url: "controlador/agregarRuta.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            success: function (r) {
              if (r != false && r != 2 && r == 1) {
                $("#frmAltaRuta")[0].reset();
                $("#tablaRutas").load("tablas/tablaRutas.php");
                alertify.success("El registro se realizó con exito");
              } else if (r == 2) {
                alertify.error("El autobus ya se encuentra asignado a otra ruta en el mismo horario");
              } else{
                alertify.error("Ocurrió un error, verifique los datos");
              }
            },
          });
        }
      }
      return false;
    });
  
    $("#frmEditarRuta").submit(function (event) {
      event.preventDefault();
      var id_ruta = $("#id_ruta").val();
      var id_terminal_origen = $("#id_terminal_origen").val();
      var id_autobus = $("#id_autobus").val();
      var horario = $("#horario").val();
      var precio = $("#precio").val();
      var imagen = $("#imagen").val();
      if (
        
        id_ruta == "" &&
        id_terminal_origen == "" &&
        id_autobus == "" &&
        horario == "" &&
        precio == "" &&
        imagen == ""
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

  function ocultarRuta(ruta) {
      alertify.confirm(
        "Ocultar una ruta",
        "Ocultar una ruta para detener su venta de boletos, ¿seguro de ocultar esta ruta?",
        function () {
          $.ajax({
            type: "POST",
            data: "ruta=" + ruta,
            url: "controlador/ocultarRuta.php",
            success: function (r) {
              if (r == 1) {
                $("#tablaRutas").load("tablas/tablaRutas.php");
                alertify.success("¡La ruta se ha ocultado con exito!");
              } else {
                $("#tablaRutas").load("tablas/tablaRutas.php");
                alertify.error("No se pudo ocultar esta ruta");
              }
            },
          });
        },
        function () {}
      ); ///
    }

    function aparecerRuta(ruta) {
      alertify.confirm(
        "Hacer visible una ruta",
        "Hacer visible una ruta para retomar la venta de boletos, ¿seguro de reaparecer esta ruta?",
        function () {
          $.ajax({
            type: "POST",
            data: "ruta=" + ruta,
            url: "controlador/reaparecerRuta.php",
            success: function (r) {
              if (r == 1) {
                $("#tablaRutas").load("tablas/tablaRutas.php");
                alertify.success("¡La ruta ha vuelto a ser visible!");
              } else {
                $("#tablaRutas").load("tablas/tablaRutas.php");
                alertify.error("No se pudo reaparecer esta ruta");
              }
            },
          });
        },
        function () {}
      ); ///
    }
  
    function agregaFrmEditarRuta(ruta) {
      var autobuses = $("#autobuses");
      var html = '';
      $.ajax({
        type: "POST",
        data: "ruta=" + ruta,
        url: "controlador/obtenerDatosRutaEditar.php",
        success: function (res) {
          datos = JSON.parse(res);
          $("#id_ruta").val(datos["id_ruta"]);
          $("#origenC").val(datos["origen"]);
          $("#destinoC").val(datos["destino"]);
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