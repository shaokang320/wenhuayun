<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'https://wenhua.newheightchina.com/enterprise/upload',
        'https://wenhua.newheightchina.com/enterprise/upload/upload_video',
        'https://wenhua.newheightchina.com/enterprise/upload/upload_file',
//        'http://www.lianyi.com/enterprise/upload/upload_file',
//        'http://www.lianyi.com/enterprise/upload/upload_video',
//        'http://www.lianyi.com/enterprise/upload',
    ];
}
