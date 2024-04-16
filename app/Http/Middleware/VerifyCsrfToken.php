<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;
use Closure;
class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
     protected $except = [
        'payments/paypal/status-success',
       'payments/payu/status-success',
       'payments/payu/status-cancel',
       'paynow/fee/pau-success',
       'paynow/fee/pau-cancel',
       'paynow/fee/paypal-success',
       'paynow/fee/paypal-cancel',
    ];

    public function handle($request, Closure $next)
    {
        if($request->cookie('consent') == null){
            return $next($request);
        }

        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }
}
