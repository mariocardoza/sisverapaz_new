@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <p></p>
      <div class="col-md-6">
      <select name="" id="select_anio" title="Ver requisiciones por año" class="chosen-select">
        <option selected value="0">Seleccione un año</option>
        @foreach ($anios as $anio)
            <option value="{{$anio->anio}}">{{$anio->anio}}</option>
        @endforeach
      </select>
    </div>
      <div class="btn-group pull-right">
        <a href="{{ url('/requisiciones/create') }}" title="Crear nuevo" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
        <a href="javascript:void(0)" data-tipo="1" title="Requisiciones activas" class="btn btn-primary elver">Activos</a>
        <a href="javascript:void(0)" data-tipo="9" title="Requisiciones combinadas para cotizar" class="btn btn-primary elver">Combinados</a>
        <a href="javascript:void(0)" data-tipo="2" title="Requisiciones canceladas" class="btn btn-primary elver">Cancelados</a>
        <a href="javascript:void(0)" data-tipo="8" title="Requisiciones finalizadas" class="btn btn-primary elver">Finalizados</a>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <br>
    <br>

              <div class="col-md-3">
                <input type="checkbox" name="muchos" class="muchos"> Consolidar 2 o más requisiciones
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary combinar" style="display: none;" id="combinar">Consolidar</button>
              </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table table-striped table-bordered" id="latabla">
        <thead>
          <th width="3%"><center>N°</center></th>
          <th width="10%"><center>Código</center></th>
          <th><center>Actividad</center></th>
          <th><center>Unidad Administrativa</center></th>
          <th><center>Fuente de Financiamiento</center></th>
          <th><center>Responsable</center></th>
          <!--th>Observaciones</th-->
          <th><center>Estado</center></th>
          <th><center>Acciones</center></th>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script> 
  $(document).ready(function(e){
    cargar_requisiciones(tipo=1);

    $(document).on("click",".elver",function(e){
    var tipo=$(this).attr("data-tipo");
    cargar_requisiciones(tipo);
    });

    $(document).on("change","#select_anio",function(e){
      var anio=$(this).val();
      if(anio!=''){
        cargar_poranio(anio);
      }
      
    });

    $(document).on("change",".muchos",function(e){
      e.preventDefault();
      if( $(this).prop('checked') ) {
        $(".combinar").show();
      }else{
        $(".combinar").hide();
      }
    });

    //combinar
    $(document).on("click","#combinar",function(e){
      e.preventDefault();
      var requisiciones=new Array();
      $(".combinar:checked").each(function(){
        //cada elemento seleccionado
        /*requisiciones.push({
          requisicion_id : $(this).attr("data-id"),
        });*/
        requisiciones.push($(this).attr("data-id"));
      });
      console.log(requisiciones.length);
        if(requisiciones.length>=2){
            $.ajax({
              url:'requisiciones/combinar',
              dataType:'json',
              type:'POST',
              data:{requisiciones},
              success:function(json){
                if(json[0]==1){
                  toastr.success("Proceso realizado con éxito");
                  location.reload();
                }else{
                  toastr.error("Ocurrió un error");
                }
              },
              error: function(e){
                toastr.error("Ocurrio un error en el servidor");
              }
            });
        }else{
          toastr.error("Debe seleccionar al menos dos requisiciones");
        }
    });
  });


  function cargar_poranio(anio){
    modal_cargando();
    $.ajax({
      url:'requisiciones/poranio/'+anio,
      type:'get',
      data:{},
      dataType:'json',
      success: function(json){
        if(json[0]==1){
          $("#aqui_tabla").empty();
          $("#aqui_tabla").html(json[1]);
          
          swal.closeModal();
          
        }
        else{
          $("#aqui_tabla").empty();
          $("#aqui_tabla").html(json[1]);
          swal.closeModal();
        }

        inicializar_tabla("latabla");
      }
    });
  }

  function cargar_requisiciones(tipo){
    //modal_cargando();
    $.ajax({
      url:'requisiciones/portipo/'+tipo,
      type:'get',
      data:{},
      dataType:'json',
      success: function(json){
        if(json[0]==1){
          $("#aqui_tabla").empty();
          $("#aqui_tabla").html(json[1]);
          
          swal.close();
          
        }
        else{
          swal.closeModal();
        }

        inicializar_tabla("latabla");
      }
    });
  }
</script>
@endsection
