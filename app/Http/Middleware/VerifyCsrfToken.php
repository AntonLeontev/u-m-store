<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/mail-partner',
        '/payments/callback',
        '/getorders',
        '/fdmafqc1fq1qaz8yttgfsq2t311l97kz27qm4ypm8tchmwf1c4ntfew1kh12of05t9qur01tdx0e5ku82u03i6h1sstl5a65zg6k/webhook/',
        '/eeekcitlzk9pjvp5t8upm6dp1pq7y9p39qu1iechklm7bgaole70c29lkcy58ys61eidvtmxtj2stidbh7eb76qqwih5zb0i3gnj/webhook',
    ];
}
