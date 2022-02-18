@extends('layouts.app')

@section('migasdepan')
<h1>
        Pagina principal
        <small>Control panel UACI</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Pagina principal</li>
      </ol>

@endsection
@section('content')
@php
   $proveedores= App\Proveedor::mas_utilizados();
   $bienes= App\Materiales::mas_utilizados();
   
@endphp
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{\App\Requisicione::where('user_id',Auth()->user()->id)->where('anio','=',date('Y'))->where('estado','!=',2)->count()}}</h3>

        <p>Mis requisiciones en el año {{date('Y')}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{url('requisiciones/porusuario')}}" class="small-box-footer">Ver todas <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3>{{ \App\Ordencompra::whereEstado(3)->count() }}</h3>

              <p>Ordenes de compras</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('ordencompras.index')}}" class="small-box-footer">Ver todas<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{cantprov()}}</h3>

              <p>Proveedores Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('/proveedores') }}" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{\App\Materiales::whereEstado(1)->count()}}</h3>

              <p>Bienes e insumos</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('materiales.index')}}" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-6">
      <div id="containerProveedores"></div>
      <table id="datatableProveedores" class="hide">
          <thead>
              <tr>
                  <th>Proveedor</th>
                  <th>Compras</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($proveedores as $p)
                <tr>
                <td>{{$p->nombre}}</td>
                <td>{{$p->total}}</td>
                </tr>
            @endforeach
          </tbody>
      </table>
  </div>
  <div class="col-lg-6">
    <div id="containerBienes"></div>
    <table id="datatableBienes" class="hide">
        <thead>
            <tr>
                <th>Bien</th>
                <th>Cantidad de compras</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($bienes as $bien)
              <tr>
              <td>{{$bien->bien}}</td>
              <td>{{$bien->cuantos}}</td>
              </tr>
          @endforeach
        </tbody>
    </table>
</div>
  <div class="col-lg-6" style="display: none">
    <div class="panel">
      <h3 class="text-center">Ubicación de proyectos activos</h3>
      <div style="height: 300px;" id="mapita">

      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  let vista;let elcontador;
   var proyectos=[];
  $(document).ready(function(e){
    initMap();
    Highcharts.chart('containerProveedores', {
      data: {
          table: 'datatableProveedores'
      },
      chart: {
          type: 'column'
      },
      title: {
          text: 'Proveedores más utilizados en el año'
      },
    
      yAxis: {
          allowDecimals: false,
          title: {
              text: 'Compras'
          }
      },
      tooltip: {
          formatter: function () {
              return '<b>' + this.series.name + '</b><br/>' +
                  this.point.y + ' ' + this.point.name.toLowerCase();
          }
      }
    });

    Highcharts.chart('containerBienes', {
      data: {
          table: 'datatableBienes'
      },
      chart: {
          type: 'pie'
      },
      title: {
          text: 'Materiales o bienes más pedidos en el año'
      },
      plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:1f}'
            },
            showInLegend: true
        }
    },
    
      yAxis: {
          allowDecimals: false,
          title: {
              text: 'Compras'
          }
      },
      tooltip: {
          formatter: function () {
              return '<b>' + this.series.name + '</b><br/>' +
                  this.point.y + ' ' + this.point.name.toLowerCase();
          }
      }
    });
});

function initMap() {
  var infowindow = new google.maps.InfoWindow();
    var map;
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
     for(i = 0; i < proyectos.length; i++ ){
       let contador=0;
      if(proyectos[i].avance==null)
      contador=0;
      else
      contador=proyectos[i].avance;
       contentString[i] = '<div id="content">'+
            '<h1 id="firstHeading" class="firstHeading">'+proyectos[i].nombre+'</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Código: </b>'+proyectos[i].codigo_proyecto+'<br>'+
            '<p><b>Dirección: </b>'+proyectos[i].direccion+'<br>'+
            '<p><b>Justificación: </b>'+proyectos[i].motivo+'<br>'+
            '<p><b>Monto: </b>$'+proyectos[i].monto.toFixed(2)+'<br>'+
            '<p><b>Avance: </b>'+contador+'%<br>'+
            '<p><b>Beneficiarios: </b>'+proyectos[i].beneficiarios+' habitantes<br>'+
            '</p>'+
            '</div>'+
            '</div>';
        }

        console.log(contentString)
        
        map = new google.maps.Map(document.getElementById('mapita'), {
		    center: {lat: 13.6445855, lng: -88.8731913},
          zoom: 15,
              
        });

        //map.mapTypes.set(customMapType);
        //map.setMapTypeId(customMapType);
        /*var marker = new google.maps.Marker({
            position: {lat: 13.6445855, lng: -88.8731913},
            map: map,
            title: 'Verapaz',
            icon: '../img/obrero.png' // Path al nuevo icono
        });*/
        for( i = 0; i < proyectos.length; i++ ) {
          console.log(proyectos[i].id);
            var position = new google.maps.LatLng(proyectos[i].lat, proyectos[i].lng);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: proyectos[i].nombre,
                icon: 'img/obrero.png', // Path al nuevo icono,
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
</script>
@endsection
