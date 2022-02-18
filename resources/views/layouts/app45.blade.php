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
  <link href="{{ asset('css/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/jquery-ui/jquery-ui.multidatespicker.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/slick-slider/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/mdtimepicker/mdtimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/mdtimepicker/mdtimepicker-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/intl-tel/intl-tel.css') }}" rel="stylesheet">
  <link href="{{ asset('css/plugins/suggestedtags/amsify.suggestags.css') }}" rel="stylesheet">
  {{-- Scripts for user admin --}}
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="/js/plugins/jquery/jquery.min.js"></script>
  <script src="/js/plugins/jquery-steps/jquery.steps.min.js" defer></script>
  <script src="/js/plugins/jquery-ui/jquery-ui.js" defer></script>
  <script src="/js/plugins/jquery-ui/jquery-ui.multidatespicker.js" defer></script>
  <script src="/js/plugins/coreui/coreui.bundle.min.js" defer></script>
  <script src="/js/plugins/slick-slider/slick.min.js" defer></script>
  <script src="/js/plugins/datatables/datatables.min.js" defer></script>
  <script src="/js/plugins/toastr/toastr.min.js" defer></script>
  <script src="/js/plugins/mdtimepicker/mdtimepicker.min.js" defer></script>
  <script src="/js/plugins/jquery-mask/jquery.mask.js" defer></script>
  <script src="/js/plugins/jquery-mask/jquery.inputmask.min.js" defer></script>
  <script src="/js/plugins/jquery-mask/inputmask.min.js"></script>
  <script src="/js/plugins/sweet-alert/sweet-alert2.js"></script>
  <script src="/js/plugins/chartjs/chart.min.js"></script>
  <script src="/js/plugins/chartjs/chartjs-datalabels.js"></script>
  <script src="/js/plugins/jquery-ui/bootstrap-datepicker.es.js" defer></script>
  <script src="/js/plugins/dropzone/dropzone.js"></script>
  <script src="/js/plugins/intl-tel/intl-tel.min.js" defer></script>
  <script src="/js/plugins/suggestedtags/jquery.amsify.suggestags.js" defer></script>
  <script src="/js/plugins/ckeditor/ckeditor.js" defer></script>
  
