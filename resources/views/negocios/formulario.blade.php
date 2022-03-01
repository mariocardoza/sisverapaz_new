<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Nombre del negocio</label>
    <div class="col-md-6">
        {!!Form::text('nombre', null, ['class'=>'form-control', 'id'=>'nombre', 'autofocus']) !!}

        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('rubro_id') ? ' has-error' : '' }}">
    <label for="rubro_id" class="col-md-4 control-label">Rubro</label>
    <div class="col-md-6">
        {!!Form::select('rubro_id', $rubros, null, ['class'=>'form-control', 'id'=>'rubro_id']) !!}

        @if ($errors->has('rubro_id'))
            <span class="help-block">
                <strong>{{ $errors->first('rubro_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('contribuyente_id') ? ' has-error' : '' }}">
    <label for="contribuyente_id" class="col-md-4 control-label">Contribuyente</label>

    <div class="col-md-6">
        {!! Form::select('contribuyente_id', $contribuyentes, null, ['class'=>'form-control chosen-select']) !!}

        @if ($errors->has('contribuyente_id'))
            <span class="help-block">
                <strong>{{ $errors->first('contribuyente_id') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-2">
        <button class="btn btn-default" type="button" id="" data-toggle="modal" data-target="#btncontribuyente">Agregar nuevo</button>
    </div>
</div>

 <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
    <label for="direccion" class="col-md-4 control-label">Dirección: </label>
    <div class="col-md-6">
        {!! Form::textarea('direccion', null, ['class'=>'form-control', 'id'=>'direccion', 'size' => '30x5' ]) !!}

        @if ($errors->has('direccion'))
            <span class="help-block">
                <strong>{{ $errors->first('direccion') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="btncontribuyente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Registro de Contribuyente
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="panel-body">
                    @include('contribuyentes.formulario')
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardarcontribuyente" data-dismiss="modal" class="btn btn-success">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>