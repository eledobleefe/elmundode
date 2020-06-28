<!-- Modal -->
<div class="modal fade" id="actualizarVisitantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar crecimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVisitasAnecdota" class="m-3" method="post" action="">
                    <div id="msgErrorVisitasModal" class="alert alert-warning mt-3 py-3 my-3" role="alert" style="display: none"></div>
			        <input id="idVisitasEditado" name="idVisitas" class="d-none" value="">
                    <div class="row pt-3 my-2">
                        <div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="nombreUsuario">Nombre</label>
								<input type="text" class="form-control" id="nombreUsuarioEditado" name="nombreUsuario" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="apellidosUsuario">Apellidos</label>
								<input type="text" class="form-control" id="apellidosUsuarioEditado" name="apellidosUsuario" required>
							</div>
						</div>
					</div>
					<div class="row justify-content-between pt-3 my-2">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="emailEditado" name="email" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								<label for="pass">Contraseña</label>
								<input type="password" class="form-control" id="passEditado" name="pass" required>
							</div>
						</div>
					</div>
					<button type="submit" name="btnEditarVisitas" class="btn b_amarillo text-white mb-4">Editar</button>
			    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
