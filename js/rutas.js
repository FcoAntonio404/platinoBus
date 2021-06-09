var fechaSolicitada;
$(document).ready(function () {
  var html;
  $("#terminalDestino").prop("disabled", true);
  $("#terminalOrigen").change(function () {
    var destino = $("#terminalDestino");
    $("#terminalDestino").prop("disabled", true);
    var origen = $(this);
    html = "";
    if ($(this).val() != 0) {
      $.ajax({
        data: {
          origen: origen.val(),
        },
        url: "controlador/terminalesDestino.php",
        type: "POST",
        dataType: "json",
        beforeSend: function () {
          origen.prop("disabled", true);
        },
        success: function (respuesta) {
          res = JSON.parse(respuesta);

          origen.prop("disabled", false);
          destino.find("option").remove();
          $(res).each(function (i, v) {
            html +=
              '<option value = "' +
              v.id_terminal +
              '">' +
              v.ciudad_ter +
              "</option>";
          });
          destino.append(html);
          console.log(res);
          destino.prop("disabled", false);
        },
        error: function () {
          alert("Ocurrio un error en el servidor ..");
          origen.prop("disabled", false);
        },
      });
    } else {
      //origen.find('option').remove();
      //origen.prop('disabled', true);
    }
  });

  $("#categoria").change(function () {
    if ($(this).val() != 0) {
      $("#total").val($("#costo").val() * 0.9);
    } else {
      $("#total").val($("#costo").val());
    }
  });

  $("#frmRutas").submit(function (event) {
    event.preventDefault();

    var origen = $("#terminalOrigen").val();
    var destino = $("#terminalDestino").val();
    fechaSolicitada = $("#fecha").val();
    if (origen == "0" && destino == "Elija" && fechaSolicitada == "") {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTerminalRol(origen, "Terminal origen") == 1 &&
        validarTerminalRol(destino, "Terminal destino") == 1 &&
        validarFechaSalida(fechaSolicitada, "Fecha") == 1
      ) {
        html = "";
        $.ajax({
          url: "controlador/obtenerRutas.php",
          method: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          cache: false,
          beforeSend: function () {
            $("#terminalOrigen").prop("disabled", true);
            $("#terminalDestino").prop("disabled", true);
            $("#fecha").prop("disabled", true);
          },
          success: function (respuesta) {
            res = JSON.parse(respuesta);

            $("#terminalOrigen").prop("disabled", false);
            $("#terminalDestino").prop("disabled", false);
            $("#fecha").prop("disabled", false);

            $("#rutasRecibidas").find("div").remove();
            if ($.isEmptyObject(res)) {
              html =
                '<div class = "col-md-12 mt-3"> <h3 class="text-center text-danger"><span class="fa fa-exclamation-circle"></span> Sin rutas </h3> </div>';
            } else {
              $(res).each(function (i, v) {
                html +=
                  '<div class = "col-md-4 mt-3" > ' +
                  '<div class="card shadow">' +
                  '<img src="img/terminales/' +
                  v.imagen +
                  '" alt="logotipo" class="card-img">' +
                  '<div class="card-body">' +
                  '<h3 class="text-info"><span class="fa fa-map-marker"></span>' +
                  " " +
                  v.origen +
                  " - " +
                  v.destino +
                  "</h3>" +
                  '<p class="card-text"><b> Horario: ' +
                  v.horario +
                  " hrs. </b> </p>" +
                  '<p class="card-text"><span class="fa fa-calendar-check-o"></span>' +
                  " " +
                  fechaSolicitada +
                  " </p>" +
                  '<div class="d-flex justify-content-between align-items-center">' +
                  '<div class="btn-group">' +
                  '<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalConsulta" onclick="agregaFrmConsultar(' +
                  v.id_ruta +
                  ')">Consultar</button>' +
                  "</div>" +
                  '<p class="text-dark"><b> Costo: $' +
                  v.precio +
                  " </b></p>" +
                  "</div>" +
                  "</div>" +
                  "</div>" +
                  "</div>";
              });
            }
            $("#rutasRecibidas").append(html);
            console.log(res);
          },
          error: function () {
            alert("Ocurrio un error en el servidor");
            $("#terminalOrigen").prop("disabled", false);
            $("#terminalDestino").prop("disabled", false);
            $("#fecha").prop("disabled", false);
          },
        });
      } else {
        $("#rutasRecibidas").find("div").remove();
      }
    }
    return false;
  });

  $("#frmConsultarBoletos").submit(function (event) {
    event.preventDefault();
    procesarBoleto(new FormData(this));
    return false;
  });
});
function procesarBoleto(data) {
  var tipoUsuario = $("#usuarioTipo").val();
  var fecha = $("#fechaSalida").val();
  var asientoNum = $("#asiento").val();
  var nombre = $("#nombreCliente").val();
  if (tipoUsuario == "1" || tipoUsuario == "2") {
    var categoria = $("#categoria").val();
    var total = $("#total");
    if (asientoNum == "" && categoria == "Elija" && nombre == "") {
      alertify.warning("Ingrese todos los datos solicitados");
    } else {
      if (
        validarTerminalRol(asientoNum, "Asiento") == 1 &&
        validarCategoria(categoria, "Categoria") == 1 &&
        validarTexto(nombre, "Nombre")
      ) {
        $.ajax({
          url: "controlador/agregarBoleto.php",
          method: "POST",
          data: data,
          contentType: false,
          processData: false,
          cache: false,
          success: function (r) {
            if (r == 1) {
              $("#frmConsultarBoletos")[0].reset();
              $("#modalConsulta").modal("hide");
              alertify.success("La compra se realizó con exito");
            } else if (r == 2) {
              alertify.error(
                "¡ERROR! Asiento ya vendido, hace unos instantes!!!"
              );
            } else {
              alertify.error(
                "Falló el proceso de registro, verifique los datos"
              );
            }
          },
        });
      }
    }
  }
}

