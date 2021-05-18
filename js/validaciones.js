var espaciosVacios = /^\s+$/;
var textoEspaciado = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/;
var nombreUsuario = /^[A-Za-z0-9_]{6,15}$/;
var contrasena = /^[A-Za-z0-9_]{6,16}$/;
var direccion = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s0-9.,;:#°]{10,150}$/;
var telefono = /^\d{10}$/;
var numeroTres= /^\d{1,3}$/;
var terminal = /^\d{1,3}$/;
var placa = /^[a-zA-Z]{3}-[0-9]{3}-[a-zA-Z0-9]{1}$/;
var correo = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
var fecha = /^\d{4}-\d{2}-\d{2}$/;
var fechaActual = new Date();

function validarPlaca(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (placa.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarTexto(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (textoEspaciado.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarDireccion(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (direccion.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarTelefono(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (telefono.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarNumeroTres(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (numeroTres.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarCorreo(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (correo.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarUsuario(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (nombreUsuario.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarPass(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (contrasena.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarTerminalRol(campo, sms) {
  if (campo == "Elija") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (terminal.test(campo)) return 1;
  else{
    alertify.warning("El campo: "+sms+" no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  }
}
function validarFecha(campo, sms) {
  if (campo == "") {
    alertify.warning("Campo: "+sms+" vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: "+sms+" solo contiene espacios en blanco.");
    return 0;
  }
  campo.trim();
  if (!fecha.test(campo)) {
    alertify.warning("El campo: " + sms + " no cumple con el formato ¡¡¡verifique!!!");
    return 0;
  } else {//17,05,2021
    var fechaRecibida = new Date(campo.split("-"));
    //17-05-2021:00:00 <= 17-05-2021:19:00
    if(fechaRecibida.getTime() <= fechaActual.getTime()) return 1;
    else{
      alertify.warning("El campo: " + sms + " no puede ser mayor a la fecha actual.");
      return 0;
    }
  }
}
function validarImagen(campo, sms){
  if(campo == ""){
    alertify.warning("Campo: " + sms + " vacío.");
    return 0;
  }
  if (espaciosVacios.test(campo)) {
    alertify.warning("El campo: " + sms + " solo contiene espacios en blanco.");
    return 0;
  }
  return 1;
}
