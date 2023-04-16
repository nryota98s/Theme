<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Closure;

class UserIdMiddleware
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
        // web.phpでリンクを取得する方法で$idを取得
        $id = $request->route('userId');
        $now_id = Auth::user()->id;
        // 2つの数値が一致しない場合前のページに戻りエラーを表示
        if ((int) $id !== (int) $now_id) {
            return redirect()->back()->with('USer_error', 'アクセス権限がありません');
        }

        return $next($request);
    }
}
