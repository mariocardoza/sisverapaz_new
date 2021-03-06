@extends('layouts.app')

@section('migasdepan')
<h1>
	Categorías para Plan Anual
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i>Inicio</a></li>
	<li class="active">Categorías</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<p></p>
		<div class="card-header">
			<br>
			<div class="btn-group float-right">
				<a href="javascript:void(0)" id="btnmodalagregar" title="Agregar categoría" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
				<a href="{{ url('/paaccategorias?estado=1') }}" title="Categorías activas" class="btn btn-primary">Activos</a>
				<a href="{{ url('paaccategorias?estado=2') }}" title="Categorías desactivadas" class="btn btn-primary">Papelera</a>
			</div>
		</div>

		<div class="card-body table-responsive">
			<table class="table table-striped table-bordered table-hover" id="example2">
				<thead>
					<tr>
                        <th><center>N°</center></th>
                        <th><center>Categoría</center></th>
                        <th><center>Acciones</center></th>
                    </tr>
				</thead>
			<tbody>
				@foreach($categorias as $key => $c)
				<tr>
					<td><center>{{ $key+1}}</center></td>
					<td>{{ $c->nombre }}</td>
					<td><center>
						@if($c->estado == 1)
						{{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
						<div class="btn-group">
							<a href="javascript:(0)" id="edit" data-id="{{$c->id}}" title="Editar" class="btn btn-warning"><span class="fa fa-edit"></span></a>
							<button class="btn btn-danger" title="Desactivar" type="button" onclick={{ "baja(".$c->id.",'paaccategorias')" }}><span class="fa fa-thumbs-o-down"></span></button>
						</div>
						{{ Form::close()}}
						@else
						{{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
						<button class="btn btn-success" title="Activar" type="button" onclick={{ "alta(".$c->id.",'paaccategorias')" }}><span class="fa fa-thumbs-o-up"></span></button>
						{{ Form::close()}}
						@endif
						</center>
					</td>
				</tr>
				@endforeach
			</tbody>
			</table>
		</div>
	</div>
	</div>
</div>

@include("paacs.categorias.modales")
@endsection

@section("scripts")
<script>
	$(document).ready(function(e){
		$(document).on("click", "#btnmodalagregar", function(e){
			$("#modal_registrar").modal("show");
		});

		$(document).on("click", "#btnguardar", function(e){
			e.preventDefault();
            var datos= $("#form_categoria").serialize();
            modal_cargando();
			$.ajax({
				url:"paaccategorias",
				type:"post",
				data:datos,
				success:function(retorno){
					if(retorno[0] == 1){
						toastr.success("Registrado con éxito");
                        $("#modal_registrar").modal("hide");
                        $("#form_categoria").trigger("reset");
                        window.location.reload();
                        swal.closeModal();
					}
					else{
                        toastr.error("Falló");
                        swal.closeModal();
					}
				},
				error:function(error){
					console.log();
					$.each(error.responseJSON.errors, function( key, value ) {
					    toastr.error(value);
                    });
                    swal.closeModal();
				}
			});
		});
		$(document).on("click", "#edit", function(){
			var id = $(this).attr("data-id");
			$.ajax({
				url:"paaccategorias/"+id+"/edit",
				type:"get",
				data:{},
				success:function(retorno){
					if(retorno[0] == 1){
						$("#modal_editar").modal("show");
						$("#e_nombre").val(retorno[2].nombre);
						$("#elid").val(retorno[2].id);
						
					}
					else{
						toastr.error("error");
					}
				}
			});
		});  //Fin modal de editar

		$(document).on("click", "#btneditar", function(e){
			var id = $("#elid").val();
			var nombre = $("#e_nombre").val();
            var salario_dia=$("#e_salario").val();
            modal_cargando();
			$.ajax({
				url:"paaccategorias/"+id,
				type: "put",
				data: {nombre,salario_dia},
				success:function(retorno){
					if(retorno[0] == 1){
						toastr.success("Exitoso");
                        $("#modal_editar").modal("hide");
                        $("#form_edit").trigger("reset");
                        window.location.reload();
                        swal.closeModal();
					}
					else{
                        toastr.error("error");
                        swal.closeModal();
					}
				},error: function(){
                    swal.closeModal();
                }
			});
		});  //Fin btneditar

	});
</script>
@endsection