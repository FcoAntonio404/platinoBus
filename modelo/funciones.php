<?php
function getTerminales(){
  $obj = new conectar();
  $array = array();
  $conexion = $obj->abrirConexion();
  $sentenciaSQL = "SELECT id_terminal, nombre_ter FROM terminales ORDER BY nombre_ter ASC";
  $resultado = $conexion->query($sentenciaSQL);
  while ($aux = $resultado->fetch_object()){
    $array[] = $aux;
  }
  return $array;
}
function getTerminalesCiudad(){
  $obj = new conectar();
  $array = array();
  $conexion = $obj->abrirConexion();
  $sentenciaSQL = "SELECT id_terminal, ciudad_ter FROM terminales ORDER BY ciudad_ter ASC";
  $resultado = $conexion->query($sentenciaSQL);
  while ($aux = $resultado->fetch_object()){
    $array[] = $aux;
  }
  return $array;
}
function getEmpleados($terminal){
  $obj = new conectar();
  $array = array();
  $conexion = $obj->abrirConexion();
  $sentenciaSQL = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados WHERE id_terminal = '$terminal' ORDER BY nombre_emp ASC";
  $resultado = $conexion->query($sentenciaSQL);
  while ($aux = $resultado->fetch_object()){
    $array[] = $aux;
  }
  return $array;
}
function getEmpleadosOperadores(){
  $obj = new conectar();
  $array = array();
  $conexion = $obj->abrirConexion();
  $sentenciaSQL = "SELECT id_empleado, nombre_emp, apellidop_emp, apellidom_emp FROM empleados WHERE empleados.id_empleado NOT IN (SELECT id_empleado FROM autobuses) AND rol = 4 ORDER BY nombre_emp ASC";
  $resultado = $conexion->query($sentenciaSQL);
  while ($aux = $resultado->fetch_object()){
    $array[] = $aux;
  }
  return $array;
}
function getTerminalesInfo(){
  $obj = new conectar();
  $array = array();
  $conexion = $obj->abrirConexion();
  $sentenciaSQL = "SELECT nombre_ter, direccion_ter, ciudad_ter, estado_ter, telefono_ter, imagen FROM terminales";
  $resultado = $conexion->query($sentenciaSQL);
  while ($aux = $resultado->fetch_object()){
    $array[] = $aux;
  }
  return $array;
}
