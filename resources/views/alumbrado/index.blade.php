@extends('layouts.app')

@section('migasdepan')
<h1>
        Alumbrado Público
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Gestión de alumbrado público</li>
      </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <p></p>
            <div class="box-header">
                <br>
                <div class="box-title"><h4>Gestión de alumbrado público</h4></div>
                <a href="{{url('alumbrado/reparadas')}}" class="btn btn-primary" title="Ver historial"><span class="fa fa-eye"></span> Reparados</a>
                <button class="btn btn-primary pull-right" title="Reportar desperfecto" type="button" id="reportar">Reportar</button>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="height:500px;" id="elmapita"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_reportar" tabindex="-1" role="dialog" aria-labeledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Reportar lámpara dañada</h4>
			</div>
			<div class="modal-body">
				<form id="form_reportar">
					<div class="form-group">
                        <label for="" class="control-label">Nombre de quién reportó</label>
						<input type="hidden" name="lat" id="lat" class="form-control">
                        <input type="hidden" name="lng" id="lng" class="form-control">
                        <input type="text" class="form-control" name="reporto" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Tipo de lámpara</label>
                                <select name="tipo_lampara" class="chosen-select-width">
                                    <option value="">Seleccione..</option>
                                    <option value="Mercurio">Mercurio</option>
                                    <option value="Led">Led</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Fecha</label>
                                <input type="text" name="fecha" value="{{date("d-m-Y")}}" class="form-control fechita" autocomplete="off">
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="" class="control-label">Detalle de la falla</label>
                        <textarea name="detalle" id=""  rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Dirección</label>
                        <textarea name="direccion" id="ladirecc"  rows="2" class="form-control"></textarea>
                    </div>

                    
				
			</div>
			<div class="modal-footer">
				<center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button></center>
            </form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
    var alumbrados=JSON.parse('<?php echo $alumbrados; ?>');
    $(document).ready(function(e){
        var map;
        initMap();

        $(document).on("click","#reportar",function(e){
            map = new google.maps.Map(document.getElementById('elmapita'), {
		        center: {lat: 13.6445855, lng: -88.8731913},
                zoom: 15,
            });
            var myLatLng = {lat: 13.6445855, lng: -88.8731913};
            marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: 'img/lampara.png', // Path al nuevo icono,
                style:'feature:all|element:labels|visibility:off',
                draggable: true,
            });
            
            marker.addListener('click', toggleBounce);

            marker.addListener( 'dragend', function (event)
            {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("lat").value = this.getPosition().lat();
                document.getElementById("lng").value = this.getPosition().lng();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                'latLng': event.latLng
                }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                    $("#ladirecc").val(results[0].formatted_address);
                    }
                }
                });
               $("#modal_reportar").modal("show");
            });
        });

        //submit del reporte
        $(document).on("submit","#form_reportar",function(e){
            e.preventDefault();
            var datos=$("#form_reportar").serialize();
            $.ajax({
                url:'alumbrado',
                type:'post',
                dataType:'json',
                data:datos,
                success:function(json){
                    if(json[0]==1){
                        alumbrados.push(json[2]);
                        toastr.success("Reporte realizado con éxito");
                        initMap();
                        $("#modal_reportar").modal("hide");
                    }else{

                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function( key, value ) {
					    toastr.error(value);
			        });
                }
            })
        });

        //ver la lampara a reparar
        $(document).on("click",".verlampara",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            location.href='alumbrado/'+id;
        });
    });

function initMap() {
  var infowindow = new google.maps.InfoWindow();
    
    var bounds = new google.maps.LatLngBounds();
    var customMapType = new google.maps.StyledMapType([
         {
           elementType: 'labels',
           stylers: [{visibility: 'off'}]
         }
       ], {
         name: 'Custom Style'
     });
     var customMapTypeId = 'custom_style';
     var contentString = new Array();
     for(i = 0; i < alumbrados.length; i++ ){
       
       
       contentString[i] = '<div id="content">'+
            '<h1 id="firstHeading" class="firstHeading">'+alumbrados[i].detalle+'</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Reportó: </b>'+alumbrados[i].reporto+'</p><br>'+
            '<p><b>Dirección: </b>'+alumbrados[i].direccion+'</p><br>'+
            '<button data-id="'+alumbrados[i].id+'" type="button" class="btn btn-primary verlampara"><i class="fa fa-eye"></i> Ver</button>'+
            '</div>'+
            '</div>';
        }

        //console.log(contentString)
        
        map = new google.maps.Map(document.getElementById('elmapita'), {
		  center: {lat: 13.6445855, lng: -88.8731913},
          zoom: 16,
        });

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(map, event.latLng);
        });
        /*var marker = new google.maps.Marker({
            position: {lat: 13.6445855, lng: -88.8731913},
            map: map,
            title: 'Verapaz',
            icon: '../img/obrero.png' // Path al nuevo icono
        });*/
        for( i = 0; i < alumbrados.length; i++ ) {
            var position = new google.maps.LatLng(alumbrados[i].lat, alumbrados[i].lng);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: alumbrados[i].nombre,
                icon: 'img/lampara.png', // Path al nuevo icono,
                style:'feature:all|element:labels|visibility:off'
            });
            // Center the map to fit all markers on the screen
            map.fitBounds(bounds);
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                infowindow.setContent(contentString[i]);
                infowindow.open(map, marker);
              }
            })(marker, i));
        }

       
      }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
</script>
@endsection