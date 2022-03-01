$(document).ready(function(){
	cargarCuenta();

	$('#guardarcuenta').on("click", function(e)
	{	var numero = $("#num_cuenta").val();
		var proyecto_id = $("#proyec_cuenta").val();
		var banco = $("#banco_cuenta").val();
		var fecha_de_apertura = $("#fecha_aper").val();
		var monto_inicial = $("#monto_cuenta").val();
		var ruta = "/"+carpeta()+"/public/pagos/guardarcuenta";
		var token = $('meta[name="csrf-token"]').attr('content');
		alert(sexo);
		$.ajax({
			url: ruta,
			headers: {'X-CSRF-TOKEN':token},
			type:'POST',
			dataType:'json',
			data:{numero,proyecto_id,banco,fecha_aper,monto_inicial},

			success: function(){
				toastr.success('Registro creado');
				cargarCuenta();
			}
		});
	});
});

function cargarCuenta(){
	$.get('/'+carpeta()+'/public/pagos/listarcuentas', function (data){
	var html_select = '<option value="">'+data[i].id+'">'+data[i].numero+'</option>'
	for(var i=0;i<data.length;i++){
		html_select +='<option value="'+data[i].id+'">'+data[i].numero+'</option>'
		$("#pagos").html(html_select);
	}
	});
}