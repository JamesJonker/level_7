<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/login',
        'api/logout',
        // 'api/posts',
        'http://127.0.0.1:8000/api/posts/*',
        // 'posts/*/comments',
        'http://127.0.0.1:8000/api/comments/*',
        'http://127.0.0.1:8000/api/posts/*/comments',
    ];

   
}
