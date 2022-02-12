
// DATATABLES
init();

function init() {
	getData();
}

function getData() {
	$('#list_users').DataTable({
		pageLength: 10,
		responsive: true,
		processing: true,
		ajax : "includes/consultasAjax2.php?opi=0"
		});
}

function ObtenerUsuarioPorId(id) {

	$("#Emo").css("display","flex");
	$("#Emo").css("position","fixed");

	parametros = {
		"id_usuario": id
	}

	$.ajax({
		data:parametros,
		url: 'includes/consultasAjax2.php?opi=2',
		type: 'POST',
		beforeSend: function() {},
		success: function(response) {
			data = $.parseJSON(response);
			if (data.length > 0) {
				$('#recipient-id-edit').val(data[0]['ID_USUARIO']);
				$('#recipient-name-edit').val(data[0]['NOMBRE']);
				$('#recipient-surname-edit').val(data[0]['APELLIDO']);
				$('#recipient-user-edit').html(data[0]['USUARIO']);
				$('#recipient-pasword-edit').val(data[0]['CLAVE']);
			}
		}
	})
}

function EliminarUsuarioPorID(id) {

	$("#Dmo").css("display","flex");
	$("#Dmo").css("position","fixed");

	parametros = {
		"id_usuario": id
	}

	$.ajax({
		data:parametros,
		url: 'includes/consultasAjax2.php?opi=2',
		type: 'POST',
		beforeSend: function() {},
		success: function(response) {
			data = $.parseJSON(response);
			if (data.length > 0) {
				$('#recipient-id-delete').val(data[0]['ID_USUARIO']);
				$('#recipient-user-delete').html(data[0]['USUARIO']);
			}
		}
	})
}