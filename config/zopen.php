<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Switch
    |--------------------------------------------------------------------------
    |
    | Master switch to disable the entire package output at once.
    | Useful for quick disabling without touching individual settings.
    |
    */

    'enabled' => env('ZHYLON_OPEN_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | HTML Comment
    |--------------------------------------------------------------------------
    |
    | When enabled, an HTML comment is injected at the top of every response.
    | This is a friendly hello to curious developers who view the page source.
    |
    */

    'html_comment' => [
        'enabled' => env('ZHYLON_OPEN_HTML_COMMENT', true),
        'message' => env('ZHYLON_OPEN_HTML_MESSAGE', '👋 Hello curious developer! Looks like you\'re exploring the source. Zhylon is building infrastructure and developer tools in Europe. If you enjoy building things, you might like what we\'re doing.'),
        'github'  => env('ZHYLON_OPEN_GITHUB', 'https://github.com/Zhylon'),
        'website' => env('ZHYLON_OPEN_WEBSITE', 'https://zhylon.net'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Console Output
    |--------------------------------------------------------------------------
    |
    | When enabled, a styled message is printed to the browser's developer
    | console. Visible in DevTools → Console for curious developers.
    |
    */

    'console' => [
        'enabled' => env('ZHYLON_OPEN_CONSOLE', true),
        'message' => env('ZHYLON_OPEN_CONSOLE_MESSAGE', 'Hey, you found us! 🚀'),
        'style'   => env('ZHYLON_OPEN_CONSOLE_STYLE', 'color: #6366f1; font-size: 14px; font-weight: bold;'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Environments
    |--------------------------------------------------------------------------
    |
    | Define in which environments the output is active. By default only
    | in production — no noise in local/staging logs or source views.
    |
    */

    'environments' => ['production'],

];
