<!--li class="treeview {{Route::currentRouteName() == 'paacs.index' ? 'active': (Route::currentRouteName()== 'paacs.show' ? 'active':null)}}">
    <a href="{{ url('paacs')}}">
        <i class="fa fa-line-chart"></i> <span>Plan Anual de Compras</span>
    </a>
    
</li-->
<li class="c-sidebar-nav-item">
    <a href="{{ route('home') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Dashboard
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a href="{{ url('paacs') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Plan anual de compras
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a href="{{ url('requisiciones') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Requisiciones
    </a>
</li>

<li class="c-sidebar-nav-item">
    <a href="{{ url('ordencompras') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Orden de compras
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a href="{{ url('proveedores') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Proveedores
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a href="{{ url('materiales') }}" class="c-sidebar-nav-link">
      <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
      Materiales e insumos
    </a>
</li>
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
    <a href="javascript:void(0)" class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
      <img src="/images/web.png" class="c-sidebar-nav-icon">
      Otros
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
      <li class="c-sidebar-nav-item">
        <a href="{{ url('paaccategorias') }}" class="c-sidebar-nav-link">
          <img src="/images/blog.png" class="c-sidebar-nav-icon">
          Categorías plan anual
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ url('giros') }}" class="c-sidebar-nav-link">
          <img src="/images/testimonials.png" class="c-sidebar-nav-icon">
          Giro de proveedores
        </a>
      </li>
    </ul>
</li>
<!--li class="treeview {{Route::currentRouteName() == 'proyectos.index' ? 'active':(Route::currentRouteName()== 'proyectos.show' ? 'active':null)}}">
    <a href="{{ url('proyectos')}}">
        <i class="fa fa-industry"></i> <span>Proyectos</span>
    </a>
</li>

<li class="treeview {{Route::currentRouteName() == 'presupuestounidades.index' ? 'active':(Route::currentRouteName()== 'presupuestounidades.show' ? 'active':null)}}">
    <a href="{{url('presupuestounidades')}}">
        <i class="fa fa-pie-chart"></i>
        <span>Presupuestos</span>
    </a>
</li>

<li class="treeview {{Route::currentRouteName() == 'requisiciones.index' ? 'active':(Route::currentRouteName()== 'requisiciones.show' ? 'active':null)}}">
    <a href="{{url('requisiciones')}}">
        <i class="fa fa-bar-chart"></i>
        <span>Requisiciones</span>
    </a>
</li>
<li class="treeview {{ Route::currentRouteName() == 'requisiciones.porusuario' ? 'active':null}}">
    <a href="{{ url('requisiciones/porusuario') }}">
        <i class="fa fa-edit"></i> <span>Mis requisiciones</span>
    </a>
</li>

<li class="treeview {{Route::currentRouteName() == 'ordencompras.index' ? 'active':(Route::currentRouteName()== 'ordencompras.show' ? 'active':null)}}">
    <a href="{{url('ordencompras')}}">
        <i class="fa fa-bar-chart"></i>
        <span>Ordenes de compra</span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'proveedores.index' ? 'active':(Route::currentRouteName()== 'proveedores.show' ? 'active':null)}}">
    <a href="{{ url('proveedores') }}">
        <i class="fa fa-user-circle-o"></i>
        <span>Proveedores</span>
        <span class="pull-right-container">
              <span class="label label-primary pull-right">{{cantprov()}}</span>
            </span>
    </a>
</li>

<li class="treeview {{ Route::currentRouteName() == 'materiales.index' ? 'active': (Route::currentRouteName() == 'categorias.index' ? 'active' : (Route::currentRouteName() == 'unidadmedidas.index' ? 'active': null) ) }}">
    <a href="{{ url('materiales') }}">
      <i class="fa fa-share"></i> <span>Bienes e Insumos</span>
    </a>
</li>

    <li class="treeview ">
        <a href="#">
            <i class="fa fa-user-circle-o"></i>
            <span>Otros</span>
            <span class="pull-right-container">
                  <span class="label label-primary pull-right"></span>
                </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ url('paaccategorias') }}"><i class="fa fa-circle-o"></i> Categorias del Plan Anual</a></li>
            <li><a href="{{ url('giros') }}"><i class="fa fa-circle-o"></i>Giro de Proveedores</a></li>
        </ul>
    </li-->

