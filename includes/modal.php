<!-- MODAL ADD ACTIVIDAD -->
	<div id="mo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Agregar Actividad</h5>
		      </div>
		      <div class="modal-body">
		      	<label class="col-form-label">Te permitira recordarla cada vez que ingreses a SIAA...</label>
		        <form>
		        <p id="mess1" class="mess">Error</p>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Nombre de Actividad:</label>
		            <input type="text" class="form-control" id="recipient-name">
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="col-form-label">Descripcion:</label>
		            <textarea class="form-control" id="message-text"></textarea>
		          </div>
		          <div class="form-group">
		            <label for="recipient-date-i" class="col-form-label">Fecha de Inicio:</label>
		            <input type="date" class="form-control" id="recipient-date-i">
		          </div>
		          <div class="form-group">
		            <label for="recipient-date-f" class="col-form-label">Fecha de Fin:</label>
		            <input type="date" class="form-control" id="recipient-date-f">
		          </div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="cnl">Cerrar</button>
		        <button type="button" class="btn btn-success" id="sbm">Agregar</button>
		      </div>
		    </div>
		  </div>
	</div>
<!-- MODAL ADD ACTIVIDAD -->

<!-- MODAL EDIT ACTIVIDAD -->
	<div id="Emo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Editar Actividad</h5><br>
		      </div>
		      <div class="modal-body">
		      	<label class="col-form-label">Todo lo relacionado con este elemento sera modificado y no podra ser recuperado...</label>
		      	<p id="mess2" class="mess">Error</p>
		        <form>
		        	<input type="hidden" id="recipient-id-edit">
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Nombre de Actividad:</label>
		            <input type="text" class="form-control" id="recipient-name-edit">
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="col-form-label">Descripcion:</label>
		            <textarea class="form-control" id="message-text-edit"></textarea>
		          </div>
		          <div class="form-group">
		            <label for="recipient-date-i" class="col-form-label">Fecha de Inicio:</label>
		            <input type="date" class="form-control" id="recipient-date-i-edit">
		          </div>
		          <div class="form-group">
		            <label for="recipient-date-f" class="col-form-label">Fecha de Fin:</label>
		            <input type="date" class="form-control" id="recipient-date-f-edit">
		          </div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="cnlE">Cerrar</button>
		        <button type="button" class="btn btn-warning" id="sbmE">Guardar</button>
		      </div>
		    </div>
		  </div>
	</div>
<!-- MODAL EDIT ACTIVIDAD -->

<!-- MODAL ESTATUS EDIT ACTIVIDAD -->
	<div id="Dmo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">¿Eliminar Actividad?</h5>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<input type="hidden" id="recipient-id-delete">
		        	<input type="hidden" id="recipient-estatus-delete">
		        	<label class="col-form-label">Todo lo relacionado con este elemento sera eliminado y no podra ser recuperado...</label>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="cnlD">Cancelar</button>
		        <button type="button" class="btn btn-warning" id="sbmD">Eliminar</button>
		      </div>
		    </div>
		  </div>
	</div>
<!-- MODAL ESTATUS EDIT ACTIVIDAD -->

<!-- MODAL DELETE ACTIVIDAD -->
	<div id="Demo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">¿Eliminar Actividad de la Base de Datos?</h5>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<input type="hidden" id="recipient-id-deleteF">
		        	<label class="col-form-label">Esta opcion eliminara por completo la informacion de la Base de Datos, verifique si en realidad desea hacerlo...</label>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="cnlDe">Cancelar</button>
		        <button type="button" class="btn btn-warning" id="sbmDe">Eliminar</button>
		      </div>
		    </div>
		  </div>
	</div>
<!-- MODAL DELETE ACTIVIDAD -->

<script type="text/javascript">
	$(document).ready(function () {

		// JS MODAL ADD !
		
		$("#sbm").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO PARA AGREGAR
			$.post("includes/consultasAjax.php?op=1", { 
				nombre: $("#recipient-name").val(), 
				descripcion: $("#message-text").val(), 
				inicio: $("#recipient-date-i").val(),
				fin: $("#recipient-date-f").val()
			}, function (data) {
				// RECEPCION DE RESPUESTA
				if (data == 1) {
					location.reload();
				} else {
					// MODIFICADOR DE ERROR
					$("#mess1").css("display","flex");
					$("#mess1").html("!Ups! Verifique los campos e intente nuevamente");
				}
			});
		});

		// HABILITAR MODAL ADD
		$("#add").click(function (ev) {
			ev.preventDefault();
			$("#mo").css("display","flex");
			$("#mo").css("position","fixed");
		});

		// CANCELAR ACCION
		$("#cnl").click(function (ev) {
			ev.preventDefault();
			$("#mo").css("display","none");
		});

		// JS MODAL EDIT !
		
		$("#sbmE").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO PARA MODIFICAR
			$.post("includes/consultasAjax.php?op=3", { 
				id: $("#recipient-id-edit").val(),
				nombre: $("#recipient-name-edit").val(),
				descripcion: $("#message-text-edit").val(),
				inicio: $("#recipient-date-i-edit").val(),
				fin: $("#recipient-date-f-edit").val()
			}, function (data) {
				if (data == 1) {
					location.reload();
				} else {
					// MODIFICACION DE ERROR
					$("#mess2").css("display","flex");
					$("#mess2").html("!Ups! Verifique los campos e intente nuevamente");
				}
			});
		});

		// CANCELAR ACCION
		$("#cnlE").click(function (ev) {
			ev.preventDefault();
			$("#Emo").css("display","none");
		});

		// JS MODAL EDIT ESTATUS !

		$("#sbmD").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO PARA ACTUALIZAR ESTATUS
			$.post("includes/consultasAjax.php?op=4", { 
				id: $("#recipient-id-delete").val(),
				estatus: $("#recipient-estatus-delete").val()
			}, function (data) {
				if (data == 1) {
					location.reload();
				} else {
					console.log(data);
				}
			});
		});

		// CANCELAR ACCION
		$("#cnlD").click(function (ev) {
			ev.preventDefault();
			$("#Dmo").css("display","none");
		});

		// ELIMINAR DE LA BD !

		$("#sbmDe").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO
			$.post("includes/consultasAjax.php?op=5", { 
				id: $("#recipient-id-deleteF").val(),
			}, function (data) {
				if (data == 1) {
					location.reload();
				} else {
					console.log(data);
				}
			});
		});

		// CANCELAR ACCION
		$("#cnlDe").click(function (ev) {
			ev.preventDefault();
			$("#Demo").css("display","none");
		});
	});
</script>