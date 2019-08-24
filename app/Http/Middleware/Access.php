<?php

namespace App\Http\Middleware;
use App\User;
use App\Role;
use App\Accessibility;
use Closure;
use Session;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $segment1 = request()->segment(1);
        $segment3 = request()->segment(3);
        if($segment3 != NULL){
            $accessUrl = $segment1.'/'.$segment3;
        }else{
            $accessUrl = $segment1;
        }

        $userRoles = User::where('id', \Auth::user()->id)->with(['userRole' => function($role){
                    $role->with('accessibilities' );
               }])->first();

        foreach($userRoles->userRole->accessibilities as $access){
            if($userRoles->userRole->title == 'مدیر سایت' || $access->englishTitle == $accessUrl){
                return $next($request);
            }
        }
        abort(403);
    }
}
