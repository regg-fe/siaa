
// DATATABLES 
init();

function init() {
	getData();
}

function getData() {
	$('#list_product').DataTable({
		pageLength: 10,
		responsive: true,
		processing: true,
		ajax : "includes/consultasAjax.php?op=0"
		});
}

// BOTONES MODIFICADORES DE ITEMS EN LA TABLA

// CONSULTA PARA EDITAR, MODIFICAR ESTATUS Y ELIMINAR
function ObtenerProductoPorId(id) {

	$("#Emo").css("display","flex");
	$("#Emo").css("position","fixed");

	parametros = {
		"id_actividad": id
	}

	$.ajax({
		data:parametros,
		url: 'includes/consultasAjax.php?op=2',
		type: 'POST',
		beforeSend: function() {},
		success: function(response) {
			data = $.parseJSON(response);
			console.log(data);
			if (data.length > 0) {
				$('#recipient-id-edit').val(data[0]['ID_ACTIVIDAD']);
				$('#recipient-user-edit').val(data[0]['NEW_USUARIO']);
				$('#recipient-name-edit').val(data[0]['ACTIVIDAD']);
				$('#message-text-edit').val(data[0]['DESCRIPCION']);
				$('#recipient-date-i-edit').val(data[0]['INI']);
				$('#recipient-date-f-edit').val(data[0]['FIN']);
			}
		}
	})
}

// MODIFICADOR DE ESTATUS
function ActualizarEstatusPorID(id) {

	$("#Dmo").css("display","flex");
	$("#Dmo").css("position","fixed");

	parametros = {
		"id_actividad": id
	}

	$.ajax({
		data:parametros,
		url: 'includes/consultasAjax.php?op=2',
		type: 'POST',
		beforeSend: function() {},
		success: function(response) {
			data = $.parseJSON(response);
			if (data.length > 0) {
				$('#recipient-id-delete').val(data[0]['ID_ACTIVIDAD']);
				$('#recipient-estatus-delete').val(data[0]['ESTATUS']);
			}
		}
	})
}

// ELIMINAR DE LA BD
function EliminarPorID(id) {
	$("#Demo").css("display","flex");
	$("#Demo").css("position","fixed");

	parametros = {
		"id_actividad": id
	}

	$.ajax({
		data:parametros,
		url: 'includes/consultasAjax.php?op=2',
		type: 'POST',
		beforeSend: function() {},
		success: function(response) {
			data = $.parseJSON(response);
			console.log(data);
			if (data.length > 0) {
				$('#recipient-id-deleteF').val(data[0]['ID_ACTIVIDAD']);
			}
		}
	})
}