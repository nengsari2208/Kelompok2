<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Auth;

class CheckDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$departments)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

/* 
*   jika yang diminta pegawai berarti user.departement selain HR dan FINANCE Next
*   jika HR dan FINANCE mengunjungi, akan ke /home
*   jika yang diminta HR / Finance maka disesuaikan dengan user.depart, Jika sesuai Next
*   jika selain HR & FINANCE mengunjungi, akan ke /home
*/
       

        foreach ($departments as $department) {
            if($department == 'PEGAWAI'){
                if ($user->department->nama_departemen != "HR" && $user->department->nama_departemen != "FINANCE") {
                    return $next($request);
                }
            } else {
                if ($user->department->nama_departemen == $department) {
                    return $next($request);
                }
            }
        }
    

        return redirect('/home');
    }
}


// elseif($department == 'PEGAWAI'){
//     if ($user->department->nama_departemen == "HR" || $user->department->nama_departemen == "FINANCE") {
//         return $next($request);
//     }
// } 