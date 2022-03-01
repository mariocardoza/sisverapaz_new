<li class="treeview {{ Route::currentRouteName() == 'cuentas.index' ? 'active':null}}">
    <a href="{{ url('cuentas') }}">
        <i class="fa fa-edit"></i> <span>Cuentas</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'ingresos.index' ? 'active':null}}">
    <a href="{{ url('ingresos') }}">
        <i class="fa fa-edit"></i> <span>Ingresos</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'desembolsos.index' ? 'active':null}}">
    <a href="{{ url('desembolsos') }}">
        <i class="fa fa-edit"></i> <span>Pagos</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'pagorentas.index' ? 'active':null}}">
    <a href="{{ url('pagorentas') }}">
        <i class="fa fa-edit"></i> <span>Pago impuesto/renta</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'servicios.index' ? 'active': ( Route::currentRouteName() == 'servicios.pagos' ? 'active':null ) }}">
    <a href="#">
        <i class="fa fa-edit"></i> <span>Pago de servicios</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ url('servicios/pagos') }}"><i class="fa fa-circle-o"></i> Pagos </a></li>
        <li><a href="{{ url('servicios') }}"><i class="fa fa-circle-o"></i> Listado de servicios </a></li>
        
    </ul>
</li>

<li class="treeview {{ Route::currentRouteName() == 'empleados.index' ? 'active': (Route::currentRouteName() == 'empleados.show' ? 'active' : null) }}">
    <a href="{{ url('empleados') }}">
        <i class="fa fa-edit"></i> <span>Empleados</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'planillas.index' ? 'active':null}}">
    <a href="{{ url('planillas') }}">
        <i class="fa fa-edit"></i> <span>Planillas</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'eventuales.index' ? 'active':null}}">
    <a href="{{ url('eventuales') }}">
        <i class="fa fa-edit"></i> <span>Para a empleados eventuales</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'requisiciones.porusuario' ? 'active':null}}">
    <a href="{{ url('requisiciones/porusuario') }}">
        <i class="fa fa-edit"></i> <span>Requisiciones</span>
    </a>
</li>


