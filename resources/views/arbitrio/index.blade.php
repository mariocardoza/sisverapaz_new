@extends('layouts.app')

@section('migasdepan')
<h1>
	Ley de Arbitrio
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/cuentas') }}"><i class="fa fa-home"></i>Inicio</a></li>
	<li class="active">Arbitrio</li> </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <p>
                    Esta sección es para modificar los valores de la formula para el calculo de impuesto según ley de arbitrio municipal.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="col-md-2"><label for="">Base Imponible</label></div>
                    <div class="col-md-2"><label for="">Tarifa Imponible</label></div>
                    <div class="col-md-2"><label for="">Excedente</label></div>
                    <div class="col-md-2"><label for="">Tarifa Excedente</label></div>
                    <div class="col-md-2"><label for="">Valor fijo</label></div>
                    <div class="col-md-2 text-center"><label for="">Acción</label></div>
                    <br><br>
                    @foreach ($rentas as $index => $r)
                        <div class="col-md-2">
                        <input type="number" name="desde" class="form-control {{$index}}desde" value="{{$r->base_imponible}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="hasta" class="form-control {{$index}}hasta" value="{{$r->tarifa_imponible}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="exceso" class="form-control {{$index}}exceso" value="{{$r->excedente}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="porcentaje" class="form-control {{$index}}porcentaje" value="{{$r->tarifa_excedente}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="fijo" class="form-control {{$index}}fijo" value="{{$r->valor_fijo}}">
                        </div>
                        <div class="col-md-2 text-center">
                            <button data-id="{{$r->id}}" data-fila="{{$index}}" class="btn btn-success cambiar" title="Actualizar"><i class="fa fa-refresh"></i></button>
                        </div>
                        <br><hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(e){
        //modificar tramo
        $(document).on("click",".cambiar",function(e){
            e.preventDefault();
            modal_cargando();
            var id=$(this).attr("data-id");
            var fila=$(this).attr("data-fila");
            var base_imponible=$("."+fila+'desde').val();
            var tarifa_imponible=$("."+fila+'hasta').val();
            var excedente=$("."+fila+'exceso').val();
            var tarifa_excedente=$("."+fila+'porcentaje').val();
            var valor_fijo=$("."+fila+'fijo').val();
            console.log("Desde: "+base_imponible);
            console.log("hasta: "+tarifa_imponible);
            console.log("exceso: "+excedente);
            console.log("porcentaje: "+tarifa_excedente);
            $.ajax({
                url:'arbitrio/'+id,
                type:'PUT',
                dataType:'json',
                data:{base_imponible,tarifa_imponible,excedente,tarifa_excedente,valor_fijo},
                success: function(json){
                    if(json[0]==1){
                        toastr.success("Valores modificados con éxito");
                        location.reload();
                    }else{
                        toastr.error("Ocurrió un error");
                        swal.closeModal();
                    }
                },error: function(error){
                    toastr.error("Ocurrió un error");
                        swal.closeModal();
                }
            });
        });
    });
</script>
@endsection