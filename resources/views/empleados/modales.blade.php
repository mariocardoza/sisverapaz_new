@php
    $unid=App\Unidad::where('estado',1)->get();
    $unidades=[];
    foreach ($unid as $u ) {
        $unidades[$u->id]=$u->nombre_unidad;
    }
    $elrol=App\Role::all();
    $roles=[];
    foreach ($elrol as $r ) {
      $roles[$r->id]=$r->description;
    }
@endphp
<div class="modal fade" tabindex="-1" id="modal_bancarios" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Datos Bancarios</h4>
      </div>
      <div class="modal-body">
      	<form id="bancarios" action="" class="form-horizontal">
      		<div class="row">
	          	<div class="col-md-12">
		          	<div class="form-group">
		                <label class="control-label col-md-4">Seleccione el Banco</label>
		                <div class="col-md-6">
		                	<input type="hidden" name="codigo" value="{{$empleado->id}}">
		                    {{Form::select('banco',$bancos,null,['class'=>'chosen-select-width','placeholder'=>'Seleccione un banco','required'])}}
		                </div>       
		            </div>

		            <div class="form-group">
		                <label class="control-label col-md-4">Número de Cuenta</label>
		                <div class="col-md-6">
		                    {{ Form::number('num_cuenta', null,['id'=>'cuenta_empleado','class' => 'form-control','autocomplete'=>'off','required']) }}
		                </div>       
		            </div>
	          	</div>
	        </div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registrar_bancarios" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_afps" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Datos de la AFP</h4>
      </div>
      <div class="modal-body">
      	<form id="n_afp" action="" class="form-horizontal">
      		<div class="row">
	          	<div class="col-md-12">
		          	<div class="form-group">
		                <label class="control-label col-md-4">Seleccione la AFP</label>
		                <div class="col-md-6">
		                	<input type="hidden" name="codigo" value="{{$empleado->id}}">
		                    {{Form::select('afp',$afps,null,['class'=>'chosen-select-width','placeholder'=>'Seleccione una AFP','required'])}}
		                </div>       
		            </div>

		            <div class="form-group">
		                <label class="control-label col-md-4">Número de AFP</label>
		                <div class="col-md-6">
		                    {{ Form::number('num_afp', null,['id'=>'afp_empleado','class' => 'form-control','autocomplete'=>'off','required']) }}
		                </div>       
		            </div>
	          	</div>
	        </div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registrar_afps" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_isss" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title title_isss" id="gridSystemModalLabel">Registrar Número de Seguro Social racumina</h4>
      </div>
      <div class="modal-body">
      	<form id="n_isss" action="" class="form-horizontal">
      		<div class="row">
	          	<div class="col-md-12">
		            <div class="form-group">
		                <label class="control-label col-md-4">Número de Seguro Social</label>
		                <div class="col-md-6">
		                	<input type="hidden" name="codigo" value="{{$empleado->id}}">
		                    {{ Form::number('num_seguro_social', $empleado->num_seguro_social,['id'=>'isss_empleado','class' => 'form-control','autocomplete'=>'off','required']) }}
		                </div>       
		            </div>
	          	</div>
	        </div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registrar_isss" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_edit" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="gridSystemModalLabel">Editar Datos de Empleado</h4>
      </div>
      <div class="modal-body">
      	{{ Form::model($empleado, array('class' => '','id'=>'e_empleados')) }}    	
					@include('empleados.formulario') 
      	</form>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn_editar" class="btn btn-success">Guardar</button></center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_user" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Datos de Usuario</h4>
      </div>
      <div class="modal-body">
      	<form id="n_usuario">
      		<div class="row">
	          	<div class="col-md-12">
		          	
					

                         <div class="form-group">
                            <label for="username" class="control-label">Nombre de Usuario</label>

                            <div class="">
                                <input id="username" type="text" autocomplete="off" class="form-control" name="username">
                                <input id="empleado_id" type="hidden" autocomplete="off" class="form-control" name="elempleado" value="{{$empleado->id}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">E-Mail</label>

                            <div class="">
                                <input id="email" value="{{$empleado->email}}" readonly type="text" class="form-control" name="email">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unidad_id" class="control-label">Unidad</label>
                            <div class="">
                                {!! Form::select('unidad_id',$unidades,null,['class'=>'chosen-select-width','placeholder'=>'Seleccione una unidad administrativa']) !!}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Rol del usuario</label>

                            <div class="">
                                 {{Form::select('roles',$roles,null, ['class'=>'chosen-select-width','placeholder'=>'Seleccione un rol'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class=" control-label">Contraseña</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label">Confirmar Contraseña</label>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
		           
	          	</div>
	        </div>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registrar_user" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="editar_user" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Editar Datos de Usuario</h4>
      </div><!--header-->
      <div class="modal-body">
        {{ Form::model($empleado->user, array('class' => '','id'=>'e_usuarios')) }} 
        <?php if ($empleado->es_usuario=='si' && $empleado->user): ?>
          <div class="row">
              <div class="col-md-12">
                 <div class="form-group">
                    <label for="username" class="control-label">Nombre de Usuario</label>
                    <input id="username" type="text" autocomplete="off" class="form-control" name="username" value="{{$empleado->user->username}}">
                    <input id="empleado_id" type="hidden" autocomplete="off" class="form-control" name="elempleado" value="{{$empleado->id}}">
                </div>
                <div class="form-group">
                  <label for="" class="control-label">Email</label>
                  <input type="text" name="email" autocomplete="off" value="{{$empleado->user->email}}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="" class="control-label">Rol de usuario</label>
                  <div>
                      {!! Form::select('unidad_id',$roles,null,['class'=>'chosen-select-width','placeholder'=>'Seleccione un rol de usuario']) !!}
                  </div>
                </div>

                <div class="form-group">
                  <label for="" class="control-label">Unidad</label>
                  <div>
                      {!! Form::select('unidad_id',$unidades,null,['class'=>'chosen-select-width','placeholder'=>'Seleccione una unidad administrativa']) !!}
                  </div>
                </div>
              </div>
          </div>
          <?php endif ?>
        </form>
      </div><!--modal body-->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="eledit_user" class="btn btn-success">Guardar</button>
      </div><!--Final footer-->
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="editar_bankinfo" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Editar Datos Bancarios</h4>
      </div>
      <div class="modal-body">
        {{ Form::model($empleado->num_cuenta, array('class' => '','id'=>'e_bancos')) }}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" value="{{ $empleado->id }}" name="codigo">
              <label class="control-label col-md-4">Seleccione el Banco</label>
              {{Form::select('banco',$bancos,$empleado->banco_id,['class'=>'chosen-select-width','placeholder'=>'Seleccione un banco','required'])}}
              <p></p>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Número de Cuenta</label>
              <input id="numcuenta" type="text" autocomplete="off" class="form-control" name="num_cuenta" value="{{$empleado->num_cuenta}}">
            </div>
          </div>
        </div>
      </div>
    </form>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" id="eledit_banco" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="editar_datoafp" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Editar Datos de AFP</h4>
      </div>
      <div class="modal-body">
        <form id="e_afp">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" value="{{ $empleado->id }}" name="codigo">
              <label class="control-label col-md-4">Seleccione AFP</label>
              {{Form::select('afp',$afps,$empleado->afp_id,['class'=>'chosen-select-width','placeholder'=>'Seleccione AFP','required'])}}
              <p></p>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Número de AFP</label>
              <input id="numafp" type="text" autocomplete="off" class="form-control" name="num_afp" value="{{$empleado->num_afp}}">
            </div>
          </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" id="eledit_afp" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="md_prestamo" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Préstamo</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_prestamo" class="form-horizontal"> 
          <div class="row">
              <div class="col-md-12">
                 @include('prestamos.formulario')

         
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="regi_prestamo" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="md_descuento" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Descuento</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form_descuento" class="form-horizontal"> 
          <div class="row">
              <div class="col-md-12">
                 @include('descuentos.formulario')

         
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="regi_descuento" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Nuevo</h4>
			</div>
			<div class="modal-body">
				<form id="form_catcargo">
					<div class="form-group">
						<label for="">
							Nombre de la categoría
						</label>
						<input type="text" name="nombre" autocomplete="off" class="form-control">
						<input type="hidden" name="id" value="<?php echo date('Yidisus') ?>">
					</div>
				
			</div>
			<div class="modal-footer">
				<center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Guardar</button></center>
      </div>
    </form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_cargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Nuevo</h4>
			</div>
			<div class="modal-body">
				<form id="form_cargo">
          <div class="form-group">
						<label for="" class="control-label">Categoría</label>
						<div>
							<input type="text" readonly class="form-control n_cargo">
							<input type="hidden" name="catcargo_id" class="form-control id_cargo">
						</div>
					</div>
					<div class="form-group">
						<label for="">
							Cargo
						</label>
						<input type="text" name="cargo" autocomplete="off" class="form-control">
					</div>
			
			</div>
			<div class="modal-footer">
				<center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Guardar</button></center>
      </div>
    </form>

		</div>
	</div>
</div>

<div class="modal fade" id="modal_unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Nuevo</h4>
			</div>
			<div class="modal-body">
				<form id="form_unidades">
					<div class="form-group">
						<label for="">
							Unidad administrativa
						</label>
						<input type="text" name="nombre_unidad" autocomplete="off" class="form-control">
					</div>
					
				
			</div>
			<div class="modal-footer">
				<center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-success">Guardar</button></center>
			</div>
			</form>
		</div>
	</div>
</div>