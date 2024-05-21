<?php

namespace App\View\Components;

use Closure;
use App\Models\Classs;
use App\Models\Province;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class studentForm extends Component
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
        return view('components.student-form',[
            'classes' => Classs::orderBy('id', 'desc')->get(),
            'provinces' => Province::all()
        ]);
    }
}
