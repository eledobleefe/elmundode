<!-- Modal -->
<div class="modal fade" id="actualizarProgenitor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar progenitor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formEditarProgenitor" method="post" action="">
				<div id="msgErrorProgenitorModal" class="alert alert-warning mt-3 py-3 m-3" role="alert" style="display: none"></div>
				<input id="idProgenitorEditado" class="d-none" value="">
				<div class="row py-3 mx-2 mb-4">
					<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="nombreProgenitor">Nombre</label>
								<input type="text" class="form-control" id="nombreProgenitorEditado" name="nombreProgenitor" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="apellidosProgenitor">Apellidos</label>
								<input type="text" class="form-control" id="apellidosProgenitorEditado" name="apellidosProgenitor" required>
							</div>
						</div>
					</div>
				<hr class="b_amarillo">
				<div class="row mt-5 pb-3 mx-2 px-md-1 justify-content-between">
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="fechaNProgenitor">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fechaNProgenitorEditado" name="fechaNProgenitor" required>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="lugarNProgenitor">Lugar de nacimiento</label>
							<input type="text" class="form-control" id="lugarNProgenitorEditado" name="lugarNProgenitor" required>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="form-group">
							<label for="tipoProgenitor">Tipo de progenitor</label>
							<select class="custom-select" id="tipoProgenitorEditado" name="tipoProgenitor" required>
								<!--Mostramos las diferentes opciones que hay en la tabla de la BBDD-->
								<?php if(isset($selectTipoProgenitor)) echo $selectTipoProgenitor; ?>
							</select>
						</div>
					</div>
					</div>
					<hr class="b_amarillo">
					<div class="form-group my-5 mx-4">
						<label for="descripcionProgenitor">Descripción progenitor</label>
						<textarea rows="3" class="form-control" id="descripcionProgenitorEditado" name="descripcionProgenitor" aria-describedby="helpDescripcion" required></textarea>
						<small id="helpDescripcion" class="form-text text-muted">Escribe una pequeña frase que te definiera cuando os enterásteis de que seríais más en la familia.</small>
					</div>
					<div class="custom-file my-5 mx-md-1 w-75 d-block">
						<input type="file" class="custom-file-input" id="imgProgenitorEditado" name="imgProgenitor" lang="es">
						<label class="custom-file-label ml-4" for="imgProgenitor">Seleccionar Archivo</label>
					</div>
				<button type="submit" name="btnEditarProgenitor" class="btn b_amarillo text-white ml-4 mb-4">Editar</button>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
