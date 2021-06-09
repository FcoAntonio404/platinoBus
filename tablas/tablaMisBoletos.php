<?php
session_start();
require_once "../modelo/conexion.php";
$obj = new conectar();
$conexion = $obj->abrirConexion();
$id_cliente = $_SESSION["usuarioID"];
$sql = "SELECT id_boleto, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_origen AND rutas.id_ruta = boletos.id_ruta)AS origen, (SELECT nombre_ter FROM terminales, rutas WHERE id_terminal = id_terminal_destino AND rutas.id_ruta = boletos.id_ruta)AS destino, fecha_salida, num_asiento, fecha_expedicion, boletos.precio, boletos.estado FROM boletos WHERE id_cliente = '$id_cliente'";
$result = $conexion->query($sql);
?>

<div>
	<table class="table table-bordered table-striped " cellspacing="0" width="100%" id="idtablaBoletosCliente">
		<thead style="background-color: #338FB6;color: white; font-weight: bold;">
			<tr>
				<td>Folio</td>
				<td>Ruta</td>
				<td>Fecha salida:</td>
				<td>Asiento</td>
				<td>Precio</td>
				<td>Estado</td>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($mostrar = $result->fetch_array(MYSQLI_NUM)) {
			?>
				<tr>
					<td><?php echo $mostrar[0] ?></td>
					<td><?php echo $mostrar[1] . ' ' . $mostrar[2] ?></td>
					<td><?php echo $mostrar[3] ?></td>
					<td><?php echo $mostrar[4] ?></td>
					<td><?php echo $mostrar[6] ?></td>
					<td><?php echo ($mostrar[7] == 'e') ? "Espera" : (($mostrar[3] == 'c') ? "Cerrado" : "Suspendido") ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#idtablaBoletosCliente').DataTable({
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			"pageLength": 3
		});
	});
</script>