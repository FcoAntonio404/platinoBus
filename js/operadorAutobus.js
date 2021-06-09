$(document).ready(function () {
    $("#frmLlegada").submit(function (event) {
      event.preventDefault();
      var terminal = $("#terminal").val();
      if (terminal == "0") {
        alertify.warning("No hay elección");
      } else {
        if (validarTerminalRol(terminal, "Terminal de llegada") == 1) {
          $.ajax({
            url: "controlador/agregarTerminalLlegada.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            success: function (r) {
              if (r != false && r != 2 && r == 1) {
                $("#modalTerminalDestino").modal("hide");
                alertify.success("El registro se realizó con exito");
                alertify.warning("Recargando información...");
                setTimeout(function () {
                  location.reload();
                }, 2000);
              } else {
                alertify.error("Ocurrió un error, intente nuevamente");
              }
            },
          });
        }
      }
      return false;
    });
  });
  
    function agregaFrmTerminalDestino(empleado) {
      var terminal = $("#terminal");
      var html = '<option value="0">Elija</option>';
      $.ajax({
        type: "POST",
        data: "empleado=" + empleado,
        url: "controlador/obtenerDatosTerminalOperador.php",
        success: function (res) {
          datos = JSON.parse(res);
          terminal.find("option").remove();
  
          $(datos).each(function (i,v) {
            html += '<option value="'+v.id_terminal+'">'+ v.nombre_ter + '</option>';
          });
          terminal.append(html);
        },
      });
    }