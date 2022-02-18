<header>
    <table width="100%">
      <tr>
        <td>
          <center><img src="{{ $configuracion->escudo_gobierno!='' ? public_path("storage/logos/".$configuracion->escudo_gobierno) : public_path("img/escudoelsalvador.png") }}" width="80px" height="100px" alt=""></center>
        </td>
        <td>
          <p  class="text-center " style="color:#155CC2;font: 180% sans-serif;">ALCALDÍA MUNICIPAL DE VERAPAZ</p> 
          <p class="text-center " style="font-size:13px;color:#155CC2;" >UNIDAD DE TESORERÍA</p>
          <p style="border: 1px solid;" class="text-center">{!! $tipo !!}</p>
        </td>
        <td>
          <center><img src="{{ $configuracion->escudo_alcaldia !='' ? public_path("storage/logos/".$configuracion->escudo_alcaldia) :public_path("img/escudoamverapaz.png") }}" class="" width="80px" height="90px" alt="escudo El Salvador"></center>
        </td>
      </tr>
    </table>
  </header>