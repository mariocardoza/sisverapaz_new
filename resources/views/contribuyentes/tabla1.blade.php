<table class="table table-striped table-bordered table-hover" id="example2">
                <thead>
                  <th>Nombre de contribuyente</th>
                  <th>DUI</th>
                  <th>NIT</th>
                  <th>Edad</th>
                  <th>Dirección</th>
                  <th>Sexo</th>
                  <th>Teléfono</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                    @foreach($contribuyentes as $contribuyente)
                    <tr>
                        <td>{{ $contribuyente->nombre }}</td>
                        <td>{{ $contribuyente->dui }}</td>
                        <td>{{ $contribuyente->nit }}</td>
                        <td>{{ $contribuyente->nacimiento->age }}</td>
                        <td>{{ $contribuyente->direccion }}</td>
                        <td>{{ $contribuyente->sexo }}</td>
                        <td>{{ $contribuyente->telefono }}</td>
                     <td>
                      {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                        <a href="{{ url('contribuyentes/'.$contribuyente->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <a href="{{ url('/contribuyentes/'.$contribuyente->id.'/edit') }}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"></span></a>
                         <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$contribuyente->id.")" }}><span class="glyphicon glyphicon-trash"></span></button>
                      {{ Form::close()}} 
                    </td>
                    </tr>
                    @endforeach 
                </tbody>
              </table>