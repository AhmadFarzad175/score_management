<?php

namespace App\View\Components;

use Closure;
use App\Models\Classs;
use App\Models\Attendance;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AttendanceHeader extends Component
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
        return view('components.attendance-header',[
            'classes' =>  Classs::latest()->get(),
        ]);
    }
}
