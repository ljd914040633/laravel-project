<?php

namespace App\Http\Middleware;

use Closure;
// 引入route
use Route;
use Auth;
class CheckRbac
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
        // phpinfo();die;
        if(Auth::guard('admin') -> user() -> role_id != '1'){
            $route = explode('\\', Route::currentRouteAction());//整个路由的数组形式
            // 获取当前登录用户的角色权限信息
            $role_ac = Auth::guard('admin') -> user() -> rel_role -> auth_ac; //当前用户角色的权限
            // var_dump($route,$role_ac);die;
            // 比较权限是否存在
            if(stripos($role_ac, end($route)) === false){
                // 给出提示
                exit('您没有权限访问该页面！');
            }
        }
        // 继续后续访问
        return $next($request);
    }
}
