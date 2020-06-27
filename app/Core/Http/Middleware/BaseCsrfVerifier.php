<?php

namespace Solital\Core\Http\Middleware;

use Solital\Core\Http\Middleware\Exceptions\TokenMismatchException;
use Solital\Core\Http\Request;
use Solital\Core\Http\Security\CookieTokenProvider;
use Solital\Core\Http\Security\TokenProviderInterface;

class BaseCsrfVerifier implements MiddlewareInterface
{
    public const POST_KEY = 'csrf_token';
    public const HEADER_KEY = 'X-CSRF-TOKEN';

    protected $except;
    protected $tokenProvider;

    /**
     * BaseCsrfVerifier constructor.
     * @throws \Solital\Http\Security\Exceptions\SecurityException
     */
    public function __construct()
    {
        $this->tokenProvider = new CookieTokenProvider();
    }

    /**
     * Check if the url matches the urls in the except property
     * @param Request $request
     * @return bool
     */
    protected function skip(Request $request): bool
    {
        if ($this->except === null || \count($this->except) === 0) {
            return false;
        }

        $max = \count($this->except) - 1;

        for ($i = $max; $i >= 0; $i--) {
            $url = $this->except[$i];

            $url = rtrim($url, '/');
            if ($url[\strlen($url) - 1] === '*') {
                $url = rtrim($url, '*');
                $skip = $request->getUri()->contains($url);
            } else {
                $skip = ($url === $request->getUri()->getOriginalUrl());
            }

            if ($skip === true) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle request
     *
     * @param Request $request
     * @throws TokenMismatchException
     */
    public function handle(Request $request): void
    {

        if ($this->skip($request) === false && \in_array($request->getMethod(), ['post', 'put', 'delete'], true) === true) {

            $token = $request->getInputHandler()->value(
                static::POST_KEY,
                $request->getHeader(static::HEADER_KEY),
                'post'
            );

            if ($this->tokenProvider->validate((string)$token) === false) {
                #throw new TokenMismatchException('Invalid CSRF-token.');
                TokenMismatchException::alertMessage(404, "Invalid CSRF-token");
            }

        }

        // Refresh existing token
        $this->tokenProvider->refresh();

    }

    public function getTokenProvider(): TokenProviderInterface
    {
        return $this->tokenProvider;
    }

    /**
     * Set token provider
     * @param TokenProviderInterface $provider
     */
    public function setTokenProvider(TokenProviderInterface $provider): void
    {
        $this->tokenProvider = $provider;
    }

}