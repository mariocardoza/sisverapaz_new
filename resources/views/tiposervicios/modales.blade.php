<div class="modal fade" id="modal_registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar nuevo</h4>
			</div>
			<div class="modal-body">
				<form id="form_tiposervicio">
					<div class="form-group">
						<label for="">
							Nombre servicio
						</label>
						<input type="text" name="nombre" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Costo
						</label>
						<input type="number" min="0" name="costo" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Tipo de cobro
						</label>
						<select name="isObligatorio" id="isObligatorio" class="chosen-select-width">
							<option value="0">Variable</option>
							<option value="1">Fijo</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancelar</button>
					<button id="btnguardar" type="button" class="btn btn-success"> Guardar</button>
				</center>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar</h4>
			</div>
			<div class="modal-body">
				<form id="form_edit">
					<div class="form_group">
						<label for="">Nombre</label>
						<input type="text" name="nombre" id="e_nombre" class="form-control">
						<input type="hidden" name="id" id="elid">
					</div>
					<div class="form-group">
						<label for="">
							Costo
						</label>
						<input type="number" min="0" name="costo" id="e_costo" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Tipo de cobro
						</label>
						<select name="isObligatorio" id="e_isObligatorio" class="chosen-select-width">
							<option value="0">Variable</option>
							<option value="1">Fijo</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button id="btneditar" type="button" class="btn btn-success">Editar</button>
				</center>
			</div>
		</div>
	</div>
</div>