<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Zhylon\Open\Http\Middleware\InjectOpenComment;

it('injects html comment into html response', function () {
    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            '<html><head></head><body></body></html>',
            200,
            ['Content-Type' => 'text/html']
        );
    });

    expect($response->getContent())
        ->toContain('Hello curious developer');
});

it('injects console script before closing body tag', function () {
    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            '<html><head></head><body></body></html>',
            200,
            ['Content-Type' => 'text/html']
        );
    });

    expect($response->getContent())
        ->toContain('console.log')
        ->toContain('</body>');
});

it('does not inject into json responses', function () {
    $middleware = new InjectOpenComment;

    $request = Request::create('/api/test', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            json_encode(['status' => 'ok']),
            200,
            ['Content-Type' => 'application/json']
        );
    });

    expect($response->getContent())
        ->not->toContain('Hello curious developer')
        ->not->toContain('console.log');
});

it('does not inject into redirect responses', function () {
    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return redirect('/dashboard');
    });

    expect($response->getContent())
        ->not->toContain('Hello curious developer');
});

it('skips html comment when disabled', function () {
    config()->set('zopen.html_comment.enabled', false);

    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            '<html><head></head><body></body></html>',
            200,
            ['Content-Type' => 'text/html']
        );
    });

    expect($response->getContent())
        ->not->toContain('Hello curious developer');
});

it('skips console output when disabled', function () {
    config()->set('zopen.console.enabled', false);

    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            '<html><head></head><body></body></html>',
            200,
            ['Content-Type' => 'text/html']
        );
    });

    expect($response->getContent())
        ->not->toContain('console.log');
});

it('skips all output when globally disabled', function () {
    config()->set('zopen.enabled', false);

    $middleware = new InjectOpenComment;

    $request = Request::create('/', 'GET');

    $response = $middleware->handle($request, function () {
        return new Response(
            '<html><head></head><body></body></html>',
            200,
            ['Content-Type' => 'text/html']
        );
    });

    expect($response->getContent())
        ->not->toContain('Hello curious developer')
        ->not->toContain('console.log');
});
