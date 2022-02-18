<table class="table table-striped table-bordered table-hover" id="example2">
                <thead>
                  <th>ID</th>
                  <th>Nombre de contribuyente</th>
                  <th>DUI</th>
                  <th>NIT</th>
                  <th>Edad</th>
                  <th>Dirección</th>
                  <th>Sexo</th>
                  <th>Teléfono</th>
                  <th>Modivo</th>
                  <th>Fecha dado de baja</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach($contribuyentes as $contribuyente)
                    <tr>
                    
                    <td>{{ $contribuyente->id }}</td>
                    <td>{{ $contribuyente->nombre }}</td>
                    <td>{{ $contribuyente->dui }}</td>
                    <td>{{ $contribuyente->nit }}</td>
                    <td>{{ $contribuyente->nacimiento->age }}</td>
                    <td>{{ $contribuyente->direccion }}</td>
                    <td>{{ $contribuyente->sexo }}</td>
                    <td>{{ $contribuyente->telefono }}</td>
                    <td>{{ $contribuyente->motivo }}</td>
                    <td>{{ $contribuyente->fechabaja->format('d-m-Y') }}</td>
                     <td>
                      {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                        <button class="btn btn-success" type="button" onclick={{ "alta(".$contribuyente->id.")" }}><span class="glyphicon glyphicon-trash"></span> Dar de alta</button>
                      {{ Form::close()}} 
                    </td>
                    </tr>
                    @endforeach 
                </tbody>
              </table>