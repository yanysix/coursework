<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, авторизован ли пользователь и его роль
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Если не админ, редирект на главную
            return redirect()->route('main')->with('error', 'У вас нет доступа к админ-панели.');
        }

        return $next($request);
    }
}
