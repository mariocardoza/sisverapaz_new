@extends('layouts.app')

@section('migasdepan')
<h1>
        Plan Anual de Compras y Contrataciones
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Plan Anual de Compras y Adquisiciones</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-md-12">
          <div class="box">
            <p></p>
            <div class="box-header">
              <br>
                  <div class="pull-right">
                    <a id="crear" href="javascript:void(0)" title="Crear Nuevo" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
                    <p></p>                    
                  </div>
                  <div class="col-md-2">
                    <select name="" id="select_anio" title="Buscar PAACs por año" class="chosen-select-width pull-right">
                      <option value="0">Seleccione el año</option>
                      @foreach ($anios as $anio)
                        @if($elanio==$anio->anio)
                          <option selected value="{{$anio->anio}}">{{$anio->anio}}</option>
                        @else 
                          <option value="{{$anio->anio}}">{{$anio->anio}}</option>
                        @endif
                      @endforeach
                    </select><p></p>
                  </div>
                  <button class="btn btn-primary btn-sm" title="Buscar" id="btn_anio">Buscar</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th><center>N°</center></th>
                  <th><center>Año</center></th>
                  <th><center>Descripción</center></th>
                  <th><center>Total</center></th>
                  <th><center>Acciones</center></th>
                </thead>
                <tbody>
                  @foreach($paacs as $index => $paac)
                  <tr>
                    <td><center>{{ $index+1 }}</center></td>
                    <td>{{ $paac->anio }}</td>
                    <td>{{ $paac->paaccategoria->nombre }}</td>
                    <td>$ {{ number_format($paac->total,2) }}</td>
                    <td><center>
                      <div class="btn-group">
                        <a href="{{ url('paacs/'.$paac->id) }}" title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0)" id=btn_eliminar data-id="{{$paac->id}}" title="Eliminar plan" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                      </div>
                    </center></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="pull-right">

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        @include('paacs.modales')
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(e){

    $(document).on("click","#crear", function(e){
      e.preventDefault();
      $("#modal_crear").modal("show");
    });

    $(document).on("click","#registrar_paac", function(e){
      var datos=$("#form_paac").serialize();
      modal_cargando();
      $.ajax({
        url:'paacs/guardar',
        type:'POST',
        dataType:'json',
        data:datos,
        success:function(json){
          if(json[0]==1){
            toastr.success("Plan registrado con exito");
            location.reload();
          }else{
            toastr.error("Ocurrió un error");
            swal.closeModal();
          }
        }, error: function(error){
            toastr.error("Ocurrió un error");
            $.each(error.responseJSON.errors, function(i,v){
              toastr.error(v);
            });
            swal.closeModal();
        }
      })
    });

    //selecciones paacs segun el año
    $(document).on("click","#btn_anio",function(e){
      var anio=$("#select_anio").val();
      if(anio > 0){
        location.href="paacs?anio="+anio;
      }
    });

    $(document).on("click","#btn_eliminar",function(e){
        var id=$(this).attr("data-id");
        var token = $('meta[name="csrf-token"]').attr('content');
        swal({
       title: '¿Desea continuar?',
       text: "¡Se eliminar la información!",
       type: 'warning',
       showCancelButton: true,
       cancelButtonText:"Cancelar",
       confirmButtonColor: 'red',
       cancelButtonColor: '#3085d6',
       confirmButtonText: '¡Si, continuar!'
   }).then(function () {
      swal({
         title: '¿Está realmente seguro?',
         text: "¡Se acción eliminará permanentemente el registro y no podrá acceder a el nuevamente!",
         type: 'warning',
         showCancelButton: true,
         cancelButtonText:"Cancelar",
         confirmButtonColor: 'red',
         cancelButtonColor: '#3085d6',
         confirmButtonText: '¡Si, continuar!'
      }).then(function () {
        $.ajax({
          url:'paacs/'+id,
          headers: {'X-CSRF-TOKEN':token},
          type:'DELETE',
          dataType:'json',
          data:{},
          success: function(json){
            console.log(json);
          }
        });
      });
   });
    });
  });
</script>
@endsection
