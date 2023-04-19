<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
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
        // 現在ログインしているユーザが管理者か判定しtrueまたはfalseを代入
        $adminId = Auth::user()->is_admin;

        // もし管理者でない場合エラーメッセージを返す
        if ((int) $adminId === 0) {
            return redirect()->back()->with('USer_error', 'アクセス権限がありません');
        }

        return $next($request);
    }
}
