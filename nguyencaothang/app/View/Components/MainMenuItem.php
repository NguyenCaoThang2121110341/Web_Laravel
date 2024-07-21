<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $row_menu= null;
    public function __construct($rowmenu)
    {
        $this->row_menu = $rowmenu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu_item = $this->row_menu;
        $args1=[
            ['status','=',1],
            ['position','=','mainmenu'],
            ['parent_id','=',$menu_item->id]
        ];
        $listmenu = Menu::where($args1)->orderBy('sort_order','asc')->get();
        return view('components.main-menu-item', compact('listmenu','menu_item'));
    }
}

