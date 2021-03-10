<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class CreatePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $name = null)
    {
       
        $listPermission = Permission::all()->pluck('name');
        if($name){
            if( !$listPermission->contains($name)){
               Permission::create(['name'=>$name]);
            }
        }
        return $next($request);
    }
}
