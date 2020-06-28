<?php

use Solital\Core\Http\Uri;
use Solital\Core\Http\Request;
use Solital\Core\Http\Response;
use Solital\Core\Http\UploadedFile;
use Solital\Core\Course\Course as Course;

/**
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Solital\Http\Uri
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Uri
{
    return Course::getUri($name, $parameters, $getParams);
}

/**
 * @return \Solital\Http\Response
 */
function response(): Response
{
    return Course::response();
}

/**
 * @return \Solital\Http\Request
 */
function request(): Request
{
    return Course::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Solital\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * Upload a file
 * @param string
 */
function upload($file): UploadedFile
{
    $upload = new UploadedFile($file);
    return $upload;
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
    exit;
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Course::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

/**
 * Show result pre-formatted
 */
function pre($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}