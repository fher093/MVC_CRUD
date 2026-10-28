<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>CRUD Estudiantes</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body { color:#566787; background:#f5f5f5; font-family:'Varela Round',sans-serif; font-size:13px; }
.table-responsive { margin:30px 0; }
.table-wrapper { background:#fff; padding:20px 25px; border-radius:3px; min-width:1000px; box-shadow:0 1px 1px rgba(0,0,0,.05); }
.table-title { background:#435d7d; color:#fff; padding:16px 30px; min-width:100%; margin:-20px -25px 10px; border-radius:3px 3px 0 0; }
.table-title h2 { margin:5px 0 0; font-size:24px; }
.table-title .btn { color:#fff; float:right; font-size:13px; border:none; min-width:50px; border-radius:2px; outline:none !important; margin-left:10px; }
.table-title .btn i { float:left; font-size:21px; margin-right:5px; }
.table-title .btn span { float:left; margin-top:2px; }
table.table tr th, table.table tr td { border-color:#e9e9e9; padding:12px 15px; vertical-align:middle; }
table.table tr th:last-child { width:100px; }
table.table-striped tbody tr:nth-of-type(odd) { background-color:#fcfcfc; }
table.table-striped.table-hover tbody tr:hover { background:#f5f5f5; }
table.table td:last-child i { opacity:.9; font-size:22px; margin:0 5px; }
table.table td a { font-weight:bold; color:#566787; display:inline-block; text-decoration:none; outline:none !important; }
table.table td a.edit { color:#FFC107; }
table.table td a.delete { color:#F44336; }
.hint-text { margin-top:10px; font-size:13px; }
/* Modales */
.modal .modal-dialog { max-width:400px; }
.modal .modal-header, .modal .modal-body, .modal .modal-footer { padding:20px 30px; }
.modal .modal-content { border-radius:3px; font-size:14px; }
.modal .modal-footer { background:#ecf0f1; border-radius:0 0 3px 3px; }
.modal .modal-title { display:inline-block; }
.modal .form-control { border-radius:2px; box-shadow:none; border-color:#ddd; }
.modal .btn { border-radius:2px; min-width:100px; }
.modal form label { font-weight:normal; }
</style>
</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Gestionar <b>Estudiantes</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Nuevo Estudiante</span></a>
					</div>
				</div>
			</div>

			<div id="alerta" class="alert alert-danger d-none"></div>

			<!-- Buscador por cédula -->
			<div class="input-group mb-3">
				<input type="text" id="txtBuscar" class="form-control" placeholder="Buscar por cédula">
				<div class="input-group-append">
					<button type="button" id="btnBuscar" class="btn btn-primary">Buscar</button>
					<button type="button" id="btnTodos" class="btn btn-secondary">Ver todos</button>
				</div>
			</div>

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody id="tbodyEstudiantes"></tbody>
			</table>
			<div class="hint-text">Total: <b id="contador">0</b> estudiantes</div>
		</div>
	</div>
</div>

<!-- Modal AGREGAR -->
<div id="addModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formAdd">
			<div class="modal-header">
				<h4 class="modal-title">Nuevo Estudiante</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group"><label>Cédula</label><input type="text" name="estcedula" class="form-control" required></div>
				<div class="form-group"><label>Nombre</label><input type="text" name="estnombre" class="form-control" required></div>
				<div class="form-group"><label>Apellido</label><input type="text" name="estapellido" class="form-control" required></div>
				<div class="form-group"><label>Dirección</label><input type="text" name="estdireccion" class="form-control" required></div>
				<div class="form-group"><label>Teléfono</label><input type="text" name="esttelefono" class="form-control" required></div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
				<input type="submit" class="btn btn-success" value="Agregar">
			</div>
		</form>
	</div></div>
</div>

<!-- Modal EDITAR -->
<div id="editModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formEdit">
			<div class="modal-header">
				<h4 class="modal-title">Editar Estudiante</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group"><label>Cédula</label><input type="text" name="estcedula" class="form-control" readonly></div>
				<div class="form-group"><label>Nombre</label><input type="text" name="estnombre" class="form-control" required></div>
				<div class="form-group"><label>Apellido</label><input type="text" name="estapellido" class="form-control" required></div>
				<div class="form-group"><label>Dirección</label><input type="text" name="estdireccion" class="form-control" required></div>
				<div class="form-group"><label>Teléfono</label><input type="text" name="esttelefono" class="form-control" required></div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
				<input type="submit" class="btn btn-info" value="Guardar">
			</div>
		</form>
	</div></div>
</div>

<!-- Modal ELIMINAR -->
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog"><div class="modal-content">
		<form id="formDelete">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar Estudiante</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>¿Estás seguro de borrar al estudiante con cédula <b id="cedulaBorrar"></b>?</p>
				<p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
				<input type="submit" class="btn btn-danger" value="Eliminar">
			</div>
		</form>
	</div></div>
</div>

<script>
var CAMPOS = ['estcedula', 'estnombre', 'estapellido', 'estdireccion', 'esttelefono'];
var cedulaAEliminar = '';

function textoRespuesta(res) {
	return (typeof res === 'string') ? res : (res && res.success) || '';
}
function esExito(res) {
	return /(agregado|EDITADO|ELIMINADO) correctamente/.test(textoRespuesta(res));
}
function mostrarError(msg) {
	$('#alerta').text(msg).removeClass('d-none');
	setTimeout(function () { $('#alerta').addClass('d-none'); }, 4000);
}

// ---- LISTAR (models/select.php) o BUSCAR (models/buscar.php) ----
function cargarEstudiantes(cedula) {
	$('.tooltip').remove();
	var url = cedula ? 'models/buscar.php' : 'models/select.php';
	var params = cedula ? { estcedula: cedula } : {};
	$.getJSON(url, params, function (data) {
		var $tb = $('#tbodyEstudiantes').empty();

		if (!Array.isArray(data) || data.length === 0) {
			$tb.append('<tr><td colspan="6" class="text-center text-muted">No hay estudiantes</td></tr>');
			$('#contador').text(0);
			return;
		}

		data.forEach(function (e) {
			var $tr = $('<tr>').data('est', e);          // guardamos la fila completa
			CAMPOS.forEach(function (c) { $tr.append($('<td>').text(e[c])); });
			$tr.append(
				'<td>' +
				'<a href="#" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>' +
				'<a href="#" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>' +
				'</td>'
			);
			$tb.append($tr);
		});

		$('#contador').text(data.length);
		$('[data-toggle="tooltip"]').tooltip();
	}).fail(function () { mostrarError('No se pudo cargar la lista de estudiantes.'); });
}

// ---- AGREGAR (models/insert.php) ----
$('#addModal').on('show.bs.modal', function () { $('#formAdd')[0].reset(); });

$('#formAdd').on('submit', function (ev) {
	ev.preventDefault();
	$.ajax({ url: 'models/insert.php', method: 'POST', data: $(this).serialize(), dataType: 'json' })
	.done(function (res) {
		if (esExito(res)) { $('#addModal').modal('hide'); cargarEstudiantes(); }
		else { mostrarError(textoRespuesta(res) || 'No se pudo agregar.'); }
	})
	.fail(function () { mostrarError('El servidor devolvió un error (¿la cédula ya existe?).'); });
});

// ---- EDITAR (models/update.php?estcedula=...) ----
$('#tbodyEstudiantes').on('click', 'a.edit', function (ev) {
	ev.preventDefault();
	var e = $(this).closest('tr').data('est');
	CAMPOS.forEach(function (c) { $('#formEdit [name="' + c + '"]').val(e[c]); });
	$('#editModal').modal('show');
});

$('#formEdit').on('submit', function (ev) {
	ev.preventDefault();
	var cedula = $('#formEdit [name="estcedula"]').val();
	$.ajax({
		url: 'models/update.php?estcedula=' + encodeURIComponent(cedula),
		method: 'POST', data: $(this).serialize(), dataType: 'json'
	})
	.done(function (res) {
		if (esExito(res)) { $('#editModal').modal('hide'); cargarEstudiantes(); }
		else { mostrarError(textoRespuesta(res) || 'No se pudo editar.'); }
	})
	.fail(function () { mostrarError('Error de comunicación con el servidor.'); });
});

// ---- ELIMINAR (models/delete.php) ----
$('#tbodyEstudiantes').on('click', 'a.delete', function (ev) {
	ev.preventDefault();
	cedulaAEliminar = $(this).closest('tr').data('est').estcedula;
	$('#cedulaBorrar').text(cedulaAEliminar);
	$('#deleteModal').modal('show');
});

$('#formDelete').on('submit', function (ev) {
	ev.preventDefault();
	$.post('models/delete.php', { txtcedula: cedulaAEliminar }, function (res) {
		$('#deleteModal').modal('hide');
		if (esExito(res)) { cargarEstudiantes(); }
		else { mostrarError(textoRespuesta(res) || 'No se pudo eliminar.'); }
	}, 'json').fail(function () { mostrarError('Error de comunicación con el servidor.'); });
});

// ---- BUSCAR POR CÉDULA (models/buscar.php) ----
function buscarPorCedula() {
	var cedula = $('#txtBuscar').val().trim();
	if (cedula === '') { mostrarError('Ingrese una cédula para buscar.'); return; }
	cargarEstudiantes(cedula);
}

$('#btnBuscar').on('click', buscarPorCedula);
$('#txtBuscar').on('keypress', function (ev) { if (ev.which === 13) buscarPorCedula(); });
$('#btnTodos').on('click', function () { $('#txtBuscar').val(''); cargarEstudiantes(); });

cargarEstudiantes();
</script>
</body>
</html>