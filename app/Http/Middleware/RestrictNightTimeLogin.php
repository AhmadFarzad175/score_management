<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestrictNightTimeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Define the start and end times for restricted access
        $kabulTime = Carbon::createFromFormat('Y-m-d H:i:s.u e', '2024-07-26 17:23:19.384788 Asia/Kabul');

        $startEvening = Carbon::createFromTimeString('19:00', 'Asia/Kabul');
        $endEvening = Carbon::createFromTimeString('08:00', 'Asia/Kabul')->addDay();


        // Check if current time is within the restricted period
        if ($kabulTime->between($startEvening, $endEvening)) {
            return redirect()->back()->with('error', 'Login is not allowed during night time.')->withInput();
            // return redirect()->back()->with('success', 'Login is not allowed during night time.');
        
            // return redirect()->back()->with('error', 'User not found');
            // throw new Exception('Login is not allowed during night time!');
        }

        return $next($request);
    }
}
