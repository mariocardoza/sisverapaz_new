  <li class="dropdown notifications-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">{{\App\Notificacion::where('destinatario_id',auth()->user()->id)->where('leido',false)->count()}}</span>
      </a>
      <ul class="dropdown-menu">
        <li class="header">Tienes {{\App\Notificacion::where('destinatario_id',auth()->user()->id)->where('leido',false)->count()}} notificationes</li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            @foreach(\App\Notificacion::where('destinatario_id',auth()->user()->id)->where('leido',false)->get() as $comment)
            <li>
              <p style="padding: 0.5em;"><i class="fa fa-warning text-yellow"></i> <a href="#">{{$comment->mensaje}}</a></p>
            </li>
            @endforeach
          </ul>
        </li>
        <li class="footer"><a href="#">View all</a></li>
      </ul>
  </li>