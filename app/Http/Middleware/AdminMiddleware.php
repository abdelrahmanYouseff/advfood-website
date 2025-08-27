<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Check if user is admin (email check)
        $adminEmails = ['admin@gmail.com', 'abdelrahmanyouseff@gmail.com'];
        if (!in_array($user->email, $adminEmails)) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Access denied. Admin privileges required.']);
        }

        return $next($request);
    }
}

