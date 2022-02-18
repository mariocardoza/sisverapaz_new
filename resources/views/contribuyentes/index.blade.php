@extends('layouts.app')

@section('migasdepan')
<h1>
        Contribuyentes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Listado de contribuyentes</li>
      </ol>
@endsection
@php
    $categorias = \App\CategoriaRubro::all();
@endphp

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <br>
            <div class="box-heading">
                <br>
                <div class="btn-group pull-right">
                    <button id="rubros" title="Agregar rubros a categorías" class="btn btn-primary">Rubros</button>
                    <button id="servicios" title="Servicios municipales" class="btn btn-primary">Servicios</button>
                    <button id="contribu" title="Agregar contribuyente" class="btn btn-success">Nuevo Contribuyente</button>
                    <button id="generar_pagos" title="Generar pagos" class="btn btn-primary">Generar pagos</button>
                </div>
                <br><br>
            </div>
            <div class="box-body">
                <table class="table" id="example2">
                    <thead>
                        <th>N°</th>
                        <th><center>Nombre</center></th>
                        <th><center>Teléfono</center></th>
                        <th><center>DUI</center></th>
                        <th><center>NIT</center></th>
                        <th><center>Estado</center></th>
                        <th><center>Acciones</center></th>
                    </thead>
                    <tbody>
                        @foreach ($contribuyentes  as $i => $c)
                        <tr>
                            <td>{{$i+1}}</td>
                            @if($c->estado==1)
                            <td>{{$c->nombre}}</td>
                            @else
                            <td><del>{{$c->nombre}}</del></td>
                            @endif
                            <td>{{$c->telefono}}</td>
                            <td>{{$c->dui}}</td>
                            <td>{{$c->nit}}</td>
                            <td>{{$c->estado == 1 ? 'Activo' : 'Inactivo'}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{url('contribuyentes/'.$c->id)}}" title="Ver detalles" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('contribuyentes/pagos/'.$c->id) }}" title="Cobros realizados" class="btn btn-success"><i class="fa fa-money"></i></a>
                                    <button class="btn btn-info ver_mis_inmuebles" title="Ver inmuebles" data-id="{{$c->id}}"><i class="fa fa-credit-card"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{ Form::open(['url' => url('verpagosgenerados'),'class' => 'form-horizontal','id'=>'verPagos','target'=>'_blank']) }}
    <input type="hidden" name="token" value="{{csrf_token()}}">
</form>
{{ Form::open(['url' => url('verpagosnegociosgenerados'),'class' => 'form-horizontal','id'=>'verPagos2','target'=>'_blank']) }}
    <input type="hidden" name="token" value="{{csrf_token()}}">
</form>
{{ Form::open(['url' => url('verfacturaspendientes'),'class' => 'form-horizontal','id'=>'verFacturas','target'=>'_blank']) }}
    <input type="hidden" name="token" value="{{csrf_token()}}">
</form>
@include('contribuyentes.modales')
@endsection

