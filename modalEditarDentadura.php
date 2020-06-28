<!-- Modal -->
<div class="modal fade" id="actualizarDentadura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar crecimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarDentadura" class="m-3" method="post" action="">
            <div id="msgErrorDentaduraModal" class="alert alert-warning mt-3 py-3 my-3" role="alert" style="display: none"></div>
			<input id="idDentaduraEditado" name="idDentadura" class="d-none" value="">
            <div class="row mt-5">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="fechaDiente">Fecha de los datos</label>
								<input type="date" class="form-control" id="fechaDienteEditado" name="fechaDiente" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="ordenDiente">Orden</label>
								<select name="ordenDiente" class="form-control" id="ordenDienteEditado" required>
											<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
											<?php if(isset($selectOrdenDiente)) echo $selectOrdenDiente ?>
										</select>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="nombreDiente">Nombre del diente</label>
								<select name="nombreDiente" class="form-control" id="nombreDienteEditado" required>
											<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
											<?php if(isset($selectNombreDiente)) echo $selectNombreDiente ?>
										</select>
							</div>
						</div>
					</div>
					<button type="submit" class="btn b_amarillo text-white my-3">Editar</button>
				</form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
