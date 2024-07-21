<!-- @if (count($listmenu) == 0)

<a class="nav-link dropdown-toggle"  href="{{ $menu_item->link }}"> </i>{{ $menu_item->name }} </a>

@else
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ $menu_item->link }}"> <i class="fa fa-bars text-muted mr-2"></i>{{ $menu_item->name }} </a>
          <div class="dropdown-menu">
           
            @foreach ($listmenu as $item)
            <a class="dropdown-item" href="#">{{ $item->name }} </a>
            @endforeach
          </div>
       
        </li>
        @endif -->
        @if (count($listmenu) == 0)
    <!-- <a href="{{ $menu_item->link }}" class="nav-item nav-link active">{{ $menu_item->name }}</a> -->
    <li><a href="{{ $menu_item->link }}">{{ $menu_item->name }}</a></li>
@else
    <!-- <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $menu_item->name }}</a>
        <div class="dropdown-menu rounded-0 m-0">
            @foreach ($listmenu as $item)
                <a href="cart.html" class="dropdown-item">{{ $item->name }} </a>
            @endforeach
        </div>
    </div> -->

    <li class="dropdown">
      <a href="{{ $menu_item->link }}">{{ $menu_item->name }}</a>
      <div class="dropdown-content">
      @foreach ($listmenu as $item)
        <a href="{{ $menu_item->link }}">{{ $item->name }}</a>
        @endforeach
       
      </div>
    </li>
@endif