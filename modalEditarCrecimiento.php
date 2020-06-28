<!-- Modal -->
<div class="modal fade" id="actualizarCrecimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar crecimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarCrecimiento" class="m-3" method="post" action="">
            <div id="msgErrorCrecimientoModal" class="alert alert-warning mt-3 py-3 m-3" role="alert" style="display: none"></div>
			<input id="idCrecimientoEditado" name="idCrecimiento" class="d-none" value="">
					<div class="row mt-5 b-3">
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label for="fechaDatos">Fecha de los datos</label>
								<input type="date" class="form-control" id="fechaDatosEditado" name="fechaDatos" required>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label for="altura">Altura</label>
								<input type="text" class="form-control" id="alturaEditado" name="altura" required>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label for="peso">Peso</label>
								<input type="text" class="form-control" id="pesoEditado" name="peso" required>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">
							<div class="form-group">
								<label for="cabeza">Cabeza (contorno)</label>
								<input text="date" class="form-control" id="cabezaEditado" name="cabeza" required>
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
