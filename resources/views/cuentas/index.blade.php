@extends('layouts.app')

@section('migasdepan')
<h1>
  Cuentas
</h1>
<ol class="breadcrumb">
  <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i>Cuentas</a></li>
  <li class="active">Listado de cuentas</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-tittle"></h3>
        <div class="btn-group col-md-10">
            <a href="javascript:void(0)" id="modal_registrar" class="btn btn-success">Registrar</a>
            <a href="{{ url('/cuentas?estado=1') }}" class="btn btn-primary">Activos</a>
            <a href="{{ url('cuentas?estado=2') }}" class="btn btn-primary">Liquidadas</a>
        </div>
        <div class="col-md-2">
          <select name="" id="select_anio" class="chosen-select-width pull-right">
              <option value="0">Seleccione el año</option>
              @foreach ($anios as $anio)
                @if($elanio==$anio->anio)
                <option selected value="{{$anio->anio}}">{{$anio->anio}}</option>
                @else 
                <option value="{{$anio->anio}}">{{$anio->anio}}</option>
                @endif
              @endforeach
            </select>
            <button class="btn btn-primary" id="btn_anio">Aceptar</button>
      </div>
      
      </div>

    <div class="box-body table-responsive">
      <table class="table table-striped table-bordered table-hover" id="example2">
        <thead>
          <th>N°</th>
          <th>Nombre</th>
          <th>Número de cuenta</th>
          <th>Tipo de cuenta</th>
          <th>Monto</th>
          <th>Banco</th>
          <th>Acción</th>
        </thead>
        <tbody>
          @foreach($cuentas as $index=> $cuenta)
          <tr>
            <td>{{$index+1}}</td>
            <td>{{ $cuenta->nombre }}</td>
            <td>{{ $cuenta->numero_cuenta }}</td>
            @if($cuenta->tipo_cuenta==1)
              <td>Principal</td>
            @elseif($cuenta->tipo_cuenta==2)
              <td>Fiestas </td>
            @else
              <td>Común </td>
            @endif
            <td>${{ number_format($cuenta->monto_inicial,2) }}</td>
            <td>{{ $cuenta->banco->nombre }}</td>
            
            
            <td>
              @if($cuenta->estado == 1)
              {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
              
              <div class="btn-group">
                <a href="{{ url('cuentas/'.$cuenta->id)}}" class="btn btn-primary"><span class="fa fa-eye"></span></a>
                <a href="{{ url('cuentas/'.$cuenta->id.'/edit') }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                <a href="javascript:void(0)" id="remesar" data-id="{{$cuenta->id}}" class="btn btn-success"><span class="fa fa-money"></span></a>
                <a href="javascript:void(0)" id="asignar_fondos" data-id="{{$cuenta->id}}" class="btn btn-info"><span class="fa fa-retweet"></span></a>
                <button class="btn btn-danger" type="button" onclick={{ "baja(".$cuenta->id.",'cuentas')" }}><span class="fa fa-thumbs-o-down"></span></button>
              </div>

              {{ Form::close()}}
              @else
              {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
              <button class="btn btn-success btn-xs" type="button" onclick={{ "alta(".$cuenta->id.",'cuentas')" }}><span class=""></span></button>
              {{ Form::close()}}
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="pull-right">
        
      </div>
    </div>
  </div>
  </div>
</div>
<div id="modal_aqui"></div>
@include('cuentas.modales')
@endsection
@section('scripts')
<script>
  $(document).ready(function(e){
    $(document).on("click","#btn_anio",function(e){
      e.preventDefault();
      let anio = $("#select_anio").val();
      if(anio!=0){
        location.href="?anio="+anio;
      }
    })

    $(document).on("click","#modal_registrar",function(e){
      $("#modal_registrar_cuenta").modal("show");
    });

    //asignarle fondos a la cuenta del pryecto
    $(document).on("click","#asignar_fondos",function(e){
        var id=$(this).attr("data-id");
        $.ajax({
            url:'cuentas/modalasignar/'+id+'/'+1,
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $("#modal_aqui").empty();
                    $("#modal_aqui").html(json[2]);
                    $("#modal_agregarfondo_cuenta").modal("show");
                    $(".chosen").chosen({
                        'width':'100%'
                    });
                }
            }
        })
    });

    //asignarle fondos a la cuenta del pryecto
    $(document).on("click","#remesar",function(e){
        var id=$(this).attr("data-id");
        $.ajax({
            url:'cuentas/modalremesar/'+id+'/'+1,
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $("#modal_aqui").empty();
                    $("#modal_aqui").html(json[2]);
                    $("#modal_remesar_cuenta").modal("show");
                    $(".chosen").chosen({
                        'width':'100%'
                    });
                }
            }
        })
    });

    /// imprimir el monto de la cuenta
    $(document).on("change","#select_fondo",function(e){
      var id=$(this).val();
      if(id!=''){
        var monto_cuenta=parseFloat($("#select_fondo option:selected").attr("data-montocuenta")) || 0;
        $("#imp_monto").text("");
        $("#imp_monto").text("$"+monto_cuenta);
      }
    });

    ///remesar cuenta
    $(document).on("click","#remesar_cuenta",function(e){
      e.preventDefault();
      var datos=$("#form_remesar_cuenta").serialize();
      $.ajax({
          url:'cuentas/remesarcuenta',
          type:'POST',
          dataType:'json',
          data:datos,
          success: function(json){
              if(json[0]==1){
                  toastr.success("Remesa realizada con éxito");
                  location.reload();
                  swal.closeModal();
              }else{
                  toastr.error("Ocurrió un error");
                  swal.closeModal();
              }
          },error: function(error){
            $.each(error.responseJSON.errors, function( key, value ) {
              toastr.error(value);
            });
              swal.closeModal(); 
          }
      });
    });

    //abonar la cuenta
    $(document).on("click","#abonar_cuenta",function(e){
        e.preventDefault();
        var id=$(this).attr("data-id");
        var elfondo=$("#select_fondo").val();
        var lacuenta=$("#select_fondo option:selected").text();
        var idcuenta=$("#select_fondo").val();
        var monto_cuenta=parseFloat($("#select_fondo option:selected").attr("data-montocuenta")) || 0;
        var abono=parseFloat($("#elmonto_abonar").val()) || 0;
        if(elfondo!=''){
            if(abono!=0){
                if(abono <= monto_cuenta){
                  modal_cargando();
                  $.ajax({
                      url:'cuentas/abonarcuenta',
                      type:'POST',
                      dataType:'json',
                      data:{cuenta_id:id,accion:'Se abono de la cuenta '+lacuenta+'',tipo:1,monto:abono,elfondo,idcuenta},
                      success: function(json){
                          if(json[0]==1){
                              toastr.success("Abono realizado con éxito");
                              location.reload();
                              swal.closeModal();
                          }else{
                              toastr.error("Ocurrió un error");
                              swal.closeModal();
                          }
                      },error: function(error){
                          toastr.error("Ocurrió un error");
                          swal.closeModal(); 
                          $.each(error.responseJSON.errors, function(i,v){
                            toastr.error(v);
                          });
                      }
                  });
                }else{
                    toastr.error("El monto supero a lo disponible en la cuenta "+lacuenta);
                }
            }else{
                toastr.error("Digite el monto a abonar");
            }
        }else{
            toastr.error("Seleccione una cuenta");
        }
        
        
    });

    $(document).on("click","#registrar_cuenta",function(e){
      var datos=$("#form_cuenta").serialize();
      modal_cargando();
      $.ajax({
        url:'cuentas',
        type:'POST',
        dataType:'json',
        data:datos,
        success:function(json){
          if(json[0]==1){
            toastr.success("cuenta registrada exitosamente");
            location.reload();
          }else{
            swal.closeModal();
            toastr.error("Ocurrió un error");
          }
        },error: function(error){
          $.each(error.responseJSON.errors,function(index,value){
	          toastr.error(value);
	        });
          swal.closeModal();
        }
      });
    });
  });
</script>
@endsection