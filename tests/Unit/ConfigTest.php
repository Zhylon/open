<?php

it('loads default config values', function () {
    expect(config('zopen.html_comment.enabled'))->toBeTrue()
        ->and(config('zopen.html_comment.github'))->toBe('https://github.com/Zhylon')
        ->and(config('zopen.html_comment.website'))->toBe('https://zhylon.net')
        ->and(config('zopen.console.enabled'))->toBeTrue()
        ->and(config('zopen.environments'))->toBe(['testing']);
});

it('can disable html comment via config', function () {
    config()->set('zopen.html_comment.enabled', false);

    expect(config('zopen.html_comment.enabled'))->toBeFalse();
});

it('can disable console output via config', function () {
    config()->set('zopen.console.enabled', false);

    expect(config('zopen.console.enabled'))->toBeFalse();
});
