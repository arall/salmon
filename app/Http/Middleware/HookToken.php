<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Hook;

class HookToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $redirection
     * @return mixed
     */
    public function handle($request, Closure $next, $redirection = null)
    {
        if (!$redirection) {
            $redirection = route('phished');
        }

        if ($request->token !== 'fake_token') {
            $hook = Hook::where('token', $request->token)->first();
            if (!$hook) {
                return redirect($redirection);
            }
        }

        return $next($request);
    }
}
