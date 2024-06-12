<?php

namespace App\View\Components;

use Closure;
use App\Models\Classs;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class studentSearch extends Component
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
        return view('components.student-search',[
            'classes' => Classs::orderBy('id', 'desc')->get(),

        ]);
    }
}
