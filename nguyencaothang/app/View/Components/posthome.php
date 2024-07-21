<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class posthome extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $args1=[
            ['status',1],
        ];
        $list = Post::where($args1)
        ->orderBy('created_at', 'desc')
        ->get();
      
        return view('components.posthome', compact('list'));
    }
}
