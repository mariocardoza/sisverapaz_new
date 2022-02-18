$(document).ready(function(){
  listartodos();
  var idproyecto = $("#proyecto").val();
  listadeempleados(idproyecto);
  $("#agregarf").on("click", function(e){
      var fn = $("#txtfuncion").val();
      var funcion = fn.toUpperCase();
      if(funcion != ""){
      $("#funciones").append("<li data-funcion='"+funcion+"'> "+funcion+"<div class='btn-group'><button type='button' id='btneditar' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i></button><button type='button' id='btnquitar' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-remove'></i></button> </div></li>");
      $("#txtfuncion").val("");
    }else{
      swal(
         '¡Aviso!',
         'Debe digitar una función',
         'warning'
       );
    }
  });

  /*$("#proyecto").on("change", function(e){
      var idproyecto = (this.value);
      listadeempleados(idproyecto);
  });*/

//Código para guardar
  $("#guardar").on("click", function(e){
    var funciones = new Array();
    var proyecto = $("#proyecto").val();
    var empleado = $("#empleado").val();
    var fecharevision = $("#fecharevision").val();
    var cargo = $("#cargo").val();
    var salario =$("#salario").val();
    var ruta = "/"+carpeta()+"/public/contratacionproyectos";
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#funciones li').each(function(i){
      funciones.push({
          funcion: $(this).attr("data-funcion"),
      });
    });
    if(funciones != ''){
      $.ajax({
        url: ruta,
        headers: {'X-CSRF-TOKEN':token},
        type:'POST',
        dataType:'json',
        data:{funciones,proyecto,empleado,cargo,salario,fecharevision},

        success: function(msj){
          if(msj.mensaje == "exito"){
            toastr.success('Registro creado exitosamente');
            console.log(msj.mensaje);
            limpiar();
            listartodos();
          }else{
            toastr.error("error al guardar");
            console.log(msj);
          }
        },
        error: function(msj){
          toastr.error("error");
          console.log(msj);
        }
      });
    }else{
      swal(
         '¡Aviso!',
         'Debe agregar por lo menos una función',
         'warning'
       );
    }

  });

  $('#guardarempleado').on("click", function(e){
		var retorno = guardarEmp();
		if(retorno===1){
      listadeempleados(idproyecto);
      //console.log(idproyecto);
      //$("#empleado").trigger('chosen:updated');
		}
	});

  $(document).on("click","#btneditar", function(e){
    var li = $(e.target).parents("li");
    var funcion=$(this).parents('li').text();
    $(document).find("#txtfuncion").val(funcion);
    li.remove();
  });
// con este codigo se elimina un elemento de la lista de funciones
  $(document).on("click","#btnquitar", function(e){
    var li = $(e.target).parents("li");
    li.remove();
  });



  //funcion para cargar los empleados
  function listadeempleados(idp){
    $.get('/'+carpeta()+'/public/contratacionproyectos/listadeempleados/'+idp , function(data){
  		var html_select = '<option value="">Seleccione un empleado</option>';
  			$(decodificar(data)).each(function(key, value){
  				html_select +='<option value="'+value.id+'">'+value.nombre+'</option>';
  				$("#empleado").html(html_select);
  				$("#empleado").trigger('chosen:updated');
  			});
  	});
  }

  function listartodos(){
    $.get('/'+carpeta()+'/public/contratacionproyectos/todos' , function(data){
      var contador=0;

      $(cuerpo).empty();
  			$(decodificar(data)).each(function(key, value){
          contador++;
          $(cuerpo).append(
              "<tr>"+
                  "<td>" + contador  + "</td>" +
                  "<td>" + value.empleado.nombre + "</td>" +
                  "<td>" + value.cargo + "</td>"+
                  "<td>$" + value.salario+ "</td>" +
                  "<td><div class='btn-group'>"+
                  "<a onClick='veresto("+value.id+")' data-toggle='modal' data-target='#verinformacion' title='Ver funciones' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-eye-open'></i></a>"+
                  "</div></td>"+
              "</tr>"
          );
  			});
  	});
  }

  function limpiar(){
    listadeempleados(idproyecto);
    $("#empleado").trigger('chosen:updated');
    $("#txtfuncion").val("");
    $("#fecharevision").val("");
    $("#cargo").val("");
    $("#salario").val("");
    $("#funciones").empty();
  }



});
function veresto(id){
   //$("#mostrar").text("hola "+id);
   $.get('/'+carpeta()+'/public/contratacionproyectos/vercontratado/'+id , function(data){
       $(decodificar(data)).each(function(key, value){
         $("#nomemp").text(value.empleado.nombre);
         $("#fecharev").text(fecha_espaniol(value.fecha_revision));
         $("#inicontrato").text(fecha_espaniol(value.contrato_proyecto.inicio_contrato));
         $("#fincontrato").text(fecha_espaniol(value.contrato_proyecto.fin_contrato));
         $("#horae").text(value.contrato_proyecto.hora_entrada);
         $("#horas").text(value.contrato_proyecto.hora_salida);
         $("#sal").text("$"+value.salario);
         $("#vercargo").text(value.cargo);
         var cont=0;
         $("#cuerpito").empty();
         $(value.epfuncione).each(function(key,value2){
           cont++;
           $("#cuerpito").append("<tr>"+
           "<td>"+cont+"</td>"+
           "<td>"+value2.funcion+"</td>"+
           "</tr>");
         });
       });
   });
}
