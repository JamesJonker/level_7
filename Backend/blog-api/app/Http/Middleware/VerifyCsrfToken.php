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
        //

    ];

    protected function inExceptArray($request)
    {
        $dbHost = env('DB_HOST');

        $this->except = array($this->except, [

            $dbHost . '/api/posts/*',
            $dbHost . '/api/register',
            $dbHost . '/api/comments/*',
            $dbHost . '/api/posts/*/comments',
            $dbHost . '/api/login',
            $dbHost . '/api/logout'
        ]);

        return parent::inExceptArray($request);


        // 'api/login',
        // 'api/logout',
        // 'http://127.0.0.1:8000/api/posts/*',
        // 'http://127.0.0.1:8000/api/register',
        // 'http://127.0.0.1:8000/api/comments/*',
        // 'http://127.0.0.1:8000/api/posts/*/comments',

    }

   
}
