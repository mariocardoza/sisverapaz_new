@if($logs->count() > 0)
<style>
    .centered{
        float: none;
        margin: 0 auto;
    }
</style>
<div class="row">
    <div class="col-md-10 centered">
        <div class="box">
            <div class="box-body">
                <h4 class="text-center">Histórico de cambios en {{ trans("admin.".Route::current()->getName()) }}</h4>
                <table class="table" id="excel_datatable">
                    <thead>
                        <th>N°</th>
                        <th>Servicio/impuesto</th>
                        <th>Valor</th>
                        <th>Vigente desde</th>
                        <th>Vigente hasta</th>
                    </thead>
                    <tbody>
                        @foreach($logs as $index => $log)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ nombre_tarifa($log->tabla_id,$log->tabla) }}</td>
                            <td>{{ ($log->tipo=='$') ? '$ '. number_format($log->valor,2) : number_format($log->valor*100,2) .' %'}} </td>
                            <td>{{ $log->available_from->format('d/m/Y') }}</td>
                            <td>{{ $log->available_to != '' ? $log->available_to->format('d/m/Y') : 'Vigente' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endif