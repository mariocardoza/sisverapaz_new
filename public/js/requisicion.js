$(function(){

	$(document).on("submit","#form_requisicion", function(e){
		e.preventDefault();
		var form = $("#form_requisicion").serialize();
		modal_cargando();
/////////////////////////////////////////////////// funcion ajax para guardar ///////////////////////////////////////////////////////////////////
		$.ajax({
			url: "/requisiciones",
			type:'POST',
			dataType:'json',
			data: form,
			success : function(msj){
				console.log(msj);
				if(msj.mensaje == 'exito'){
					window.location.href = "/requisiciones/"+msj.requisicion;
					console.log(msj);
					toastr.success('Requisiciones registrada éxitosamente');
				}else{
					toastr.error('Ocurrió un error, contacte al administrador');
					swal.closeModal();
				}

			},
			error: function(data, textStatus, errorThrown){
				$.each(data.responseJSON.errors, function( key, value ) {
					toastr.error(value);
				});
				swal.closeModal();
			}
		});
	});

	$(document).on("submit","#form_requisicion_edit", function(e){
		e.preventDefault();
		var id = $("#elid").val();
		var form = $("#form_requisicion_edit").serialize();
		modal_cargando();
/////////////////////////////////////////////////// funcion ajax para guardar ///////////////////////////////////////////////////////////////////
		$.ajax({
			url: "/requisiciones/"+id,
			type:'PUT',
			dataType:'json',
			data: form,
			success : function(msj){
				console.log(msj);
				if(msj.mensaje == 'exito'){
					window.location.href = "/requisiciones/"+msj.requisicion;
					console.log(msj);
					toastr.success('Requisiciones registrada éxitosamente');
				}else{
					toastr.error('Ocurrió un error, contacte al administrador');
					swal.closeModal();
				}

			},
			error: function(data, textStatus, errorThrown){
				$.each(data.responseJSON.errors, function( key, value ) {
					toastr.error(value);
				});
				swal.closeModal();
			}
		});
	});
});
