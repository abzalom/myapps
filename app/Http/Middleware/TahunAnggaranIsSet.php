<?php

namespace App\Http\Middleware;

use App\Models\ETahunAnggaran;
use Closure;
use Illuminate\Http\Request;

class TahunAnggaranIsSet
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
        $tahunAnggaran = ETahunAnggaran::where('is_active', true)->first();
        if ($tahunAnggaran == null) {
            return redirect()->route('pengaturan.rkpd')->with('pesan', 'Tahun anggaran belum di setting');
        }
        return $next($request);
    }
}
