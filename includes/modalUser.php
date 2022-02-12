<!-- MODAL ADD USUARIO -->
	<div id="mo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
		      </div>
		      <div class="modal-body">
		      	<label class="col-form-label">Te permitira recordarla cada vez que ingreses a SIAA...</label>
		        <form>
		        <p id="mess1" class="mess">Error</p>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Nombre:</label>
		            <input type="text" class="form-control" id="recipient-name">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Apellido:</label>
		            <input type="text" class="form-control" id="recipient-surname">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Usuario:</label>
		            <input type="text" class="form-control" id="recipient-user">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Contraseña:</label>
		            <input type="password" class="form-control" id="recipient-pasword">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Confirmar Contraseña:</label>
		            <input type="password" class="form-control" id="recipient-pasword-verify">
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
<!-- MODAL ADD USUARIO -->

<!-- MODAL EDIT USUARIO -->
		<div id="Emo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario<h5 id=recipient-user-edit></h5></h5>
		      </div>
		      <div class="modal-body">
		      	<label class="col-form-label">Te permitira recordarla cada vez que ingreses a SIAA...</label>
		        <form>
		        <p id="mess2" class="mess">Error</p>
		          <input type="hidden" id="recipient-id-edit">
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Nombre:</label>
		            <input type="text" class="form-control" id="recipient-name-edit">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Apellido:</label>
		            <input type="text" class="form-control" id="recipient-surname-edit">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Contraseña:</label>
		            <input type="password" class="form-control" id="recipient-pasword-edit">
		          </div>
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Confirmar Contraseña:</label>
		            <input type="password" class="form-control" id="recipient-pasword-verify-edit">
		          </div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" id="cnlE">Cerrar</button>
		        <button type="button" class="btn btn-warning" id="sbmE">Editar</button>
		      </div>
		    </div>
		  </div>
	</div>
<!-- MODAL EDIT USUARIO -->

<!-- MODAL DELETE USUARIO -->
	<div id="Dmo" class="mo">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">¿Eliminar Usuario?<h5 id=recipient-user-delete></h5></h5>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<input type="hidden" id="recipient-id-delete">
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
<!-- MODAL DELETE EDIT USUARIO -->

<script type="text/javascript">
	$(document).ready(function () {

		// JS MODAL ADD !
		
		$("#sbm").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO PARA AGREGAR
			$.post("includes/consultasAjax2.php?opi=1", { 
				nombre: $("#recipient-name").val(), 
				apellido: $("#recipient-surname").val(), 
				usuario: $("#recipient-user").val(),
				contrasena: $("#recipient-pasword").val(),
				contrasena2: $("#recipient-pasword-verify").val()
			}, function (data) {
				// RECEPCION DE RESPUESTA
				if (data == 1) {
					location.reload();
				} else if (data == 2) {
					// MODIFICADOR DE ERROR USUARIO REGISTRADO
					$("#mess1").css("display","flex");
					$("#mess1").html("!Ups! Usuario ya Registrado");
				} else if (data == 3) {
					// MODIFICADOR DE ERROR CONTRASEÑAS NO COINCIDEN
					$("#mess1").css("display","flex");
					$("#mess1").html("!Ups! Contraseñas no coinciden, verifique nuevamente");
				} else if (data == 4) {
					// MODIFICADOR DE ERROR CAMPOS VACIOS
					$("#mess1").css("display","flex");
					$("#mess1").html("!Ups! Verifique los campos e intente nuevamente");
				}
			});
		});

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
			// RECOLECCION DE DATOS Y ENVIO PARA EDITAR
			$.post("includes/consultasAjax2.php?opi=3", { 
				id: $("#recipient-id-edit").val(), 
				nombre: $("#recipient-name-edit").val(), 
				apellido: $("#recipient-surname-edit").val(), 
				contrasena: $("#recipient-pasword-edit").val(),
				contrasena2: $("#recipient-pasword-verify-edit").val()
			}, function (data) {
				console.log(data);
				// RECEPCION DE RESPUESTA
				if (data == 1) {
					location.reload();
				} else if (data == 3) {
					// MODIFICADOR DE ERROR CAMPOS VACIOS
					$("#mess2").css("display","flex");
					$("#mess2").html("!Ups! Verifique los campos e intente nuevamente");
				} else if (data == 2) {
					// MODIFICADOR DE ERROR CONTRASEÑAS NO COINCIDEN
					$("#mess2").css("display","flex");
					$("#mess2").html("!Ups! Contraseñas no coinciden, verifique nuevamente");
				}
			});
		});

		// CANCELAR ACCION
		$("#cnlE").click(function (ev) {
			ev.preventDefault();
			$("#Emo").css("display","none");
		});

		// ELIMINAR DE LA BD !

		$("#sbmD").click(function (ev) {
			ev.preventDefault();
			// RECOLECCION DE DATOS Y ENVIO
			$.post("includes/consultasAjax2.php?opi=4", { 
				id: $("#recipient-id-delete").val(),
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
	});
</script>