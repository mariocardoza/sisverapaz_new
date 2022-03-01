@php
    $emergencia=[];
    $emergencia=App\Emergencia::where('estado',1)->count();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta lang="es">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <title>{{ config('app.name', 'Libera tu Deuda') }}</title>
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  {{-- Styles for user admin --}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/coreui/coreui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/highcharts.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/chosen.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

  {{-- Scripts for user admin --}}
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="/js/plugins/jquery/jquery.min.js"></script>
  <script src="{{ asset('assets/js/highcharts.js') }}" defer></script>
  <script src="{{ asset('assets/js/highchart.data.js') }}" defer></script>
  <script src="{{ asset('assets/js/highchart.exporting.js') }}" defer></script>
  <script src="{{ asset('assets/js/highchart.export-data.js') }}" defer></script>
  <script src="{{ asset('assets/js/jquery-ui.js') }}" defer></script>
  <script src="{{ asset('assets/js/jquery.mask.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/jquery.inputmask.js') }}" defer></script>
  <script src="/js/plugins/datatables/datatables.min.js" defer></script>
  <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap-datetimepicker.es.js') }}" defer></script>
  <script src="{{ asset('assets/js/chosen.jquery.js') }}" defer></script>
  <script src="{{ asset('assets/js/toastr.js') }}" defer></script>
  <script src="{{ asset('assets/js/moment.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/sweetalert2.min.js') }}" defer></script>


  <script src="{{ asset('js/funcionesgenerales.js') }}" defer></script>
  <script src="/js/plugins/coreui/coreui.bundle.min.js" defer></script>
 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhvC3rIiMvEM4JUPAl4fG1xNPRKoRnoTg"></script>

  
</head>
<body class="c-app">
  <div id="sidebar" class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show">
    <div class="c-sidebar-brand d-lg-down-none">
      <div class="title-menu c-sidebar-brand-full">
        <a href="/home"><img src="/images/logo-footer.png" width="100%"></a>
      </div>
      <div class="title-menu c-sidebar-brand-minimized">
        <a href="/admin"><img src="/images/lock.png" width="45px"></a>
      </div>
    </div>

    <ul class="c-sidebar-nav ps ps--active-y">
      @if(Auth()->user()->hasRole('admin'))
        @include('menu.admin')
      @elseif(Auth()->user()->hasRole('uaci'))
        @include('menu.uaci')
      @endif
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
  </div>
  <div class="c-wrapper {{ explode('/',request()->path())[0] }}">
    <header class="c-header navbar c-header-fixed navbar-light">
      <button class="c-header-toggler c-class-toggler d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-bars"></i>
      </button>
      <div class="account-user">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          <a href="" class="link-admin edit-logued-user" data-id="{{ auth()->user()->id}} ">
            <img src="/images/user.png" width="30px">
            <p class="role-name">{{ auth()->user()->empleado->nombre }}
            </p>
          </a> 
          @csrf
          <button type="submit" class="btn btn-logout">
            <img src="/images/logout.png" width="30px">
          </button>
        </form>
      </div>
      <div class="c-subheader">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb border-0 m-0">

            @foreach (explode('/',request()->path()) as $key => $breadcrumb)
              @if($loop->last )
                @if (Request::routeIs('expedients.show') || Request::routeIs('users.show') || Request::routeIs('customers.show') || Request::routeIs('contracts.show') )
                  <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                @else
                  <li class="breadcrumb-item active" aria-current="page">{{ __('admin.' . $breadcrumb . '') }}</li>
                @endif
              @elseif( $loop->iteration == 3 )
                @if (Request::routeIs('expedients.edit'))
                  <li class="breadcrumb-item active" aria-current="page">Editar caso</li>
                @else
                  <li class="breadcrumb-item active" aria-current="page">{{ __('admin.' . $breadcrumb . '') }}</li>
                @endif
                @break
              @else
                
              @endif
            @endforeach

          </ol>
        </nav>
      </div>
    </header>
    <div class="c-body">
      <main class="c-main">
        @yield('content')
      </main>
    </div>
    <footer class="c-footer">
      <div>
        <span>{{ config('app.name') }} <?php echo date("Y"); ?></span>
      </div>
      <div class="ml-auto">
        <span>Realizado por</span>
        <a href="https://influenciadigital.net/" class="link-admin" target="_blank">ID</a>
      </div>
    </footer>
  </div>
  @yield('scripts')
</body>
</html>
