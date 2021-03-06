<!--ul class="sidebar-menu">
        @if($emergencia>0)
        <li class="treeview active">
          <a href="{{ url('/directa') }}">
            <i class="fa fa-money"></i> <span style="color: red;">Contratación directa</span>
          </a>
          
        </li>
        @endif
        <li class="{{Route::currentRouteName() =='home' ? 'active' : null}}"><a href="{{url('/home')}}">Página de inicio</a></li>
    <li class="treeview {{ Route::currentRouteName() == 'configuraciones.create' ? 'active':null}}">
      <a href="{{ url('configuraciones') }}">
        <i class="glyphicon glyphicon-cog"></i><span>Administración</span>
      </a>
    </li>

    <li class="treeview ">
      <a href="{{ url('/rentas') }}">
        <i class="glyphicon glyphicon-tasks"></i> <span>Porcentajes Impuesto/renta</span>
      </a>
     
    </li>

    <li class="treeview {{ Route::currentRouteName() == 'bitacoras.index' ? 'active':null}}">
      <a href="{{ url('/bitacoras') }}">
        <i class="glyphicon glyphicon-tasks"></i> <span>Bitácora</span>
      </a>
     
    </li>

    <li class="treeview {{ Route::currentRouteName() == 'usuarios.index' ? 'active':null}}">
      <a href="{{ url('/usuarios') }}">
        <i class="fa fa-user"></i> <span>Usuarios</span>
      </a>
      
    </li>

    <li class="treeview {{ Route::currentRouteName() == 'empleados.index' ? 'active':null}}">
      <a href="{{ url('/empleados') }}">
        <i class="fa fa-user"></i> <span>Empleados</span>
      </a>
      
    </li>



    <li class="treeview {{ Route::currentRouteName() == 'backups.index' ? 'active':null}}">
      <a href="{{ url('/backups') }}">
        <i class="glyphicon glyphicon-hdd"></i><span>Respaldos</span>
      </a>
    </li>

    <li class="treeview {{ Route::currentRouteName() == 'unidades.index' ? 'active':null}}">
      <a href="{{ url('/unidades') }}">
        <i class="fa fa-list"></i><span>Unidades administrativas</span>
      </a>
    </li>

    <li class="treeview {{ Route::currentRouteName() == 'cargos.index' ? 'active': (Route::currentRouteName() == 'catcargos.index' ? 'active' : null) }}">
      <a href="#">
        <i class="fa fa-list"></i><span>Cargos</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('catcargos') }}"><i class="fa fa-circle-o"></i> Categorías para los cargos </a></li>
        <li><a href="{{ url('cargos') }}"><i class="fa fa-circle-o"></i> Cargos </a></li>  
    </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-share"></i> <span>Misceláneos</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{url('afps')}}"><i class="fa fa-circle-o"></i> AFPS</a></li>
        <li><a href="{{url('bancos')}}"><i class="fa fa-circle-o"></i> Bancos</a></li>
        <li><a href="{{url('giros')}}"><i class="fa fa-circle-o"></i> Giro de proveedores</a></li>
        <li><a href="{{url('servicios')}}"><i class="fa fa-circle-o"></i> Listado de servicios</a></li>
      </ul>
    </li-->
 
    @if(Auth()->user()->hasRole('admin'))
    @include('menu.admin')
    @if(Auth()->user()->hasRole('uaci'))
    @include('menu.uaci')
    @endif
    @if(Auth()->user()->hasRole('tesoreria'))
      @include('menu.tesoreria')
    @endif
    @if(Auth()->user()->hasRole('catastro'))
      @include('menu.ryct')
    @endif
    @if(Auth()->user()->hasRole('proyectos'))
    <li class="treeview {{Route::currentRouteName() == 'proyectos.index' ? 'active':(Route::currentRouteName()== 'proyectos.show' ? 'active':null)}}">
      <a href="{{ url('proyectos')}}">
          <i class="fa fa-industry"></i> <span>Proyectos</span>
      </a>
  </li>
  <li class="treeview {{ Route::currentRouteName() == 'presupuestounidades.porunidad' ? 'active':null}}">
    <a href="{{ url('presupuestounidades/porunidad') }}">
        <i class="fa fa-edit"></i> <span>Presupuestos de la unidad</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'requisiciones.porusuario' ? 'active':null}}">
    <a href="{{ url('requisiciones/porusuario') }}">
        <i class="fa fa-edit"></i> <span>Requisiciones</span>
    </a>
</li>
    @endif
</ul>
