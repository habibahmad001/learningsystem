<?php
namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession as Middleware;
use Closure;

class StartSession extends Middleware
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
        if (! $this->sessionConfigured()) {
            return $next($request);
        }

        $session = $this->getSession($request);

        if ($this->manager->shouldBlock() ||
            ($request->route() instanceof Route && $request->route()->locksFor())) {
            return $this->handleRequestWhileBlocking($request, $session, $next);
        } else {
            return $this->handleStatefulRequest($request, $session, $next);
        }
    }

}
