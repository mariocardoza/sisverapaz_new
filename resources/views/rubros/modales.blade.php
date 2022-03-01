<div class="modal fade" id="modal_registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Nuevo</h4>
			</div>
			<div class="modal-body">
				<form id="form_rubro">
					<div class="form-group">
						<label for="">
							Categoría rubro
						</label>
						<select name="categoriarubro" id="categoriarubro_id" class="chosen-select-width">
							<option value="">Seleccione</option>
							@foreach ($categorias as $categoria)
								<option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">
							Nombre
						</label>
						<input type="text" name="nombre" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Porcentaje
						</label>
						<input type="number" min="0" name="porcentaje" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Es formula
						</label>
						<select name="formula" id="es_formula" class="chosen-select-width">
							<option value="0">No</option>
							<option value="1">Si</option>
						</select>
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button id="btnguardar" type="button" class="btn btn-success">Guardar</button>
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
					<input type="hidden" id="elid">
					<div class="form-group">
						<label for="">
							Categoría rubro
						</label>
						<select name="categoriarubro" id="e_categoriarubro_id" class="chosen-select-width">
							<option value="">Seleccione</option>
							@foreach ($categorias as $categoria)
								<option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">
							Nombre
						</label>
						<input type="text" name="nombre" id="e_nombre" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Porcentaje
						</label>
						<input type="number" min="0" id="e_porcentaje" name="porcentaje" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="">
							Es formula
						</label>
						<select name="formula" id="e_es_formula" class="chosen-select-width">
							<option value="0">No</option>
							<option value="1">Si</option>
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