@section('scripts')
<script src="{{asset('js/generar_factura.js?cod='.date("Yidisus"))}}"></script>
<script>
    const categorias = '<?php echo $categorias; ?>';
    $(document).ready(function(e){
        console.log(categorias);
        //modal de los rubros
        $(document).on("click","#rubros",function(e){
            e.preventDefault();
            $("#modal_rubros").modal("show");
            $("#nuevo_rubro").show();
            rubros();
        });

        //modal de los servicios
        $(document).on("click","#servicios",function(e){
            e.preventDefault();
            $("#modal_servicios").modal("show");
            $("#nuevo_servicio").show();
            servicios();
        });

        //generar los pagos del mes
        $(document).on("click","#generar_pagos",function(e){
            e.preventDefault();
            modal_cargando();
            $.ajax({
                url:'/contribuyentes/generarpagos',
                type:'post',
                dataType:'json',
                success: function(json){
                    if(json.error==false){
                        toastr.success("Facturas generadas con éxito");
                        swal.closeModal();
                        $('#verPagos').submit();        
                        $('#verPagos2').submit();        
                    }else{
                        toastr.error(json.message);
                        swal.closeModal();
                    }
                },error : function(error){
                    toastr.error("Error en el servidor, intente otra vez");
                    swal.closeModal();
                }
            });
        });

        //registrar un nuevo rubro
        $(document).on("click","#nuevo_rubro",function(e){
            e.preventDefault();
            var html="<tr class='rfila'>"+
                "<td></td>"+
                "<td><select id='n_categoria' class='form-control'>"+
                    "<option value='1'>Servicios</option>"+
                    "<option value='2'>Comercios</option>"+
                    "<option value='3'>Licencias</option>"+
                "</select></td>"+
                "<td><input class='form-control' type='text' id='n_rubro'></td>"+
                "<td><input class='form-control' type='number' id='n_porcentaje'></td>"+
                "<td><select id='n_formula' class='form-control'>"+
                    "<option value='0'>No</option>"+
                    "<option value='1'>Si</option>"+
                "</select></td>"+
                "<td></td>"+
                "<td>"+
                "<div class='btn-group'><button class='btn btn-success' type='button' id='r_rubro'><i class='fa fa-check'></i></button>"+
                "<button class='btn btn-danger' type='button' id='can_rubros'><i class='fa fa-thumbs-o-down'></i></button></div>"+
                "</td>"+
                "</tr>";
            $(".tbrubro>tbody").append(html);
            $("#n_rubro").focus();
            $("#nuevo_rubro").hide();
        });

        //registrar un nuevo servicio
        $(document).on("click","#nuevo_servicio",function(e){
            e.preventDefault();
            var html="<tr class='sfila'>"+
                "<td></td>"+
                "<td><input class='form-control' type='text' id='n_servicio'></td>"+
                "<td><input class='form-control' type='number' id='n_costo'></td>"+
                "<td><select class='form-control' id='ser_obli'><option value='0'>Variable</option><option value='1'>Fijo</option></select></td>"+
                "<td></td>"+
                "<td>"+
                "<div class='btn-group'><button class='btn btn-success' type='button' id='r_servicio'><i class='fa fa-check'></i></button>"+
                "<button class='btn btn-danger' type='button' id='can_servicios'><i class='fa fa-minus-circle'></i></button></div>"+
                "</td>"+
                "</tr>";
            $(".tbservicio>tbody").append(html);
            $("#n_servicio").focus();
            $("#nuevo_servicio").hide();
        });

        //cancelar registro de rubro
        $(document).on("click","#can_rubros",function(e){
            e.preventDefault();
            $(".rfila").remove();
            $("#nuevo_rubro").show();
        });

        //cancelar registro de rubro
        $(document).on("click","#can_servicios",function(e){
            e.preventDefault();
            $(".sfila").remove();
            $("#nuevo_servicio").show();
        });

        //registrar un rubro
        $(document).on("click","#r_rubro",function(e){
            e.preventDefault();
            var nombre=$("#n_rubro").val();
            var porcentaje=$("#n_porcentaje").val();
            var categoriarubro=$("#n_categoria").val();
            var formula=$("#n_formula").val();
            $.ajax({
                url:'rubros',
                type:'post',
                dataType:'json',
                data:{nombre,porcentaje,formula,categoriarubro},
                success: function(json){
                    if(json.response==true){
                        toastr.success("Rubro registro con éxito");
                        rubros();
                        $("#nuevo_servicio").show();
                        $("#nuevo_rubro").show();
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors,function(i,v){
                        toastr.error(v);
                    });
                }
            });
        });

        //registrar un servicio
        $(document).on("click","#r_servicio",function(e){
            e.preventDefault();
            var nombre=$("#n_servicio").val();
            var costo=$("#n_costo").val();
            var isObligatorio=$("#ser_obli").val();
            $.ajax({
                url:'tiposervicios',
                type:'post',
                dataType:'json',
                data:{nombre,costo,isObligatorio},
                success: function(json){
                    if(json.response==true){
                        toastr.success("servicio registrado con éxito");
                        servicios();
                        $("#nuevo_servicio").show();
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors,function(i,v){
                        toastr.error(v);
                    });
                }
            });
        });

        //editar un servicio
        $(document).on("click","#editar_s",function(e){
            e.preventDefault();
            var fila=$(this).attr("data-fila");
            $(".spanver"+fila).hide();
            $(".ocu").hide();
            $(".spannover"+fila).show();
        });
        
        //editar un rubro
        $(document).on("click","#editar_r",function(e){
            e.preventDefault();
            var fila=$(this).attr("data-fila");
            $(".visible"+fila).hide();
            $(".ocu").hide();
            $(".invisible"+fila).show();
        });

        //cancelar editar un servicio
        $(document).on("click","#can_edit",function(e){
            e.preventDefault();
            var fila=$(this).attr("data-fila");
            $(".spanver"+fila).show();
            $(".ocu").show()
            $(".spannover"+fila).hide();
        });

        //cancelar editar un rubro
        $(document).on("click","#can_edit_r",function(e){
            e.preventDefault();
            var fila=$(this).attr("data-fila");
            $(".visible"+fila).show();
            $(".ocu").show()
            $(".invisible"+fila).hide();
        });

        //editar_servicio
        $(document).on("click","#editar_ser",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            var fila=$(this).attr("data-fila");
            var nombre=$(".nombre_ser"+fila).val();
            var costo=$(".costo_ser"+fila).val();
            var isObligatorio=$(".obligatorio_ser"+fila).val();
            $.ajax({
                url:'tiposervicios/'+id,
                type:'put',
                dataType:'json',
                data:{nombre,costo,isObligatorio},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("servicio modificado");
                        servicios();
                        $("#can_edit").trigger("click");
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors,function(i,v){
                        toastr.error(v);
                    });
                }
            });
        });
        

        //editar el rubro
        $(document).on("click","#eleditar_r",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            var fila=$(this).attr("data-fila");
            var nombre=$(".nonr"+fila).val();
            var porcentaje=$(".porcen"+fila).val();
            var categoriarubro=$(".cate"+fila).val();
            var formula=$(".formu"+fila).val();
            $.ajax({
                url:'rubros/'+id,
                type:'put',
                dataType:'json',
                data:{nombre,porcentaje,categoriarubro,formula},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("Rubro modificado");
                        rubros();
                        $("#can_edit_r").trigger("click");
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors,function(i,v){
                        toastr.error(v);
                    });
                }
            });
        });



        //quitar un rubro
        $(document).on("click","#quitar_r",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            $.ajax({
                url:'rubros/'+id,
                type:'delete',
                dataType:'json',
                data:{estado:false},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("Rubro eliminado");
                        rubros();
                    }else{
                        toastr.error(json.message);
                    }
                },error:function(error){
                    toastr.error("Ocurrió un error, contacte al administrador");
                }
            })
        });

        //quitar un rubro
        $(document).on("click","#quitar_s",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            $.ajax({
                url:'tiposervicios/'+id,
                type:'delete',
                dataType:'json',
                data:{estado:false},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("Servicio eliminado");
                        servicios();
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                }
            })
        });

        //restaurar un rubro
        $(document).on("click","#restaurar_r",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            $.ajax({
                url:'rubros/'+id,
                type:'delete',
                dataType:'json',
                data:{estado:true},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("Rubro restaurado");
                        rubros();
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                }
            })
        });

        //restaurar un rubro
        $(document).on("click","#restaurar_s",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            $.ajax({
                url:'tiposervicios/'+id,
                type:'delete',
                dataType:'json',
                data:{estado:true},
                success: function(json){
                    if(json.ok==true){
                        toastr.success("Servicios restaurado con éxito");
                        servicios();
                    }else{
                        toastr.error("Ocurrió un error");
                    }
                }
            })
        });

        //modal nuevo contribuyente
        $(document).on("click","#contribu",function(e){
            e.preventDefault();
            $("#modal_contribuyente").modal("show");
        });

        //submit a form_contribuyente
        $(document).on("submit","#form_contribuyente",function(e){
            e.preventDefault();
            var datos=$("#form_contribuyente").serialize();
            modal_cargando();
            $.ajax({
                url:'contribuyentes',
                type:'post',
                dataType:'json',
                data:datos,
                success: function(json){
                    if(json[0]==1){
                        toastr.success("Contribuyente registrado con éxito");
                        location.reload();
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

    function rubros(){
        $.ajax({
            url:'rubros',
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $(".tbrubro>tbody").empty();
                    $(".tbrubro>tbody").html(json[2]);
                }
            }
        });
    }

    function servicios(){
        $.ajax({
            url:'tiposervicios',
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $(".tbservicio>tbody").empty();
                    $(".tbservicio>tbody").html(json[2]);
                }
            }
        });
    }
</script>
@include('contribuyentes.modales_factura')
@endsection