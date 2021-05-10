
<?php 
require_once "../modelo/conexion.php";
$obj= new conectar();
$conexion=$obj->abrirConexion();

$sql= "SELECT id_empleado, id_terminal, nombre_emp, apellidop_emp, apellidom_emp, direccion_emp, telefono_emp, rol FROM empleados;";
$result=$conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="iddatatable">
		<thead style="background-color: #17a2b8;color: white; font-weight: bold;">
			<tr>
				<td>Terminal</td>
				<td>Nombre Completo</td>
				<td>Direcci&oacute;n</td>
				<td>Tel&eacute;fono</td>
				<td>Rol</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody >
			<?php 
			while ($mostrar=$result->fetch_array(MYSQLI_NUM)) { 
				?>
				<tr >
					<td><?php echo $mostrar[1] ?></td>
					<td><?php echo $mostrar[2] . ' ' .$mostrar[3] . ' ' . $mostrar[4]?></td>
					<td><?php echo $mostrar[5] ?></td>
					<td><?php echo $mostrar[6] ?></td>
					<td><?php echo $mostrar[7] ?></td>
					<td style="text-align: center;">
						<span class="btn btn-sm btn-warning " data-toggle="modal" data-target="#modalEditarEmp" onclick="agregaFrmEditar('<?php echo $mostrar[0] ?>')">
							 <span class="fa fa-pencil"></span>
						</span>
						<span class="btn btn-sm btn-outline-secondary " onclick="eliminarEmpleado('<?php echo $mostrar[0] ?>')">
							 <span class="fa fa-trash"></span>
						</span>
					</td>
				</tr>
			<?php 
			}
			?>
		</tbody>
	</table> 
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#iddatatable').DataTable({
			"language":{
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 3
		});
	} );
</script>