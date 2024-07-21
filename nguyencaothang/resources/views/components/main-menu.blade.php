<ul class="menu">
@foreach ($listmenu as $rowmenu)
        <x-main-menu-item :rowmenu="$rowmenu" />
    @endforeach
      </ul>