function agregaFrmConsultar(ruta) {
  $("#frmConsultarBoletos")[0].reset();
  $.ajax({
    type: "POST",
    data: {
      ruta: ruta,
      fecha: fechaSolicitada,
    },
    url: "controlador/obtenerDatosRuta.php",
    success: function (res) {
      datos = JSON.parse(res);
      $("#rutaNombre").html(
        "<span class='fa fa-map-marker'></span>" +
          " " +
          datos["origen"] +
          " - " +
          datos["destino"]
      );
      $("#id_ruta").val(datos["idRuta"]);
      $("#fechaSalida").val(datos["fecha"]);
      $("#horario").val(datos["horario"] + " hrs.");
      $("#costo").val(datos["costo"]);
      console.log(datos);
      console.log(datos["asientos"]);
      var tabla = "";
      var aux = "";
      var asiento = 1;
      tabla +=
        "<table class='table table-bordered table-striped' cellspacing='0' width='100%' id='idtablaBoletos'>";
      if ($.isEmptyObject(datos["asientos"])) {
        for (var i = 1; i <= 8; i++) {
          tabla += "<tr>";
          for (var x = 1; x <= 5; x++) {
            if (
              x == 3 ||
              (x >= 4 &&
                i == 1 &&
                (datos["asientosCant"] == "30" ||
                  datos["asientosCant"] == "29")) ||
              (x == 4 && i == 2 && datos["asientosCant"] == "29")
            )
              aux = "<td style='text-align: center;'>  </td>";
            else {
              aux =
                "<td style='text-align: center;'> <img src='img/asiento.png' class='d-inline-block align-top' width='25' height='30'> <a onclick='agregarAsiento(this)' data-value='" +
                asiento +
                "'>" +
                asiento++ +
                "</a> </td>";
            }

            tabla += aux;
          }
          tabla += "</tr>";
        }
      } else {
        for (var i = 1; i <= 8; i++) {
          tabla += "<tr>";
          for (var x = 1; x <= 5; x++) {
            if (
              x == 3 ||
              (x >= 4 &&
                i == 1 &&
                (datos["asientosCant"] == "30" ||
                  datos["asientosCant"] == "29")) ||
              (x == 4 && i == 2 && datos["asientosCant"] == "29")
            )
              aux = "<td style='text-align: center;'>  </td>";
            else {
              if (datos["asientos"].find((v) => v.num_asiento == asiento))
                aux =
                  "<td style='text-align: center;'> <img src='img/asientoOcupado.png' class='d-inline-block align-top' width='25' height='30'> <a onclick='asientoOcupado(this)' data-value='" +
                  asiento +
                  "'>" +
                  asiento++ +
                  "</a> </td>";
              else
                aux =
                  "<td style='text-align: center;'> <img src='img/asiento.png' class='d-inline-block align-top' width='25' height='30'> <a onclick='agregarAsiento(this)' data-value='" +
                  asiento +
                  "'>" +
                  asiento++ +
                  "</a> </td>";
            }

            tabla += aux;
          }
          tabla += "</tr>";
        }
      }
      tabla += "</table>";
      $("#tablaAsientos").html(tabla);
    },
  });
}
function agregarAsiento(asiento) {
  $("#asiento").val($(asiento).data("value"));
}
function asientoOcupado(asiento) {
  alert("El asiento con número: " + $(asiento).data("value") + " esta ocupado");
}