</head>
<body class="c-app">
  <div id="sidebar" class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show">
    <div class="c-sidebar-brand d-lg-down-none">
      <div class="title-menu c-sidebar-brand-full">
        <a href="/admin"><img src="/images/logo-footer.png" width="100%"></a>
      </div>
      <div class="title-menu c-sidebar-brand-minimized">
        <a href="/admin"><img src="/images/lock.png" width="45px"></a>
      </div>
    </div>

    <ul class="c-sidebar-nav ps ps--active-y">
      <li class="c-sidebar-nav-item">
        <a href="{{ route('dashboard') }}" class="c-sidebar-nav-link">
          <img src="/images/dashboard.png" class="c-sidebar-nav-icon">
          Dashboard
        </a>
      </li>
      <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{Request::routeIs('expedients.*') ? 'c-show' : ''}}">
        <a href="javascript:void(0)" class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
          <img src="/images/expedients.png" class="c-sidebar-nav-icon">
          Historial de oportunidades
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
          @foreach (Helpers::getStatusesByUser() as $status_helper)
            <li class="c-sidebar-nav-item">
              <a href="{{ route('expedients.index', ['status_slug' => $status_helper->slug]) }}" class="c-sidebar-nav-link {{ url(Request::getRequestUri()) == route('expedients.index', ['status_slug' => $status_helper->slug]) || url(Request::getRequestUri()) == route('expedients.show', ['expedient' => (isset($expedient) ? $expedient->id : 0), 'status_slug' => $status_helper->slug]) || url(Request::getRequestUri()) == route('expedients.edit', ['expedient' => (isset($expedient) ? $expedient->id : 0), 'status_slug' => $status_helper->slug]) || url(Request::getRequestUri()) == route('expedients.create', ['status_slug' => $status_helper->slug]) ? 'c-active' : '' }}">
                <img src="{{ $status_helper->icon }}" class="c-sidebar-nav-icon">
                {{ $status_helper->menu_name }}
              </a>
            </li>
          @endforeach
        </ul>
      </li>
      @if(auth()->user()->denyAnyRole(['Asesor','Callcenter','Social']))
      <li class="c-sidebar-nav-item">
        <a href="{{ route('customers.index') }}" class="c-sidebar-nav-link {{Route::is('contracts.*') || Route::is('customers.show') ? 'c-active' : ''}}">
          <img src="/images/customers.png" class="c-sidebar-nav-icon">
          Clientes
        </a>
      </li>
      @endif
      @if(auth()->user()->hasAnyRole(['Gerente','Administrador','BackOffice']))
      <li class="c-sidebar-nav-item">
        <a href="{{ route('entry-channels.index') }}" class="c-sidebar-nav-link">
          <img src="/images/entry_channels.png" class="c-sidebar-nav-icon">
          Vías de ingreso
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('banks.index') }}" class="c-sidebar-nav-link">
          <img src="/images/banks.png" class="c-sidebar-nav-icon">
          Bancos/Acreedores
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('type-debts.index') }}" class="c-sidebar-nav-link">
          <img src="/images/type_debts.png" class="c-sidebar-nav-icon">
          Tipos de deuda
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('reasons.index') }}" class="c-sidebar-nav-link">
          <img src="/images/rejected.png" class="c-sidebar-nav-icon">
          Motivos de rechazo
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('actions.index') }}" class="c-sidebar-nav-link">
          <img src="/images/actions.png" class="c-sidebar-nav-icon">
          Acciones
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('incomes.index') }}" class="c-sidebar-nav-link">
          <img src="/images/incomes.png" class="c-sidebar-nav-icon">
          Ingreso de fondos
        </a>
      </li>
      
      <li class="c-sidebar-nav-item">
        <a href="{{ route('plans.index') }}" class="c-sidebar-nav-link">
          <img src="/images/plans.png" class="c-sidebar-nav-icon">
          Planes
        </a>
      </li>
      
      <li class="c-sidebar-nav-item">
        <a href="{{ route('achievements.index') }}" class="c-sidebar-nav-link">
          <img src="/images/achievements.png" class="c-sidebar-nav-icon">
          Logros
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('users.index') }}" class="c-sidebar-nav-link">
          <img src="/images/roles.png" class="c-sidebar-nav-icon">
          Roles
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a href="{{ route('countries.index') }}" class="c-sidebar-nav-link">
          <img src="/images/countries.png" class="c-sidebar-nav-icon">
          Países
        </a>
      </li>
      @endif
      @if(auth()->user()->hasAnyRole(['Gerente','Administrador','BackOffice','Supervisor']))
      <li class="c-sidebar-nav-item">
        <a href="{{ route('exports.index') }}" class="c-sidebar-nav-link">
          <img src="/images/exports.png" class="c-sidebar-nav-icon">
          Exportes 
        </a>
      </li>
      
      <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a href="javascript:void(0)" class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
          <img src="/images/web.png" class="c-sidebar-nav-icon">
          Sitio WEB
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
          <li class="c-sidebar-nav-item">
            <a href="{{ route('posts.index') }}" class="c-sidebar-nav-link">
              <img src="/images/blog.png" class="c-sidebar-nav-icon">
              Blog
            </a>
          </li>
          <li class="c-sidebar-nav-item">
            <a href="{{ route('testimonials.index') }}" class="c-sidebar-nav-link">
              <img src="/images/testimonials.png" class="c-sidebar-nav-icon">
              Historias de vida
            </a>
          </li>
          <li class="c-sidebar-nav-item">
            <a href="{{ route('teams.index') }}" class="c-sidebar-nav-link">
              <img src="/images/roles.png" class="c-sidebar-nav-icon">
              Nuestro equipo
            </a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
  </div>
  <div class="c-wrapper {{ explode('/',request()->path())[1] }}">
    <header class="c-header navbar c-header-fixed navbar-light">
      <button class="c-header-toggler c-class-toggler d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-bars"></i>
      </button>
      <div class="account-user">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          <a href="" class="link-admin edit-logued-user" data-id="{{ auth()->user()->id}} ">
            <img src="/images/user.png" width="30px">
            <p class="role-name">{{ auth()->user()->fullname }}
              <span>{{ auth()->user()->role->name }}</span>
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
                @if($breadcrumb == "expedients")
                  <li class="breadcrumb-item"><a href="{{ route($breadcrumb . '.index', ['status_slug' => $status->slug]) }}">{{ __('admin.' . $breadcrumb . '') }}</a></li>
                @elseif($breadcrumb == "users")
                  <li class="breadcrumb-item"><a href="{{ route($breadcrumb . '.index') }}">{{ __('admin.' . $breadcrumb . '') }}</a></li>
                @elseif($breadcrumb == "customers")
                  <li class="breadcrumb-item"><a href="{{ route($breadcrumb . '.index') }}">{{ __('admin.' . $breadcrumb . '') }}</a></li>
                @elseif($breadcrumb == "contracts")
                  <li class="breadcrumb-item"><a href="{{ route($breadcrumb . '.index') }}">{{ __('admin.' . $breadcrumb . '') }}</a></li>
                @else
                <li class="breadcrumb-item"><a href="{{ route($breadcrumb) }}">{{ __('admin.' . $breadcrumb . '') }}</a></li>
                @endif
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
</body>
</html>
