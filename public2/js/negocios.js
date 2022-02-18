$(document).ready(function(){
	cargarContribuyente();

	$('#guardarcontribuyente').on("click", function(e)
	{
		var nombre = $("#nombre").val();
		var dui = $("#dui").val();
		var nit = $("#nit").val();
		var nacimiento = $("#nacimiento").val();
		var direccion = $("#direccion").val();
		var telefono = $("#telefono").val();
		var sexo = $("#sexo").val();
		var motivo = $("#motivo").val();
		var ruta = "/sisverapaz/public/negocios/guardarcontribuyente";
		var token = $('meta[name="csrf-token"]').attr('content');
		alert(sexo);
		$.ajax({
			url: ruta,
			headers: {'X-CSRF-TOKEN':token},
			type: 'POST',
			dataType:'json',
			data:{nombre,dui,nit,nacimiento,direccion,telefono,sexo,motivo},

			success: function(){
				toastr.success('Registro creado exitosamente');
				cargarContribuyente();
			}
		});
	});
});

function cargarContribuyente()
{
	$.get('/sisverapaz/public/contratos/listarcontribuyentes', function(data){
		var html_select = '<option value="">Seleccione un contribuyente</option>';
		for(var i=0;i<data.length;i++)
		{
			html_select+='<option value="'+data[i].id+'">'+data[i].nombre+'</option>'
			$("#contribuyente").html(html_select);
		}
	});
}