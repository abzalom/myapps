<?php

namespace App\Http\Middleware;

use App\Models\ETahapan;
use Closure;
use Illuminate\Http\Request;

class TahapanIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tahapan = ETahapan::where('is_active', true)->first();
        if ($tahapan == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahapan belum diaktifkan');
        }
        return $next($request);
    }
}
