<?php

namespace Zhylon\Open\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class InjectOpenComment
{
    public function handle(Request $request, Closure $next): BaseResponse
    {
        $response = $next($request);

        if (! $this->shouldInject($response)) {
            return $response;
        }

        $content = $response->getContent();
        $content = $this->injectHtmlComment($content);
        $content = $this->injectConsoleOutput($content);

        $response->setContent($content);

        return $response;
    }

    protected function shouldInject(BaseResponse $response): bool
    {
        if (! config('zopen.enabled', true)) {
            return false;
        }

        if (! $response instanceof Response) {
            return false;
        }

        $contentType = $response->headers->get('Content-Type', '');

        if (! str_contains($contentType, 'text/html')) {
            return false;
        }

        if ($response->isRedirect()) {
            return false;
        }

        return true;
    }

    protected function injectHtmlComment(string $content): string
    {
        if (! config('zopen.html_comment.enabled', true)) {
            return $content;
        }

        $comment = view('zopen::comment')->render();

        return preg_replace('/<head(\s[^>]*)?>/', '$0'."\n".$comment, $content, 1) ?? $content;
    }

    protected function injectConsoleOutput(string $content): string
    {
        if (! config('zopen.console.enabled', true)) {
            return $content;
        }

        $script = view('zopen::console')->render();

        return str_replace('</body>', $script."\n".'</body>', $content) ?: $content;
    }
}
