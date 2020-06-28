<!-- Modal -->
<div class="modal fade" id="actualizarAnecdota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar crecimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarAnecdota" class="m-3" method="post" action="">
            <div id="msgErrorAnecdotaModal" class="alert alert-warning mt-3 py-3 m-3" role="alert" style="display: none"></div>
			<input id="idAnecdotaEditado" name="idAnecdota" class="d-none" value="">
            <div class="row pt-3 my-2">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="fechaAnecdota">Fecha de los datos</label>
								<input type="date" class="form-control" id="fechaAnecdotaEditado" name="fechaAnecdota">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="nombreAnecdota">Nombre de la anécdota</label>
								<input type="text" class="form-control" id="nombreAnecdotaEditado" name="nombreAnecdota" placeholder="Ej. Primera palabra, primer gateo, primeros pasos, primer amigo...">
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="lugarAnecdota">Lugar de la anécdota</label>
								<input type="text" class="form-control" id="lugarAnecdotaEditado" name="lugarAnecdota" placeholder="Ej. nuestra casa (primera palabra), Paseo Marítimo de A Coruña (primeros pasos),...">
							</div>
						</div>
					</div>
					<div class="row my-2">
						<div class="col-12">
							<div class="form-group">
								<label for="descripcionAnecdota">Descripción de la anécdota</label>
								<textarea rows="3" class="form-control" id="descripcionAnecdotaEditado" name="descripcionAnecdota" aria-describedby="helpDescripcion" required>
								</textarea>
								<small id="helpDescripcion" class="form-text text-muted">Escribe en pocas palabras algún detalle más de la anécdota.</small>
							</div>
						</div>
					</div>
					<div class="row align-items-center my-2">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="imgAnecdota">¿Substituimos la imagen anterior?</label>
								<input type="file" class="form-control-file my-3" id="imgAnecdotaEditado" name="imgAnecdota">
							</div>
						</div>
						<div class="col-12 col-md-6">
							<label for="linkAnecdota">¿Cambiamos el link?</label>
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">url:</span>
								</div>
								<input type="text" class="form-control" id="linkAnecdotaEditado" name="linkAnecdota" aria-describedby="basic-addon3">
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
