<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/api/posts/*',
        '/api/posts',
        '/api/register',
        '/api/comments/*',
        '/api/posts/*/comments',
        '/api/login',
        '/api/logout',
    ];
}