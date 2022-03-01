@extends('layouts.app')

@section('migasdepan')
<h1>
          Proveedores
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Listado de Proveedores</li>
      </ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header ">
        <p></p>
        <div class="btn-group pull-right">
          <br>                
          <a href="javascript:void(0)" id="btn_nuevo" title="Agregar nuevo" class="btn btn-success"><span class="fa fa-plus-circle"></span></a>
          <a href="{{ url('/proveedores?estado=1') }}" title="Proveedores activos" class="btn btn-primary">Activos</a>
          <a href="{{ url('/proveedores?estado=2') }}" title="Proveedores desactivados" class="btn btn-primary">Papelera</a>
          <a target="_blank" href="{{ url('/reportesuaci/proveedores')}}" class="btn btn-primary vista_previa" title="Imprimir listado de proveedores activos" class="">Imprimir</a>
        </div>
        <div class="col-md-2"><br>
          <select name="" id="select_giro" title="Filtrar por giro" class="chosen-select-width pull-right">
            <option value="0">Todos</option>
            @foreach ($giros as $g)
              @if($elgiro==$g->id)
                <option selected value="{{$g->id}}">{{$g->nombre}}</option>
              @else 
                <option value="{{$g->id}}">{{$g->nombre}}</option>
              @endif
            @endforeach
          </select> 
        </div><br>
        <button class="btn btn-primary btn-sm" id="btn_giro">Buscar</button>
      </div>
      <p></p>
            
            <!-- /.box-header -->
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="latabla">
  				<thead>
            <th width="3%"><center>N°</center></th>
            <th width="20%"><center>Nombre de Proveedor</center></th>
            <th width="20%"><center>Dirección</center></th>
            <th width="14%"><center>Correo</center></th>
            <th width="10%"><center>Teléfono</center></th>
            <!--th width="10%">Número de registro</th-->
            <th width="18%"><center>NIT</center></th>
            <th width="15%"><center>Acciones</center></th>
          </thead>
          <tbody>
            @foreach($proveedores as $index =>$proveedor)
              <tr>
                <th><center>{{$index+1}}</center></th>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <!--td>{{ $proveedor->numero_registro }}</td-->
                <td>{{ $proveedor->nit }}</td>
                <td>
                  @if($estado == 1 || $estado == "")
                  {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                  <div class="btn-group">
                    <a href="{{ url('proveedores/'.$proveedor->id) }}" title="Ver" class="btn btn-primary"><span class="fa fa-eye"></span></a>
                    <a href="javascript:void(0)" data-id="{{$proveedor->id}}" id="btn_edit" title="Editar" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                    <button class="btn btn-danger" title="Desactivar" type="button" onclick={{ "baja(".$proveedor->id.",'proveedores')" }}><span class="fas fa-times"></span></button>
                  </div>
                  {{ Form::close()}}
                  @else
                  {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                  <button class="btn btn-success" title="Activar" type="button" onclick={{ "alta(".$proveedor->id.",'proveedores')" }}><span class="fas fa-thumbs-o-up"></span></button>
                  {{ Form::close()}}
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
  </div>
</div>
<div class="modal fade" tabindex="-1" id="modal_nuevo" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">Registrar Nuevo Proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <form id="form_nproveedor">
          <div class="row">
            @include('proveedores.formulario')
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" id="registrar_proveedor" class="btn btn-success">Guardar</button></center>
      </div>
    </div>
  </div>
</div>


<div id="modal_aqui"></div>
@endsection
@section('scripts')
<script>
$(document).ready(function(e){
  tabla_excel("latabla","probando");
  //abrir modal de nuevo proveedor
  $(document).on("click","#btn_nuevo", function(e){
    e.preventDefault();
    $("#form_nproveedor").trigger("reset");
    $("#modal_nuevo").modal("show");
  });

  //filtrar por giro
  $(document).on("click","#btn_giro",function(e){
      var giro=$("#select_giro").val();
        location.href="proveedores?giro="+giro;
    });

  //registrar un proveedor
  $(document).on("click","#registrar_proveedor",function(e){
    e.preventDefault();
    var datos=$("#form_nproveedor").serialize();
    modal_cargando();
    $.ajax({
      url:'proveedores',
      type:'post',
      dataType:'json',
      data:datos,
      success: function(json){
        if(json[0]==1){
          toastr.success("Proveedor registrado con éxito");
          setTimeout(function(){ window.location.href='proveedores/'+json[2] }, 3000);
        }else{
          toastr.error("Ocurrió un error");
          swal.closeModal();
        }
      },
      error: function(error){
        $.each(error.responseJSON.errors,function(i,v){
          toastr.error(v);
        });
        swal.closeModal();
      }
    });
  });

  //abrir modal para editar
  $(document).on("click","#btn_edit",function(e){
    e.preventDefault();
    var id=$(this).attr("data-id");
    $.ajax({
      url:'proveedores/'+id+'/edit',
      type:'get',
      dataType:'json',
      success: function(json){
        if(json[0]==1){
          $("#modal_aqui").empty();
          $("#modal_aqui").html(json[2]);
          $("#modal_proveedor").modal("show");
        }else{

        }
      }
    });
  });

  //editar el proveedor
  $(document).on("click","#editar_proveedor",function(e){
    e.preventDefault();
    var datos=$("#form_edit").serialize();
    var id=$(this).attr("data-id");
    modal_cargando();
    $.ajax({
      url:'proveedores/'+id,
      type:'put',
      dataType:'json',
      data:datos,
      success: function(json){
        if(json[0]==1){
          toastr.success("Proveedor modificado con éxito");
          setTimeout(function(){ window.location.reload() }, 3000);
        }else{
          toastr.error("Ocurrió un error");
          swal.closeModal();
        }
      },
      error: function(error){
        $.each(error.responseJSON.errors,function(i,v){
          toastr.error(v);
        });
        swal.closeModal();
      }
    });
  });
});
function tabla_excel(tabla,titulo){
    $('#'+tabla).DataTable({
      dom: 'Bfrtip',
      buttons: [
          {
              extend:'pdfHtml5',
              footer:true,
              title: 'Reporte de proveedores',
              orientation: 'landscape',
              messageTop: 'Listado de proveedores',
              exportOptions: { columns: [0,1,2,3,4,5,6] },
              text: 'Exportar a PDF <i class="fa fa-file-pdf-o"></i>'
          }
      ],
        language: {
            processing: "Búsqueda en curso...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ Elementos",
            info: "Mostrando _START_ de _END_ de un total de _TOTAL_ Elementos",
            infoEmpty: "Visualizando 0 de 0 de un total de 0 elementos",
            infoFiltered: "(Filtrado de _MAX_ elementos en total)",
            infoPostFix: "",
            loadingRecords: "Carga de datos en proceso..",
            zeroRecords: "Elementos no encontrado",
            emptyTable: "La tabla no contiene datos",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "siguiente",
                last: "Último"
            },
        },
        footer: {
          columns: [
            'Left part',
            { text: 'Right part', alignment: 'right' }
          ]
        },

      
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true
    });
  }
</script>
@endsection
